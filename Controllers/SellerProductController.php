<?php

namespace App\Http\Controllers;

use App\Models\SellerProduct;
use App\Models\SerialNumber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Image;

class SellerProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsLogin');
        $this->middleware('IsSeller')->except('index', 'show');
        $this->middleware('IsAdminSeller')->only('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if(auth()->guard('seller')->check()){
                $data = SellerProduct::where('seller_id', auth()->guard('seller')->user()->id)->orderBy('name', 'ASC')->get();
            }
            if(auth()->guard('admin')->check()){
                $data = SellerProduct::orderBy('name', 'ASC')->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        return '
                        <button class="btn btn-success btn-sm mr-1" onclick="modal_detail(\''.route('seller_product_increase.increase', $data->id).'\', \'Increase product ' . $data->name . '\')"><i class="fa fa-fw fa-plus"></i></button>

                        <button class="btn btn-info btn-sm mr-1" onclick="modal_detail(\''.route('seller_product.show', $data->id).'\', \'Detail data ' . $data->name . '\')"><i class="fa fa-fw fa-list"></i></button>

                        <a href="'.route('seller_product.edit', $data->id).'" class="btn btn-warning btn-sm mr-1 text-white"><i class="fa fa-fw fa-edit"></i></a>

                        <button class="btn btn-danger btn-sm" onclick="confirm_delete(\''.route('seller_product.destroy', $data->id).'\', \'Are you sure want to delete data ' . $data->name . ' ?\')"><i class="fa fa-fw fa-trash"></i></button>
                            ';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('seller_product.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('seller_product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate(
            [
                'name' => 'required|unique:seller_products,name',
                'description' => 'required',
                'price' => 'required',
                'myimage' => 'required|mimes:jpeg,png|max:10240',
                'serial_number' => 'required'
            ], [],
            [
                'name' => 'Name',
                'description' => 'Description',
                'price' => 'Price',
                'myimage' => 'Image',
                'serial_number' => 'Serial Number'
            ]);
            $serial_number = SerialNumber::where('code', '=', $request->serial_number)->first();
            if($serial_number->status == 1){
                return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Serial Number '. $request->serial_number . ' Have Been Used Before']]);
            }

        DB::beginTransaction();
        try{

            $image = $request->file('myimage');
            $image_name = time().'.'.$image->extension();
            $request['image'] = $image_name;
            $request['total'] = 1;
            $request['seller_id'] = auth()->guard('seller')->user()->id;

            $sellerProduct= SellerProduct::create($request->all());
            $serial_number->update(['status' => 1]);

            $path = public_path('upload/seller_product/' . $sellerProduct->seller_id . '/' . $sellerProduct->id . '/');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }

            if ($request->file('myimage')->isValid()) {
                $img = Image::make($image->path());
                $img->resize(800, 400, function ($const) {
                    $const->aspectRatio();
                })->save($path.''.$image_name);
            }

            DB::commit();
            return redirect()->route('seller_product.index')->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $sellerProduct->name . ' added successfully']]);

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => $ex->getMessage()]]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SellerProduct  $sellerProduct
     * @return \Illuminate\Http\Response
     */
    public function show(SellerProduct $sellerProduct)
    {
        return view('seller_product.detail', ['data' => $sellerProduct]);
    }

    public function increase($id)
    {
        return view('seller_product.increase', ['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SellerProduct  $sellerProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(SellerProduct $sellerProduct)
    {
        return view('seller_product.edit', ['data' => $sellerProduct]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SellerProduct  $sellerProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SellerProduct $sellerProduct)
    {
        if(isset($request->type)){
            if($request->type == 'increase'){
                $serial_number = SerialNumber::where('code', $request->serial_number)->first();
                if($serial_number->status == 0){
                    $sellerProduct->increment('total');
                    return redirect()->back()->with(['msg' => ['type' => 'success', 'msg' => 'Total Product '. $sellerProduct->name .' Increease']]);
                }else{
                    return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Serial Number Already Been Used Before']]);
                }
            }
        }else{
            $request->validate(
                [
                    'name' => 'required|unique:seller_products,name,'.$sellerProduct->id,
                    'description' => 'required',
                    'price' => 'required',
                ], [],
                [
                    'name' => 'Name',
                    'description' => 'Description',
                    'price' => 'Price',
                ]);

            DB::beginTransaction();
            try{

                if ($request->hasFile('myimage')) {
                    $path = public_path('upload/seller_product/' . $sellerProduct->seller_id . '/' . $sellerProduct->id . '/');
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    }

                    if ($request->file('myimage')->isValid()) {
                        $request->validate(
                            [
                            'myimage' => 'mimes:jpeg,png|max:10240',
                            ], [],
                            [
                            'myimage' => 'Seller myimage'
                            ]);
                        $image = $request->file('myimage');
                        $image_name = time().'.'.$image->extension();

                        $img = Image::make($image->path());
                        $img->resize(800, 400, function ($const) {
                            $const->aspectRatio();
                        })->save($path.''.$image_name);

                        if($sellerProduct->image != ''  && $sellerProduct->image != null){
                            $file_old = $path.$sellerProduct->image;
                            if(file_exists($file_old)){
                                unlink($file_old);
                            }
                        }

                        $sellerProduct->update(['image' => $image_name]);
                    }
                }
                $sellerProduct->update($request->all());

                DB::commit();
                return redirect()->route('seller_product.index')->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $sellerProduct->name . ' updated successfully']]);

            }catch(Exception $ex){
                DB::rollback();
                return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => $ex->getMessage()]]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SellerProduct  $sellerProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(SellerProduct $sellerProduct)
    {

        DB::beginTransaction();
        try {
            $path = public_path('upload/seller_product/' . $sellerProduct->seller_id . '/' . $sellerProduct->id . '/');
            if($sellerProduct->image != ''  && $sellerProduct->image != null){
                $file_old = $path.$sellerProduct->image;
                if(file_exists($file_old)){
                    unlink($file_old);
                }
            }

            $sellerProduct->delete();
            DB::commit();
            session()->flash('msg', ['type' =>'success', 'msg' => 'Data ' . $sellerProduct->name . ' deleted successfully dihapus']);
            return responseApi(200, route('seller_product.index'), 'ok');
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'terjadi kesalahan tidak terduga']]);
        }
    }
}

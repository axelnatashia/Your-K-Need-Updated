<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Image;

class SellerController extends Controller
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
            $data = Seller::orderBy('name')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    if(auth()->guard('admin')->check()){
                        return '
                        <button class="btn btn-info btn-sm mr-1" onclick="modal_detail(\''.route('seller.show', $data->id).'\', \'Detail data ' . $data->name . '\')"><i class="fa fa-fw fa-list"></i></button>
                            ';
                    }else{
                        return '
                        <button class="btn btn-info btn-sm mr-1" onclick="modal_detail(\''.route('seller.show', $data->id).'\', \'Detail data ' . $data->name . '\')"><i class="fa fa-fw fa-list"></i></button>
                        <a href="'.route('seller.edit', $data->id).'" class="btn btn-warning btn-sm mr-1 text-white"><i class="fa fa-fw fa-edit"></i></a>
                        <button class="btn btn-danger btn-sm" onclick="confirm_delete(\''.route('seller.destroy', $data->id).'\', \'Are you sure want to delete data ' . $data->name . ' ?\')"><i class="fa fa-fw fa-trash"></i></button>
                            ';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('seller.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('seller.create');
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
                'name' => 'required',
                'description' => 'required',
                'phone_number' => 'required',
                'address' => 'required',
                'province' => 'required',
                'email' => 'required|unique:sellers,email',
                'username' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
                'myimage' => 'required|mimes:jpeg,png|max:10240',
            ], [],
            [
                'name' => 'Name',
                'description' => 'Description',
                'phone_number' => 'Phone Number',
                'address' => 'Address',
                'province' => 'Province',
                'email' => 'Email',
                'username' => 'Username',
                'password' => 'Password',
                'password_confirmation' => 'Password Confirmation',
                'myimage' => 'Image',
            ]);

        DB::beginTransaction();
        try{
            $image = $request->file('myimage');
            $image_name = time().'.'.$image->extension();
            $request['avatar'] = $image_name;

            $seller= Seller::create($request->all());

            $path = public_path('upload/seller/avatar/');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }

            if ($request->file('myimage')->isValid()) {
                $img = Image::make($image->path());
                $img->resize(200, 200, function ($const) {
                    $const->aspectRatio();
                })->save($path.''.$image_name);
            }

            DB::commit();
            return redirect()->route('seller.index')->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $seller->name . ' added successfully']]);

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        return view('seller.detail', ['data' => $seller]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        return view('seller.edit', ['data' => $seller]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'phone_number' => 'required',
                'address' => 'required',
                'province' => 'required',
                'email' => 'required|unique:sellers,email,'.$seller->id,
                'username' => 'required',
                'myimage' => 'nullable|mimes:jpeg,png|max:10240',
            ], [],
            [
                'name' => 'Name',
                'description' => 'Description',
                'phone_number' => 'Phone Number',
                'address' => 'Address',
                'province' => 'Province',
                'email' => 'Email',
                'username' => 'Username',
                'myimage' => 'Image',
            ]);

            if(isset($request->password) || $request->password!= '' || $request->password!= NULL){
                $request->validate(
                    [
                        'password' => 'required|confirmed',
                        'password_confirmation' => 'required',
                    ], [],
                    [
                        'password' => 'Password',
                        'password_confirmation' => 'Password Confirmation',
                    ]
                );
            }

        DB::beginTransaction();
        try{

            if ($request->hasFile('myimage')) {
                $path = public_path('upload/seller/avatar/');
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }

                if ($request->file('myimage')->isValid()) {

                    $image = $request->file('myimage');
                    $image_name = time().'.'.$image->extension();

                    $img = Image::make($image->path());
                    $img->resize(200, 200, function ($const) {
                        $const->aspectRatio();
                    })->save($path.''.$image_name);

                    if($seller->avatar != ''  && $seller->avatar != null){
                        $file_old = $path.$seller->avatar;
                        if(file_exists($file_old)){
                            unlink($file_old);
                        }
                    }

                    $request['avatar'] = $image_name;
                }
            }
            if($request->password && $request->password_confirmation){
                $seller->update($request->all());
            }else{
                $seller->update($request->except(['password']));
            }

            DB::commit();
            return redirect()->back()->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $seller->name . ' updated successfully']]);

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {

        DB::beginTransaction();
        try {
            $path = public_path('upload/seller/avatar/');
            if($seller->avatar != ''  && $seller->avatar != null){
                $file_old = $path.$seller->avatar;
                if(file_exists($file_old)){
                    unlink($file_old);
                }
            }

            $seller->delete();
            DB::commit();
            session()->flash('msg', ['type' =>'success', 'msg' => 'Data ' . $seller->name . ' deleted successfully']);
            return responseApi(200, route('seller.index'), 'ok');
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Error Occured']]);
        }
    }

    public function profile() {
        $data = auth()->guard('seller')->user();
        return view('seller.profile', compact('data'));
    }
}

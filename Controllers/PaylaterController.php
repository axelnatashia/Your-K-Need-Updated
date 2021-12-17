<?php

namespace App\Http\Controllers;

use App\Models\Paylater;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Image;

class PaylaterController extends Controller
{
    public function __construct()
    {
        // $this->middleware('IsLogin');
        // $this->middleware('IsAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Paylater::orderBy('status')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('buyer_name', function($data){
                        return $data->buyer->name;
                })
                ->editColumn('status', function($data){
                        return ucwords($data->status);
                })
                ->addColumn('action', function($data){
                        return '
                        <button class="btn btn-info btn-sm mr-1" onclick="modal_detail(\''.route('paylater.show', $data->id).'\', \'Detail data ' . $data->name . '\')"><i class="fa fa-fw fa-list"></i></button>
                        <a href="'.route('paylater.edit', $data->id).'" class="btn btn-warning btn-sm mr-1 text-white"><i class="fa fa-fw fa-edit"></i></a>
                        <button class="btn btn-danger btn-sm" onclick="confirm_delete(\''.route('paylater.destroy', $data->id).'\', \'Are you sure want to delete data ' . $data->name . ' ?\')"><i class="fa fa-fw fa-trash"></i></button>
                            ';
                })
                ->rawColumns(['action', 'buyer_name'])
                ->make(true);
        }
        return view('paylater.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('paylater.create');
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
                'identity_number' => 'required|unique:paylaters,identity_number',
                'my_identity_image' => 'required|mimes:jpeg,png|max:10240',
                'my_selfie_image' => 'required|mimes:jpeg,png|max:10240',
            ], [],
            [
                'identity_number' => 'Identity Number',
                'my_identity_image' => 'Identity Card Image',
                'my_selfie_image' => 'Selfie with Identity Card Image',
            ]);

        DB::beginTransaction();
        try{
            $request['buyer_id'] = auth()->guard('buyer')->user()->id;
            $request['status'] = 'checking';
            $request['balance'] = 2000000;

            // identity card
            $my_identity_image = $request->file('my_identity_image');
            $my_identity_image_name = 'id_' . time().'.'.$my_identity_image->extension();
            $request['identity_card_img'] = $my_identity_image_name;

            // selfie
            $my_selfie_image = $request->file('my_selfie_image');
            $my_selfie_image_name = 'selfie_' . time().'.'.$my_selfie_image->extension();
            $request['selfie'] = $my_selfie_image_name;

            // identity card
            $id_path = public_path('upload/paylater/identity_card/');
            if(!File::isDirectory($id_path)){
                File::makeDirectory($id_path, 0777, true, true);
            }
            
            if ($request->file('my_identity_image')->isValid()) {
                $img = Image::make($my_identity_image->path());
                $img->save($id_path.''.$my_identity_image_name);
            }
            
            // selfie
            $selfie_path = public_path('upload/paylater/selfie/');
            if(!File::isDirectory($selfie_path)){
                File::makeDirectory($selfie_path, 0777, true, true);
            }
            
            if ($request->file('my_selfie_image')->isValid()) {
                $img = Image::make($my_selfie_image->path());
                $img->save($selfie_path.''.$my_selfie_image_name);
            }

            
            $paylater= Paylater::create($request->all());

            DB::commit();
            return redirect()->back()->with(['msg' => ['type' => 'success', 'msg' => 'Please wait for admin to check your data']]);

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paylater  $paylater
     * @return \Illuminate\Http\Response
     */
    public function show(Paylater $paylater)
    {
        return view('paylater.detail', ['data' => $paylater]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paylater  $paylater
     * @return \Illuminate\Http\Response
     */
    public function edit(Paylater $paylater)
    {
        return view('paylater.edit', ['data' => $paylater]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paylater  $paylater
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paylater $paylater)
    {
        $request->validate(
            [
                'status' => 'required',
            ], [],
            [
                'status' => 'Status',
            ]);

        DB::beginTransaction();
        try{
            $paylater->update(['status' => $request->status]);

            DB::commit();
            return redirect()->back()->with(['msg' => ['type' => 'success', 'msg' => 'Status Paylater ' . $paylater->buyer->name . ' updated successfully']]);

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paylater  $paylater
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paylater $paylater)
    {

        DB::beginTransaction();
        try {
            $paylater->delete();
            DB::commit();
            session()->flash('msg', ['type' =>'success', 'msg' => 'Data ' . $paylater->name . ' deleted successfully']);
            return responseApi(200, route('paylater.index'), 'ok');
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Error Occured']]);
        }
    }
}

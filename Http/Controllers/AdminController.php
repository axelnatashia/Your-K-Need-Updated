<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Image;

class AdminController extends Controller
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
            $data = Admin::orderBy('name')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '
                    <button class="btn btn-info btn-sm mr-1" onclick="modal_detail(\''.route('admin.show', $data->id).'\', \'Detail data ' . $data->name . '\')"><i class="fa fa-fw fa-list"></i></button>
                    <a href="'.route('admin.edit', $data->id).'" class="btn btn-warning btn-sm mr-1 text-white"><i class="fa fa-fw fa-edit"></i></a>
                    <button class="btn btn-danger btn-sm" onclick="confirm_delete(\''.route('admin.destroy', $data->id).'\', \'Are you sure want to delete data ' . $data->name . ' ?\')"><i class="fa fa-fw fa-trash"></i></button>
                        ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.create');
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
                'phone_number' => 'required',
                'email' => 'required|unique:admins,email',
                'username' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
                'myimage' => 'required|mimes:jpeg,png|max:10240',
            ], [],
            [
                'name' => 'Name',
                'phone_number' => 'Phone Number',
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

            $admin= Admin::create($request->all());

            $path = public_path('upload/admin/avatar/');
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
            return redirect()->route('admin.index')->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $admin->name . ' added successfully']]);

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return view('admin.detail', ['data' => $admin]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin.edit', ['data' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone_number' => 'required',
                'email' => 'required|unique:admins,email,'.$admin->id,
                'username' => 'required',
                'myimage' => 'nullable|mimes:jpeg,png|max:10240',
            ], [],
            [
                'name' => 'Name',
                'phone_number' => 'Phone Number',
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
                $path = public_path('upload/admin/avatar/');
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

                    if($admin->avatar != ''  && $admin->avatar != null){
                        $file_old = $path.$admin->avatar;
                        if(file_exists($file_old)){
                            unlink($file_old);
                        }
                    }

                    $request['avatar'] = $image_name;
                }
            }if($request->password && $request->password_confirmation){
                $admin->update($request->all());
            }else{
                $admin->update($request->except(['password']));
            }

            DB::commit();
            return redirect()->back()->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $admin->name . ' updated successfully']]);

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {

        DB::beginTransaction();
        try {
            $path = public_path('upload/admin/avatar/');
            if($admin->avatar != ''  && $admin->avatar != null){
                $file_old = $path.$admin->avatar;
                if(file_exists($file_old)){
                    unlink($file_old);
                }
            }

            $admin->delete();
            DB::commit();
            session()->flash('msg', ['type' =>'success', 'msg' => 'Data ' . $admin->name . ' deleted successfully']);
            return responseApi(200, route('admin.index'), 'ok');
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Error Occured']]);
        }
    }

    public function profile() {
        $data = auth()->guard('admin')->user();
        return view('admin.profile', compact('data'));
    }
}

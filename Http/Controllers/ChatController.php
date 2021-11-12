<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Chat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Image;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsLogin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_index(Request $request)
    {
        if ($request->ajax()) {
            if(auth()->guard('seller')->check()){
                $data = Chat::where('admin_id', '!=', null)->where('seller_id', '!=', null)->with(['admin'])->get();
            }else{
                $data = Chat::where('admin_id', '!=', null)->where('buyer_id', '!=', null)->with(['admin'])->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('admin_name', function($data){
                    return $data->admin->name;
                })
                ->addColumn('action', function($data){
                    return '
                    <a href="'.route('chat.admin.show', $data->id).'" class="btn btn-warning btn-sm mr-1 text-white"><i class="fa fa-fw fa-comment-dots"></i></a>
                        ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('chat.admin_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_create()
    {
        $data_admin = Admin::orderBy('name', 'ASC')->get();
        return view('chat.admin_create', compact('data_admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function admin_store(Request $request)
    {
        $request->validate(
            [
                'admin_id' => 'required',
            ], [],
            [
                'admin_id' => 'Admin',
            ]);

        DB::beginTransaction();
        try{
            $request['seller_id'] = auth()->guard('seller')->check() ? auth()->guard('seller')->user()->id : null;
            $request['buyer_id'] = auth()->guard('buyer')->check() ? auth()->guard('buyer')->user()->id : null;

            $chat = Chat::create($request->all());

            DB::commit();

            return redirect()->route('chat.admin.index')->with(['msg' => ['type' => 'success', 'msg' => 'Now you can chat with ' . $chat->admin->name]]);

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function admin_show(Chat $chat)
    {
        return view('chat.admin_detail', ['data' => $chat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}

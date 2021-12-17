<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Chat;
use App\Models\Seller;
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
                $data = Chat::where('admin_id', '!=', null)->where('seller_id', auth()->guard('seller')->user()->id)->with(['admin'])->get();
            }else{
                $data = Chat::where('admin_id', '!=', null)->where('buyer_id', auth()->guard('buyer')->user()->id)->with(['admin'])->get();
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

    public function buyer_index(Request $request)
    {
        if ($request->ajax()) {
            if(auth()->guard('seller')->check()){
                $data = Chat::where('buyer_id', '!=', null)->where('seller_id', auth()->guard('seller')->user()->id)->with(['buyer'])->get();
            }else{
                $data = Chat::where('buyer_id', '!=', null)->where('admin_id', auth()->guard('admin')->user()->id)->with(['buyer'])->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('buyer_name', function($data){
                    return $data->buyer->name;
                })
                ->addColumn('action', function($data){
                    return '
                    <a href="'.route('chat.buyer.show', $data->id).'" class="btn btn-warning btn-sm mr-1 text-white"><i class="fa fa-fw fa-comment-dots"></i></a>
                        ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('chat.buyer_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buyer_create()
    {
        $data_buyer = Buyer::orderBy('name', 'ASC')->get();
        return view('chat.buyer_create', compact('data_buyer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buyer_store(Request $request)
    {
        $request->validate(
            [
                'buyer_id' => 'required',
            ], [],
            [
                'buyer_id' => 'Buyer',
            ]);

        DB::beginTransaction();
        try{
            $request['seller_id'] = auth()->guard('seller')->check() ? auth()->guard('seller')->user()->id : null;
            $request['admin_id'] = auth()->guard('admin')->check() ? auth()->guard('admin')->user()->id : null;

            $chat = Chat::create($request->all());

            DB::commit();

            return redirect()->route('chat.buyer.index')->with(['msg' => ['type' => 'success', 'msg' => 'Now you can chat with ' . $chat->buyer->name]]);

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
    public function buyer_show(Chat $chat)
    {
        return view('chat.buyer_detail', ['data' => $chat]);
    }

    public function seller_index(Request $request)
    {
        if ($request->ajax()) {
            if(auth()->guard('admin')->check()){
                $data = Chat::where('seller_id', '!=', null)->where('admin_id', auth()->guard('admin')->user()->id)->with(['seller'])->get();
            }else{
                $data = Chat::where('seller_id', '!=', null)->where('buyer_id', auth()->guard('buyer')->user()->id)->with(['seller'])->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('seller_name', function($data){
                    return $data->seller->name;
                })
                ->addColumn('action', function($data){
                    return '
                    <a href="'.route('chat.seller.show', $data->id).'" class="btn btn-warning btn-sm mr-1 text-white"><i class="fa fa-fw fa-comment-dots"></i></a>
                        ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('chat.seller_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function seller_create()
    {
        $data_seller = Seller::orderBy('name', 'ASC')->get();
        return view('chat.seller_create', compact('data_seller'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function seller_store(Request $request)
    {
        $request->validate(
            [
                'seller_id' => 'required',
            ], [],
            [
                'seller_id' => 'Seller',
            ]);

        DB::beginTransaction();
        try{
            $request['admin_id'] = auth()->guard('admin')->check() ? auth()->guard('admin')->user()->id : null;
            $request['buyer_id'] = auth()->guard('buyer')->check() ? auth()->guard('buyer')->user()->id : null;

            $chat = Chat::create($request->all());

            DB::commit();

            return redirect()->route('chat.seller.index')->with(['msg' => ['type' => 'success', 'msg' => 'Now you can chat with ' . $chat->seller->name]]);

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
    public function seller_show(Chat $chat)
    {
        return view('chat.seller_detail', ['data' => $chat]);
    }
}

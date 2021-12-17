<?php

namespace App\Http\Controllers;

use App\Models\ChatDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Image;

class ChatDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'text' => 'required',
            ], [],
            [
                'text' => 'Text',
            ]);
            if(auth()->guard('admin')->check()){
                $request['from_logged'] = 'admin';
            }else if(auth()->guard('seller')->check()){
                $request['from_logged'] = 'seller';
            }else{
                $request['from_logged'] = 'buyer';
            }
            
        DB::beginTransaction();
        try{
            $chat_detail= ChatDetail::create($request->all());
            DB::commit();
            return redirect()->back();

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChatDetail  $chatDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ChatDetail $chatDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChatDetail  $chatDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ChatDetail $chatDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChatDetail  $chatDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChatDetail $chatDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChatDetail  $chatDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatDetail $chatDetail)
    {
        //
    }
}

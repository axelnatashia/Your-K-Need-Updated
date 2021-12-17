<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\CheckoutDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class CheckoutDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsLogin');
        // $this->middleware('IsSeller');
        $this->middleware('IsSeller')->except('update');
        $this->middleware('IsBuyerSeller')->only('update');
    }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CheckoutDetail  $checkoutDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CheckoutDetail $checkoutDetail)
    {
        return view('checkout_detail.detail', ['data' => $checkoutDetail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckoutDetail  $checkoutDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckoutDetail $checkoutDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckoutDetail  $checkoutDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckoutDetail $checkoutDetail)
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
            if(auth()->guard('buyer')->check()){
                $checkoutDetail->update(['status' => $request->status]);
                if($checkoutDetail->status == 'arrived'){
                    $checkout_details = CheckoutDetail::where('checkout_id', $checkoutDetail->checkout_id)->where('status', '!=', 'arrived')->get();
                    if(count($checkout_details)){
                    }else{
                        $checkoutDetail->checkout()->update(['status' => 'done']);
                    }
                }
            }else{
                $checkoutDetail->update(['status' => $request->status]);
            }
            DB::commit();
            return redirect()->back()->with(['msg' => ['type' => 'success', 'msg' => 'Status ' . $checkoutDetail->seller_product->name . ' updated successfully']]);

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckoutDetail  $checkoutDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckoutDetail $checkoutDetail)
    {
        //
    }
}

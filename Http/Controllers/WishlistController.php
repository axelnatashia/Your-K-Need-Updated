<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Wishlist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsLogin');
        $this->middleware('IsBuyer')->except('index', 'show');
        $this->middleware('IsAdminBuyer')->only('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $wishlist = [];
        if(auth()->guard('buyer')->check()){
            $wishlist = Wishlist::where('buyer_id', auth()->guard('buyer')->user()->id)->orderBy('id')->get();
        }
        return view('landing.wishlist.index', compact('wishlist'));

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
                'seller_product_id' => 'required',
            ], [],
            [
                'seller_product_id' => 'Product',
            ]);
            $request['buyer_id'] = auth()->guard('buyer')->user()->id;
            $check = Wishlist::where('buyer_id', auth()->guard('buyer')->user()->id)->where('seller_product_id', $request->seller_product_id)->first();
            if($check){
                return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Product already on wishlist']]);
            }
        DB::beginTransaction();
        try{

            $wishlist = Wishlist::create($request->all());
            DB::commit();
            return redirect()->back()->with(['msg' => ['type' => 'success', 'msg' => 'Product added to wishlist']]);

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        return view('wishlist.detail', ['data' => $wishlist]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        DB::beginTransaction();
        try {
            $wishlist->delete();
            DB::commit();
            session()->flash('msg', ['type' =>'success', 'msg' => 'Data remove from wishlist']);
            return responseApi(200, route('landing.wishlist'), 'ok');
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Error Occured']]);
        }
    }
}

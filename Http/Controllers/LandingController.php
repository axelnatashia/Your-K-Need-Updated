<?php

namespace App\Http\Controllers;

use App\Models\SellerProduct;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Paylater;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LandingController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsLogin');
        $this->middleware('IsBuyer')->only(['wishlist', 'cart', 'paylater']);
    }
    public function index() {
        $seller_product = SellerProduct::orderBy('id', 'DESC')->limit(12)->get();
        return view('landing.index', compact('seller_product'));
    }

    public function wishlist(Request $request) {
        $wishlist = Wishlist::where('buyer_id', auth()->guard('buyer')->user()->id)->with(['seller_product'])->orderBy('id', 'DESC')->get();
        return view('landing.wishlist', compact('wishlist'));
    }

    public function cart(Request $request) {
        $payment_method = PaymentMethod::all();
        $cart = Cart::where('buyer_id', auth()->guard('buyer')->user()->id)->with(['seller_product'])->orderBy('id', 'DESC')->get();
        return view('landing.cart', compact('cart', 'payment_method'));
    }

    public function paylater(Request $request) {
        $paylater = Paylater::where('buyer_id', auth()->guard('buyer')->user()->id)->first();
        if($paylater){
            return view('landing.paylater', compact('paylater'));
        }else{
            return view('landing.register_paylater');
        }
    }

    public function product_index(Request $request) {
        $search =  $request->input('q');
        if($search!=""){
            $seller_product = SellerProduct::with(['seller'])->where('name', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->orWhereHas('seller', function($q) use ($search){
                $q->where('address', 'like', '%'.$search.'%')->orWhere('province', 'like', '%'.$search.'%');
            })->simplePaginate(12);
            $seller_product->appends(['q' => $search]);
        }
        else{
            $seller_product = SellerProduct::orderBy('id', 'DESC')->simplePaginate(12);
        }
        return view('landing.product.index', compact('seller_product'));
    }

    public function product_show(Request $request, SellerProduct $sellerProduct) {
        return view('landing.product.detail', (['data'=> $sellerProduct]));
    }

    public function checkout_index(Request $request)
    {
        if ($request->ajax()) {
            $buyer_id = auth()->guard('buyer')->user()->id;
            $data = Checkout::orderBy('created_at', 'DESC')
                    ->with(['checkout_detail', 'payment_method'])
                    ->where('buyer_id', $buyer_id)
                    ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('payment_method_id', function($data){
                    return $data->payment_method->name;
                })
                ->addColumn('action', function($data){
                    return '
                    <a href="'.route('landing.checkout.edit', $data->id).'" class="btn btn-info btn-sm mr-1 text-white"><i class="fa fa-fw fa-list"></i></a>
                        ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('landing.checkout.index');
    }

    public function checkout_edit(Request $request, Checkout $checkout)
    {
        if ($request->ajax()) {
            return Datatables::of($checkout->checkout_detail)
                ->addIndexColumn()
                ->editColumn('status', function($data){
                    return returnStatusCheckoutDetail($data->status);
                })
                ->addColumn('product', function($data){
                    return $data->seller_product->name;
                })
                // ->addColumn('action', function($data){
                //     return '
                //     <button class="btn btn-warning btn-sm mr-1 text-white" onclick="modal_detail(\''.route('checkout_detail.show', $data->id).'\', \'Detail data ' . $data->seller_product->name . '\')"><i class="fa fa-fw fa-edit"></i></button>
                //         ';
                // })
                ->rawColumns(['product'])
                ->make(true);
        }
        return view('landing.checkout.edit');
    }
}

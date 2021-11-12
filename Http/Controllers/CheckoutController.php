<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\CheckoutDetail;
use App\Models\Paylater;
use App\Models\PaymentMethod;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Image;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsLogin');
        $this->middleware('IsSeller')->except('index', 'store');
        $this->middleware('IsBuyerSeller')->only('index', 'store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $seller_id = auth()->guard('seller')->user()->id;
            $data = Checkout::orderBy('created_at', 'DESC')
                    ->with(['checkout_detail', 'payment_method', 'checkout_detail.seller_product', 'checkout_detail.seller_product.seller'])
                    ->whereHas('checkout_detail.seller_product.seller', function ($query) use ($seller_id){
                        $query->where('id', $seller_id);
                    })
                    ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('payment_method_id', function($data){
                    return $data->payment_method->name;
                })
                ->addColumn('action', function($data){
                    return '
                    <a href="'.route('checkout.edit', $data->id).'" class="btn btn-warning btn-sm mr-1 text-white"><i class="fa fa-fw fa-edit"></i></a>
                        ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('checkout.index');
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
        $payment_method = PaymentMethod::where('name', 'Pay Later')->orWhere('name', 'pay later')->first();
        $total_payment = 0;
        if($request->payment_method_id == $payment_method->id){
            $paylater = Paylater::where('buyer_id', auth()->guard('buyer')->user()->id)->where('status', 'confirm')->first();
            if(!$paylater){
                return redirect()->route('landing.paylater')->with(['msg' => ['type' => 'danger', 'msg' => 'Please register to paylater first or check your paylater status']]);
            }
            foreach ($request->choose_item as $item) {
                $cart = Cart::where('id', $item)->first();
                $data_checkout_detail['qty'] = $cart->qty;
                $data_checkout_detail['price'] = $cart->seller_product->price;
                $data_checkout_detail['total_price'] = $cart->seller_product->price * $cart->qty;
                $total_payment += $data_checkout_detail['total_price'];
            }
            $half_price = (int)($total_payment / 2);
            if($paylater->balance < $half_price){
                return redirect()->route('landing.paylater')->with(['msg' => ['type' => 'danger', 'msg' => 'Pay Later Balance is not enough for this transaction']]);
            }else{
                $paylater->decrement('balance',$half_price);
                $request['already_paid'] = $half_price;
            }
        }
        
        // return $request->all();
        $request->validate(
            [
                'payment_method_id' => 'required',
                'choose_item.*' => 'required',
            ], [],
            [
                'payment_method_id' => 'Payment Method',
                'choose_item.*' => 'Choose Item',
            ]);

        DB::beginTransaction();
        try{
            $request['status'] = 'in progress';
            $request['total_payment'] = 0;
            $request['buyer_id'] = auth()->guard('buyer')->user()->id;
            $checkout = Checkout::create($request->all());
            foreach ($request->choose_item as $item) {
                $cart = Cart::where('id', $item)->first();
                
                $data_checkout_detail['checkout_id'] = $checkout->id;
                $data_checkout_detail['seller_product_id'] = $cart->seller_product_id;
                $data_checkout_detail['qty'] = $cart->qty;
                $data_checkout_detail['price'] = $cart->seller_product->price;
                $data_checkout_detail['total_price'] = $cart->seller_product->price * $cart->qty;
                // $total_payment += $data_checkout_detail['total_price'];
                $data_checkout_detail['status'] = 'in progress';
                $checkout_detail = CheckoutDetail::create($data_checkout_detail);

                $cart->delete();
            }
            $code = generateNumberTransaction($checkout->id);
            $checkout->update(['code' => $code, 'total_payment' => $total_payment]);

            DB::commit();
            return redirect()->back()->with(['msg' => ['type' => 'success', 'msg' => 'Checkout ' . $code . ' successfully']]);

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Checkout $checkout)
    {
        // return $checkout->checkout_detail;
        if ($request->ajax()) {
            return Datatables::of($checkout->checkout_detail)
                ->addIndexColumn()
                ->editColumn('status', function($data){
                    return returnStatusCheckoutDetail($data->status);
                })
                ->addColumn('product', function($data){
                    return $data->seller_product->name;
                })
                ->addColumn('action', function($data){
                    return '
                    <button class="btn btn-warning btn-sm mr-1 text-white" onclick="modal_detail(\''.route('checkout_detail.show', $data->id).'\', \'Detail data ' . $data->seller_product->name . '\')"><i class="fa fa-fw fa-edit"></i></button>
                        ';
                })
                ->rawColumns(['action', 'product'])
                ->make(true);
        }
        return view('checkout.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}

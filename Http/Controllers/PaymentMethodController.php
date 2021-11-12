<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PaymentMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsLogin');
        $this->middleware('IsAdmin');
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PaymentMethod::orderBy('id')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '
                    <button class="btn btn-info btn-sm mr-1" onclick="modal_detail(\''.route('payment_method.show', $data->id).'\', \'Detail data ' . $data->name . '\')"><i class="fa fa-fw fa-list"></i></button>
                    <a href="'.route('payment_method.edit', $data->id).'" class="btn btn-warning btn-sm mr-1 text-white"><i class="fa fa-fw fa-edit"></i></a>
                    <button class="btn btn-danger btn-sm" onclick="confirm_delete(\''.route('payment_method.destroy', $data->id).'\', \'Are you sure want to delete data ' . $data->name . ' ?\')"><i class="fa fa-fw fa-trash"></i></button>
                        ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('payment_method.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('payment_method.create');
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
                'name' => 'required|unique:payment_methods,name',
            ], [],
            [
                'name' => 'Payment Method Name',
            ]);

        DB::beginTransaction();
        try{
            $paymentMethod = PaymentMethod::create($request->all());
            DB::commit();
            return redirect()->route('payment_method.index')->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $paymentMethod->name . ' added successfully']]);

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        return view('payment_method.detail', ['data' => $paymentMethod]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('payment_method.edit', ['data' => $paymentMethod]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate(
            [
                'name' => 'required|unique:payment_methods,name,'. $paymentMethod->id,
            ], [],
            [
                'name' => 'Name',
            ]);
        DB::beginTransaction();
        try{
            $paymentMethod->update($request->all());
            DB::commit();
            return redirect()->back()->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $paymentMethod->name . ' updated successfully']]);
            // session()->flash('msg', ['type' =>'success', 'msg' => 'Data ' . $paymentMethod->code . ' updated successfully']);
            // return responseApi(200, route('payment_method.index'), 'ok');

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {

        DB::beginTransaction();
        try {
            $paymentMethod->delete();
            DB::commit();
            session()->flash('msg', ['type' =>'success', 'msg' => 'Data ' . $paymentMethod->name . ' deleted successfully']);
            return responseApi(200, route('payment_method.index'), 'ok');
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Error Occured']]);
        }
    }
}

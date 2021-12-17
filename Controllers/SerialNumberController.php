<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\SerialNumber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SerialNumberController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsLogin');
        $this->middleware('IsAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SerialNumber::orderBy('id')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($data) {
                    return $data->status ? 'Already Used' : 'Have Not Been Used';
                })
                ->addColumn('action', function($data){
                    return '
                    <button class="btn btn-info btn-sm mr-1" onclick="modal_detail(\''.route('serial_number.show', $data->id).'\', \'Detail data ' . $data->code . '\')"><i class="fa fa-fw fa-list"></i></button>
                    <button class="btn btn-success btn-sm" onclick="confirm_update(\''.route('serial_number.update', $data->id).'\', \'Are you sure want to update data ' . $data->code . ' ?\')"><i class="fa fa-fw fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="confirm_delete(\''.route('serial_number.destroy', $data->id).'\', \'Are you sure want to delete data ' . $data->code . ' ?\')"><i class="fa fa-fw fa-trash"></i></button>
                        ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('serial_number.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('serial_number.create');
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
                'code' => 'required|unique:serial_numbers,code',
            ], [],
            [
                'code' => 'Code',
            ]);
        $request['status'] = 0;

        DB::beginTransaction();
        try{
            $serialNumber = SerialNumber::create($request->all());
            DB::commit();
            return redirect()->route('serial_number.index')->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $serialNumber->code . ' added successfully']]);

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SerialNumber  $serialNumber
     * @return \Illuminate\Http\Response
     */
    public function show(SerialNumber $serialNumber)
    {
        return view('serial_number.detail', ['data' => $serialNumber]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SerialNumber  $serialNumber
     * @return \Illuminate\Http\Response
     */
    public function edit(SerialNumber $serialNumber)
    {
        return view('serial_number.edit', ['data' => $serialNumber]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SerialNumber  $serialNumber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SerialNumber $serialNumber)
    {
        $status = ($serialNumber->status) ? 0 : 1;
        DB::beginTransaction();
        try{
            $serialNumber->update(['status' => $status]);
            DB::commit();
            // return redirect()->back()->with(['msg' => ['type' => 'success', 'msg' => 'Data ' . $serialNumber->code . ' updated successfully']]);
            session()->flash('msg', ['type' =>'success', 'msg' => 'Data ' . $serialNumber->code . ' updated successfully']);
            return responseApi(200, route('serial_number.index'), 'ok');

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['msg' => ['type' => 'error', 'msg' => 'Error Occured']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SerialNumber  $serialNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(SerialNumber $serialNumber)
    {

        DB::beginTransaction();
        try {
            $serialNumber->delete();
            DB::commit();
            session()->flash('msg', ['type' =>'success', 'msg' => 'Data ' . $serialNumber->code . ' deleted successfully']);
            return responseApi(200, route('serial_number.index'), 'ok');
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with(['msg' => ['type' => 'danger', 'msg' => 'Error Occured']]);
        }
    }
}

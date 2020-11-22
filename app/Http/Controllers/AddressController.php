<?php

namespace App\Http\Controllers;
use App\address;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
            
        if ($request->ajax()) {
            $data =  address::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_address.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_address.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    
                    ->rawColumns(['action']) ->make(true);
                } 
                return view('backend.Address.list');
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
        address::updateOrCreate(
            ['id_address'          => $request->id_address],
            ['number_address'          => $request->number_address,
            'street_address'           => $request->street_address,
            'district_address'        => $request->district_address,
            'state_address'       => 1]);
        return response()->json(['success'=> 'Saved Successfully!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $address = address::find($request->id_address);
        
        return response()->json($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $address = address::find($request->id_address);
        $address->delete();
        return response()->json(['success'=>'Deleted Successfully!!!']);
    }
}

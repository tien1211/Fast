<?php

namespace App\Http\Controllers;
use App\discount;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = discount::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_dis.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_dis.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])

                    ->addColumn('start_dis',function(discount $discount){
                        return $discount->start_dis->format('d-m-Y');
                    })
                    ->addColumn('end_dis',function(discount $discount1){
                        return $discount1->end_dis->format('d-m-Y');
                    })
                    ->make(true);
        }
      
        return view('backend.Discount.list');
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
        discount::updateOrCreate(
            ['id_dis'          => $request->id_dis],
            ['topic_dis'       => $request->topic_dis,
            'content_dis'      => $request->content_dis,
            'start_dis'        => $request->start_dis,
            'end_dis'          => $request->end_dis,
           ]);
       
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
        $discount = discount::find($request->id_dis);
        return response()->json($discount);
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
        $dis = discount::find($request->id_dis);
        $dis->delete();
        return response()->json(['success'=>'Deleted Successfully!!!']);
    }
}

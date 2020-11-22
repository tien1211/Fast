<?php

namespace App\Http\Controllers;
use App\store;
use DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('store')->latest()->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
   
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_store.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_store.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])->make(true);
        }   
        return view('backend.Store.list');
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
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}

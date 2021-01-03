<?php

namespace App\Http\Controllers;
use App\category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = category::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function($row){

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_cate.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_cate.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                        return $btn;
                })
                
                ->rawColumns(['action']) ->make(true);
        }
              
        return view('backend.Category.list');
        
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
        category::updateOrCreate(
            ['id_cate'          => $request->id_cate],
            ['name_cate'          => $request->name_cate,
            'state_cate'       => 1]);
       
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
        $category = category::find($request->id_cate);
        
        return response()->json($category);
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
        $category = category::find($request->id_cate);
        
        $category->delete();
        return response()->json(['success'=>'Deleted Successfully!!!']);
    }
}

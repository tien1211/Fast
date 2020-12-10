<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\emp;

use Yajra\DataTables\DataTables;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = emp::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_emp.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                          $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_emp.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    
                    ->rawColumns(['action']) 
                    ->addColumn('birth',function(emp $emp){
                        return $emp->birth_emp->format('d-m-Y');
                    })
                    ->addColumn('gender',function(emp $emp){
                        if($emp->gender_emp == 0){
                            return "Male";
                        }else{
                            return "Female";
                        }
                    })
                    ->addColumn('per',function(emp $emp){
                        if($emp->per_emp == 0){
                            return "Admin";
                        }else if($emp->per_emp == 1){
                            return "Member";
                        }return "Shipper";
                    })
                    ->addColumn('state',function(emp $emp){
                        if($emp->state_emp == 0){
                            return "Disable";
                        }else{
                            return "Active";
                        }
                    })
                    ->make(true);
                }
              
                return view('backend.Member.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        emp::updateOrCreate(
            ['id_emp'          => $request->id_emp],
            ['username'        => $request->username,
            'password'         => $request->password,
            'name_emp'         => $request->name_emp,
            'birth_emp'        => $request->birth_emp,
            'gender_emp'       => $request->gender_emp,
            'per_emp'          => $request->per_emp, 
            'state_emp'       => 1]);
       
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
        $emp = emp::find($request->id_emp);
        
        return response()->json($emp);
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
        $emp = emp::find($request->id_emp);
        
        $emp->delete();
        return response()->json(['success'=>'Deleted Successfully!!!']);
    }
}

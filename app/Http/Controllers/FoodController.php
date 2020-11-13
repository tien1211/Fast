<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;
use Yajra\DataTables\DataTables;

class FoodController extends Controller
{
    public function getDS(){
        return Datatables::of(food::query())->make(true);
    }

    public function listFood()
    {

        return view('backend.Food.list');
        
    }


    public function index(Request $request){
        if ($request->ajax()) {
            $data = food::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_food.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_food.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('backend.Food.ds');

    }



    public function addFood(Request $request){
        food::updateOrCreate(
            ['id_food'          => $request->id_food],
            ['id_cate'          => $request->id_cate,
            'id_dis'           => $request->id_dis,
            'name_food'        => $request->name_food,
            'desc_food'        => $request->desc_food,
            'price_food'       => $request->price_food,
            'preprice_food'    => $request->preprice_food,
            'state_food'       => 1]);
       
        return response()->json(['success'=> 'Saved Successfully!!']);
    }



    // public function editFood($id){
        
    //     $food = food::find($id);

    //     return response()->json($food);
    // }
    public function editFood(Request $request){
        
        $food = food::find($request->id_food);
        
        return response()->json($food);
    }


    public function delFood(Request $request){
        $food = food::find($request->id)->delete();
        return response()->json(['success'=>'Deleted Successfully!!!']);
    }

    



}

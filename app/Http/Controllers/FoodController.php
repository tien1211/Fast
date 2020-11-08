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
}

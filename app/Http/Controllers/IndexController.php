<?php

namespace App\Http\Controllers;
use App\food;
use App\store;
use App\foodstore;
use App\category;
use App\discount;
use App\emp;
use App\comment;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{


    public function __construct(){
        $foodstore = foodstore::all();
        $category = category::all();
        $store = store::all();
        $emp = emp::all();

        view()->share('food',$foodstore);
        view()->share('category',$category);
        view()->share('store',$store);
        view()->share('emp',$emp);
    }

//Trang chủ
    public function getIndex(){
        return view('frontend.pages.indexFront');
    }
//Sản phẩm theo loại
    public function getCategoryPages(Request $request,$id){

        $categoryPages = category::find($id);
        $productPages = food::where('id_cate','=',$id)->select('*')->get();
        return view('frontend.pages.category')->with('food',$productPages);
    }
//Trang Sản phẩm 
    public function getProductPages(Request $request,$id){
//Hiển thị số sao

        // $rate = DB::table('rate')->where([['id_emp',Auth::user()->id_emp],['id_food',$id]])->first();
      
        $food = food::find($id);
        //hiển thị bình luận
        $commentList = comment::where([['idfather_cmt', null],['id_food',$id]])->get();
        //hiển thị danh sách sản phẩm đề xuất
        $relateFood = food::where('id_food','<>',$id)->inRandomOrder()->limit(4)->get();;
        return view('frontend.pages.product')
        ->with('food',$food)
        ->with('relate',$relateFood)->with('comment',$commentList);
        // ->with('rate',$rate);

        
    }

    public function getComment(Request $request,$id){
        
            $food = food::find($id);
            $commentList = comment::where([['idfather_cmt', null],['id_food',$id]])->get();
            return view('frontend.pages.comment')
            ->with('comment',$commentList);
       
        
    }
    



}

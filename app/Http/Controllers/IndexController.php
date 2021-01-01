<?php

namespace App\Http\Controllers;
use App\food;
use App\store;
use App\foodstore;
use App\category;
use App\discount;
use App\emp;
use App\comment;
use App\rate;
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
        //sản phẩm nổi bật
        
        $featured = food::join('rate','rate.id_food','=','food.id_food')->where('rate.number_rate','>',3)->inRandomOrder()->limit(8)->get();
        //sản phẩm mới
        $newFood = food::orderBy('id_food', 'desc')->inRandomOrder()->limit(8)->get();
        //Sản phẩm giảm giá
        $discountFood = food::where('id_dis','<>' ,1)->inRandomOrder()->limit(8)->get();

        return view('frontend.pages.indexFront')->with('newFood',$newFood)
        ->with('discountFood',$discountFood)
        ->with('featured',$featured);
    }
//Sản phẩm theo loại
    public function getCategoryPages(Request $request,$id){

        $categoryPages = category::find($id);
        $productPages = food::where('id_cate','=',$id)->select('*')->get();
        return view('frontend.pages.category')->with('food',$productPages);
    }

//tính số sao
    public function getRating($id){
        return (DB::table('rate')->where('id_food', $id)->avg('number_rate'));
    }
//Trang Sản phẩm 
    public function getProductPages(Request $request,$id){
//Hiển thị số sao
        $allFood = food::all();
        $rating = [];
        //đếm số người đánh giá
        $count = DB::table('rate')->where('id_food', $id)->count();
        foreach($allFood as $key => $product){
            $rating[$product->id_food] = $this->getRating($product->id_food);
        }
        
       
      
        $food = food::find($id);

        //hiển thị bình luận
        $commentList = comment::where([['idfather_cmt', null],['id_food',$id]])->get();
        //hiển thị danh sách sản phẩm đề xuất
        $relateFood = food::where('id_food','<>',$id)->inRandomOrder()->limit(4)->get();

        return view('frontend.pages.product')
        ->with('food',$food)
        ->with('rate',$rating)
        ->with('countRating',$count)
        ->with('relate',$relateFood)->with('comment',$commentList);
        // ->with('rate',$rate);

        
    }
//trang cá nhân
    public function getProfile(Request $request,$id){
        $infoMember = DB::table('emp')->where('id_emp',$id)->first(); 

        $infoBill = DB::table('bill')
        ->join('emp','emp.id_emp','=','bill.id_emp')
        ->join('delivery','delivery.id_del','=','bill.id_del')
        ->where('bill.id_emp',$id)->paginate(8);  
        
        
        
        $infoBillDetail = DB::table('bill')
        ->join('emp','emp.id_emp','=','bill.id_emp')
        ->join('billdetail','billdetail.id_bill','=','bill.id_bill')
        ->join('food','food.id_food','=','billdetail.id_food')
        ->where('bill.id_emp',$id)->get();   
    // return dd($infoBill);


        return view('frontend.pages.profile')->with('infoMember',$infoMember)
        ->with('infoBill',$infoBill)
        ->with('infoBillDetail',$infoBillDetail);
    }

//chi tiết đơn hàng
    public function getDetail(Request $request, $id){
        $infoMember = DB::table('emp')->where('id_emp',$id)->first(); 
        $infoBillDetail = DB::table('bill')
        ->join('emp','emp.id_emp','=','bill.id_emp')
        ->join('billdetail','billdetail.id_bill','=','bill.id_bill')
        ->join('food','food.id_food','=','billdetail.id_food')
        ->where('bill.id_emp',$id)->get(); 

        
        return view('frontend.pages.detailBill')->with('infoBillDetail',$infoBillDetail);
    }

//danh sách comment
    public function getComment(Request $request,$id){
        
            $food = food::find($id);
            $commentList = comment::where([['idfather_cmt', null],['id_food',$id]])->get();
            return view('frontend.pages.comment')
            ->with('comment',$commentList);
       
    }
    



}

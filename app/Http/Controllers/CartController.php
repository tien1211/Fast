<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;
use Cart;
use App\category;
use Auth;
class CartController extends Controller
{

    public function __construct(){
      
        $category = category::all();
        
        view()->share('category',$category);
       
    }

    public function getCart(){
        $cartContent = Cart::instance('cart')->content();
        return view('frontend.pages.cart')->with('cartContent',$cartContent);
        // return dd ($cart);
    }


    public function addCart(Request $request){
        
        if(!isset($request->quantity)){
            $quantity = 1;
        }else{
            $quantity = $request->quantity;
        }
        $food = food::find($request->id_food);
        $data['id']                 = $request->id_food;
        $data['name']               = $food->name_food;
        $data['qty']                = $quantity;
        $data['price']              = $food->price_food;
        $data['weight']             = 0;
        $data['options']['image']   =$food->img_food;
        $data['options']['desc']   =$food->desc_food;

        Cart::instance('cart')->add($data);
        
        return response()->json([
            'success' => 'Add Item to Cart successfuly!',
            'count' =>  Cart::instance('cart')->count()
        ]);

    }


    public function updateCart(Request $request){
        if($request->ajax()){
            Cart::instance('cart')->update($request->rowId, $request->quantity);
            $priceTotalItem = Cart::instance('cart')->get($request->rowId)->priceTotal;
            return response()->json([
                'success' => 'Delete Item successfuly!',
                'itemInCart' => Cart::instance('cart')->count(),
                'subtotal' => Cart::instance('cart')->subtotal(),
                'pSubtotal' => number_format($priceTotalItem)
            ]);
        }
        return $this->addCart();
    }


    public function deleteCart(Request $request){
        if($request->ajax()){
            Cart::instance('cart')->remove($request->rowId);
            return response()->json([
                'success' => 'Delete Item successfuly!',
                'itemInCart' => Cart::instance('cart')->count(),
                'subtotal' => Cart::instance('cart')->subtotal()
            ]);
        }
        return $this->addCart();
    }


    public function storeCart(Request $request){
        if($request->ajax()){
            if(Auth::check()){
                Cart::instance('cart')->store(Auth::user()->id_emp);
                $message = "Store successfully!";
            }else{
                $message = 'You must login!';
            } 
            return response()->json([
                'message' => $message
            ]);   
        }
        return response()->json([
            'message' => 'error'
        ]); 
    }
}

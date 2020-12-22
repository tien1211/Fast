<?php

namespace App\Http\Controllers;
use App\emp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use Session;
class AuthController extends Controller
{
    public function username(){
        return 'username';
    }

    public function getSignIn(){
        return view('frontend.view.login');
    }

    public function signIn(Request $request){
        $arr = [
            'username'=>$request->username,
            'password'=>$request->password,
        ];

       
        if (Auth::attempt($arr)) {
            Cart::instance('cart')->restore(strval(Auth::user()->id_emp));
            Cart::instance('wishlist')->restore(Auth::user()->username);
            return redirect()->route("index"); 
        } else {
            return redirect()->back()
            ->withInput()->with("error", "Sai tài khoản hoặc mật khẩu");
        }

    }


    public function signOut()
    {

        if(Auth::check()){
            if(Cart::instance('cart')->count() > 0){
                Cart::instance('cart')->store(strval(Auth::user()->id_emp));
            }
            if(Cart::instance('wishlist')->count() > 0){
                Cart::instance('wishlist')->store(Auth::user()->username); 
            }
        }

        Session::flush();
        Auth::logout();
        return redirect()->route('index');
    }
}

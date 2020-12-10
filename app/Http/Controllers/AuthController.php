<?php

namespace App\Http\Controllers;
use App\emp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->route("index"); 
        } else {
            return redirect()->back()
            ->withInput()->with("error", "Sai tài khoản hoặc mật khẩu");
        }

    }


    public function signOut()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}

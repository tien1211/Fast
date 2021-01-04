<?php

namespace App\Http\Controllers;
use App\emp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use Session;
use Redirect;
class AuthController extends Controller
{
    public function username(){
        return 'username';
    }

    public function getSignIn(){
        return view('frontend.view.signin');
    }
    public function getChangePass(){
        return view('frontend.view.changePass');
    }

    public function postChangePass(Request $request, $id){
        $usr = emp::find($id);


                $arr = [
                        'username'  => $usr->username,
                        'password'      => $request->old_password
                ];

           if (Auth::attempt($arr)) {
                    $usr->password =bcrypt($request->new_password);

                    $usr->save();

                    Session::flash('alert-success', 'Đổi mật khẩu thành công!!');
                    return redirect::back();
           }else{
                    Session::flash('alert-warning', 'Đổi Mật Khẩu Thất Bại!!');
                    return redirect::back();
           }




    }

    public function signIn(Request $request){
        $arr = [
            'username'=>$request->username,
            'password'=>$request->password,
        ];

       
        if (Auth::attempt($arr)) {
            Cart::instance('cart')->restore(strval(Auth::user()->id_emp));
            Cart::instance('wishlist')->restore(Auth::user()->username);
            return redirect()->route("adminIndex"); 
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

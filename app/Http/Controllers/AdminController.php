<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class AdminController extends Controller
{
    // login function
    public function authenticate (Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->get('remember'))){
            return redirect()->route('admin.dashboard');
        }else{
            session()->flash('error','Enter Email/Password is incorrect');
            return back()->withInput($request->only('email'));
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

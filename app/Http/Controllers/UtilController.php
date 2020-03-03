<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtilController extends Controller
{
    public function login(){
        return view('auth/login');
    }

    public function signIn(Request $re){
        $credentials = $re->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            return redirect('/app');     
            
        } else {

            return back();

        }
    }

    public function dashboard() {
        return view('app/dashboard');
    }
}

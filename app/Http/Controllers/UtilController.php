<?php

namespace App\Http\Controllers;

use App\Business;
use App\Local;
use Carbon\Carbon;
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

        
        $businessPend = Business::whereHas('enrollmentLocals', function($query){
            $query->where('is_occupied', true);
        })->whereDoesntHave('last_receipt', function($query) {
            $query->where([
                ['month', Carbon::now()->month ],
                ['year', Carbon::now()->year ],
            ]);
        })->with(['last_receipt', 'currentMonthly', 'localsOcuppied' ])
        ->get();

        $businessNormal = Business::whereHas('enrollmentLocals', function($query){
            $query->where('is_occupied', true);
        })->whereHas('last_receipt', function($query) {
            $query->where([
                ['month', Carbon::now()->month ],
                ['year', Carbon::now()->year ],
            ]);
        })->with(['last_receipt', 'currentMonthly', 'localsOcuppied' ])
        ->get();

        $moneyPend = 0;
        $moneyPayed = 0;
        foreach($businessPend as $bus) 
            $moneyPend += $bus->currentMonthly->amount;

        foreach($businessNormal as $bus) 
            $moneyPayed += $bus->currentMonthly->amount;
        

        return view('app/dashboard')->with([
            'businessPend' => $businessPend,
            'businessNormal' => $businessNormal,
            'moneyPend' => $moneyPend,
            'moneyPayed' => $moneyPayed,
        ]);
    }

    public function getBusinessSugest(Request $re) {
        return response()->json(
            Business::name($re->term)->formatSujest()->limit(10)->get()
        );
    }

    public function getUsersLesseeSugest(Request $re) {

    }

    public function getLocalSugest(Request $re) {
        return response()->json(
            Local::where('number', 'LIKE', "%$re->term%")->formatSujest()->limit(10)->get()
        );
    }
}

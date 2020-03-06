<?php

namespace App\Http\Controllers;

use App\Business;
use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    public function list(Request $re) {
        $receipts = Receipt::orderBy('created_at', 'DESC')->with('business')->paginate(15);
        return view('app/receipts/list')->with([
            'receipts' => $receipts
        ]);
    }


    public function create() {

        $business = Business::whereHas('enrollmentLocals', function($query){
            $query->where('is_occupied', true);
        })->with(['last_receipt', 'currentMonthly', 'localsOcuppied' ])
        ->get();
        
        return view('app/receipts/create')->with('business', $business);
    }

    public function store(Request $re) {

        if($re->type == 1) {
            $check = Receipt::where([
                ['month', $re->month],
                ['year', $re->year],
                ])->first();
            if($check != NULL)
                return back()->with('error', $check->description() . " del negocio " . $check->business->name . " ya fue pagada" );
        }

        
        $receipt = new Receipt();
        $receipt->creator_id = Auth::id();
        $receipt->business_id = $re->business_id;
        $receipt->user_id = $re->user_id;
        $receipt->amount = $re->amount;
        $receipt->type = $re->type;
        $receipt->year = $re->year;
        $receipt->month = $re->month;
        $receipt->save();

        return redirect('app/recibos')->with('msj', $receipt->description() . " ha sido guardado");

    }
}

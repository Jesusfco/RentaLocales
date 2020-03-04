<?php

namespace App\Http\Controllers;

use App\Business;
use App\MonthlyPayment;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function list(Request $re) {

        $objects = Business::where('name', 'LIKE',"%$re->term%" )
            ->orderBy('name','asc')            
            ->paginate(15);
        return view('app/business/list')->with('objects', $objects);
    }

    public function create(){        
        return view('app/business/create');
    }

    public function store(Request $re) {        

        $check = Business::where('name', 'LIKE', $re->name)->first();
        if($check != NULL)                    
            return back()
            ->with('error', 'Nombre de negocio repetido "'. $re->name . '" - No se puede crear otro negocio con el mismo nombre')
            ->withErrors(['name.unique', 'Nombre repetido "'. $re->name . '"'])
            ->withInput();
        $obj = new Business();
        $this->pushData($re, $obj);       
        
        $monthly = new MonthlyPayment();
        $monthly->businnes_id = $obj->id;
        $monthly->amount = $obj->amount;
        $monthly->businnes_id = $obj->date_to_pay;
        $monthly->save();
        
        return redirect('app/negocios/ver/' . $obj->id)->with('msj', 'Se ha creado un negocio con exito');

    }

    public function edit($id) {
        $obj = Business::find($id);
        return view('app/business/edit')->with('obj', $obj);
    }
    public function show($id) {
        $obj = Business::find($id);
        return view('app/business/show')->with('obj', $obj);
    }

    public function update(Request $re, $id) {
        
        $obj = Business::find($id);
        $check = Business::where('name', 'LIKE', $re->name)->first();

        if($check != NULL)
            if($check->id != $id) 
                return back()->with('error', 'Nombre repetido "'. $re->name . '" - No se puede tener mas de un negocio con el mismo nombre');

        $this->pushData($re, $obj);       
            
        return back()->with('success', 'Se ha actualizado el negocio con exito');

    }

    public function delete($id) {
        
        $n = Business::find($id);          
        $n->delete();
        return 'true';
    }

    private function pushData(Request $re, Business $obj) {
        
        $obj->name = $re->name;
        $obj->description = $re->description;
        $obj->type = $re->type;                    
        $obj->save();
                              
    }

    //Bussiness ID
    public function newMonthly($id) {
        
        $obj = Business::find($id);
        return view('app/business/new-payment')->with('obj', $obj);

    }

    public function storeMonthly(Request $re, $id) {
                
        $monthly = new MonthlyPayment();
        $monthly->business_id = $id;
        $monthly->amount = $re->amount;
        $monthly->date_to_pay = $re->date_to_pay;
        $monthly->save();
        
        return redirect('app/negocios/ver/' . $id)->with('msj', 'Mensualidad Actualizada');

    }
    public function monthlyHistory($id) {
        $business = Business::find($id);
        $objects = MonthlyPayment::orderBy('created_at','desc') 
        ->where('business_id', $id)           
        ->paginate(15);
    return view('app/business/monthlyHistory')->with([
        'objects' => $objects,
        'business' => $business,
        ]);
    }
}

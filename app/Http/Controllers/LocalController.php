<?php

namespace App\Http\Controllers;

use App\EnrollmentBusinessLocal;
use App\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    public function list(Request $re) {

        $objects = Local::orderBy('number','asc')            
            ->get();
        return view('app/locals/list')->with('objects', $objects);
    }

    public function create(){        
        return view('app/locals/create');
    }

    public function store(Request $re) {        
        
        $check = Local::where('number', 'LIKE', $re->number)->first();        
        if($check != NULL) 
            return back()
            ->with('error', 'Numero de local repetido "'. $re->number . '" - No se puede crear otro local con el mismo numbero')
            ->withErrors(['email.unique', 'Local repetido #"'. $re->number . '"'])
            ->withInput();
        $obj = new Local();
        $this->pushData($re, $obj);               
        
        return redirect('app/locales/ver/' . $obj->number)->with('msj', 'Se ha creado un local con exito');
    }

    public function edit($id) {
        $obj = Local::find($id);
        return view('app/locals/edit')->with('obj', $obj);
    }
    public function show($id) {
        $obj = Local::find($id);
        return view('app/locals/show')->with('obj', $obj);
    }

    public function update(Request $re, $id) {
        
        $obj = Local::find($id);
        $check = Local::find( $re->number);

        if($check != NULL)
            if($check->number != $id) 
                return back()->with('error', 'Numero repetido #"'. $re->number . '" - No se puede tener mas de un local con el mismo Numero');

        $this->pushData($re, $obj); 
        
        EnrollmentBusinessLocal::where('local_id', $id)->update(['local_id' => $obj->number]);

        return redirect('app/locales/edit/' . $obj->number)->with('success', 'Se ha actualizado el local con exito');        

    }

    public function delete($id) {
        
        $n = Local::find($id);          
        $n->delete();
        return 'true';
    }

    private function pushData(Request $re, Local $obj) {
        
        $obj->number = $re->number;
        $obj->description = $re->description;
        $obj->save();
                              
    }
    public function business(Request $re, $id) {

        $obj = Local::find($id);
        $objects = EnrollmentBusinessLocal::with('business')
                    ->where('local_id', $id)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(15);

                    // return "hola";
        return view('app/locals/business')->with([
            'obj' => $obj,
            'objects' => $objects,
            ]);

    }

    public function deleteBusinessEnroll($number, $business_id) {
        $obj = EnrollmentBusinessLocal::checkUnique($number, $business_id)->first();
        $obj->delete();
        return 'true';
    }

    public function enrollBusiness($id) {
        $obj = Local::find($id);
        return view('app/locals/enrollBusiness')->with('obj', $obj);
    }
}

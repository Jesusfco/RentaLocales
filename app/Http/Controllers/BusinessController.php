<?php

namespace App\Http\Controllers;

use App\Business;
use App\EnrollmentBusinessLocal;
use App\EnrollmentBusinessUser;
use App\MonthlyPayment;
use App\Receipt;
use Illuminate\Http\Request;

class BusinessController extends Controller
{

    public function __construct()
    {
        $this->middleware('myAuth');
        $this->middleware('admin');
    }
    
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
        $monthly->business_id = $obj->id;
        $monthly->amount = $re->amount;
        $monthly->date_to_pay = $re->date_to_pay;
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

    public function localList($id){
        $obj = Business::find($id);
        return view('app/business/locales')->with('obj', $obj);
    }

    public function deleteEnrollmentLocal($business_id, $local_id){
        
        $obj = EnrollmentBusinessLocal::checkUnique($local_id, $business_id)->first();
        $obj->delete();
        return 'true';

    }

    public function deleteEnrollmentUser($business_id, $user_id){
        
        $obj = EnrollmentBusinessUser::checkUnique($user_id, $business_id)->first();
        $obj->delete();
        return 'true';

    }

    public function deleteReceipt($receipt_id) {
        $obj = Receipt::find($receipt_id);
        $obj->delete();
        return 'true';
    }
    public function enrollLocal($id){
        $obj = Business::find($id);
        return view('app/business/enlazarLocal')->with('obj', $obj);
    }

    public function storeEnrollLocal($id, Request $re){

        $check = EnrollmentBusinessLocal::checkUnique($re->targetId, $id)->where('is_occupied', true)->first();         
        if($check != NULL)
            return back()->with('error',"El negocio ". $check->business->name . " ya se encuentra enlazado con el local: " . $check->local->number);

        $lastOccupied = EnrollmentBusinessLocal::where('is_occupied', true)->first();

        EnrollmentBusinessLocal::where('is_occupied', true)->update(['is_occupied' => false]);
        $lastOccupied->is_occupied = false;
        

        $obj = new EnrollmentBusinessLocal();            
        $obj->business_id = $id;
        $obj->local_id = $re->targetId;
        $obj->is_occupied = true;
        $obj->save();

        return redirect("app/negocios/ver/$id/locales")->with('msj', "El negocio ha sido enlazado, el negocio " . $lastOccupied->business->name  . 
        " ya no se encuentra enlazado a este local");

    }

    public function enrollUser($id) {
        $obj = Business::find($id);
        return view('app/business/enlazarUsuario')->with('obj', $obj);
    }

    public function storeEnrollUser($id, Request $re) {

        $check = EnrollmentBusinessUser::checkUnique($re->targetId, $id)->first();         
        if($check != NULL)
            return back()->with('error',"El Usuario ". $check->user->fullname() . " ya se encuentra enlazado.");

        return redirect("app/negocios/ver/$id/usuarios")->with('msj', "El Usuario ". $check->user->fullname() . " ha sido enlazado");
        
    }

    public function users(Request $re, $id) {
        $business = Business::find($id);
        $users = EnrollmentBusinessUser::where('business_id', $id)->with('user')->paginate(20);
        return view('app/business/users')->with([
            'obj' => $business,
            'objects' => $users,
            ]);
    }

    public function receipts($id) {
        
        $obj = Business::find($id);
        $objects = Receipt::where('business_id', $id)->orderBy('created_at', 'DESC')->paginate(20);

        return view('app/business/receipts')->with([
            'obj' => $obj,
            'objects' => $objects
            ]);

    }

}

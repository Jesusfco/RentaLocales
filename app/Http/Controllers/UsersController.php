<?php

namespace App\Http\Controllers;

use App\Business;
use App\EnrollmentBusinessUser;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function list(Request $re) {

        $objects = User::whereName($re->term)
            ->where('user_type_id', '<', 10)
            ->orderBy('name','asc')            
            ->paginate(15);
        return view('app/user/list')->with('objects', $objects);
    }

    public function create(){        
        return view('app/user/create');
    }

    public function store(Request $re) {        
        $check = NULL;
        if( $re->email != NULL)
            $check = User::where('email', 'LIKE', $re->email)->get();        
        if($check != NULL) 
            return back()
            ->with('error', 'Correo repetido "'. $re->email . '" - No se puede crear otro usuario con el mismo correo')
            ->withErrors(['email.unique', 'Correo repetido "'. $re->email . '"'])
            ->withInput();
        $obj = new User();
        $this->pushData($re, $obj);
       
        $this->show($obj->id);
        
        return redirect('app/usuarios/ver/' . $obj->id)->with('msj', 'Se ha creado un usuario con exito');
    }

    public function edit($id) {
        $obj = User::find($id);
        return view('app/user/edit')->with('obj', $obj);
    }
    public function show($id) {
        $obj = User::find($id);
        return view('app/user/show')->with('obj', $obj);
    }

    public function update(Request $re, $id) {
        
        $obj = User::find($id);
        $check = User::where('email', 'LIKE', $re->email)->first();

        if($check != NULL)
            if($check->id != $id) 
                return back()->with('error', 'Correo repetido "'. $re->email . '" - No se puede tener mas de un usuario con el mismo correo');

        $this->pushData($re, $obj);       
            
        return back()->with('success', 'Se ha actualizado el usuario con exito');

    }

    public function delete($id) {
        
        $n = User::find($id);          
        $n->delete();
        return 'true';
    }

    private function pushData(Request $re, User $obj) {
        
        $obj->name = $re->name;
        $obj->patern = $re->patern;
        $obj->matern = $re->matern;
        $obj->email = $re->email;
        $obj->phone1 = $re->phone1;
        $obj->phone2 = $re->phone2;
        if($re->password == NULL && $obj->id == NULL) $obj->password = bcrypt('secret');        
        else $obj->password = bcrypt($re->password);        
        
        // $obj->active = $re->active;         
        $obj->user_type_id = $re->user_type_id;                 
        $obj->save();
                              
    }

    public function businessList(Request $re, $id) {
        $user = User::find($id);
        $objects = Business::where('name', 'LIKE',"%$re->term%" )
        ->whereHas('enrollmentUsers',function($query) use($id) {
            $query->where('user_id', $id);
        })            
        ->paginate(15);
    return view('app/user/businessList')->with([
        'objects' => $objects,
        'user' => $user,
        ]);
    }

    public function createBusinessEnrollment($id) {
         $obj = User::find($id);
        return view('app/user/businessEnrollment')->with([            
            'obj' => $obj,
            ]);
    }

    public function storeBusinessEnrollment($id, Request $re) {
        $check = EnrollmentBusinessUser::checkUnique($id, $re->business_id)->first();         
        if($check != NULL)
            return back()->with('error',"El negocio ". $check->business->name . " ya se encuentra enlazado con el usuario: " . $check->user->fullname());

        $obj = new EnrollmentBusinessUser();            
        $obj->user_id = $id;
        $obj->business_id = $re->business_id;
        $obj->save();

        return redirect("app/usuarios/ver/$id/negocios")->with('msj', "El negocio ha sido enlazado");

    }

    public function deleteBusinessEnrollment($user_id, $business_id) { 

        $obj = EnrollmentBusinessUser::checkUnique($user_id, $business_id)->first();
        $obj->delete();
        return 'true';

    }
}

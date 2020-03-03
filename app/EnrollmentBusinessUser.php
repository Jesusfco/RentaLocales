<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollmentBusinessUser extends Model
{

    protected $fillable = [
        'business_id', 
        'user_id', 
        'relacion', 
    ]; 

    public function businnes(){
        return $this->belongsTo('App\Business')->withDefault([
            'name' => 'Negocio Desconocido',
        ]);
    }

    public function user(){
        return $this->belongsTo('App\user')->withDefault([
            'name' => 'Usuario Desconocido',
        ]);
    }

}

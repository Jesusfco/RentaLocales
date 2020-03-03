<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollmentBusinessLocal extends Model
{

    protected $fillable = [
        'business_id', 
        'local_id', 
        'is_occupped', 
    ]; 

    public function businnes(){
        return $this->belongsTo('App\Business')->withDefault([
            'name' => 'Negocio Desconocido',
        ]);
    }

    public function local(){
        return $this->belongsTo('App\Local')->withDefault([
            'description' => 'local Desconocido',
        ]);
    }
}

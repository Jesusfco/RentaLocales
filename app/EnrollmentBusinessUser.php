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

    public $timestamps = false; 

    public function business(){
        return $this->belongsTo('App\Business')->withDefault([
            'name' => 'Negocio Desconocido',
        ]);
    }

    public function user(){
        return $this->belongsTo('App\user')->withDefault([
            'name' => 'Usuario Desconocido',
        ]);
    }

    public function scopeCheckUnique($query, $id_user, $id_business) {
        return $query->where([
            ['user_id', $id_user],
            ['business_id', $id_business],
        ]);
    }

}

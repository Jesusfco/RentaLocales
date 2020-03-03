<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'amount', 
        'user_id', 
        'creator_id', 
        'business_id', 
        'month', 
        'year', 
        'type',
        'description'
    ];

    public function user(){
        return $this->belongsTo('App\user')->withDefault([
            'name' => 'Usuario Desconocido',
        ]);
    }

    public function creator(){
        return $this->belongsTo('App\user')->withDefault([
            'name' => 'Creador Desconocido',
        ]);
    }

    public function businnes(){
        return $this->belongsTo('App\Business')->withDefault([
            'name' => 'Negocio Desconocido',
        ]);
    }
}

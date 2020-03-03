<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 
        'name', 
        'street', 
        'colony', 
        'number_ext', 
        'number_int', 
        'city', 
        'state', 
        'cp'
    ];

    public function user(){
        return $this->belongsTo('App\user');
    }
}

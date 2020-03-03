<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyPayment extends Model
{
    protected $fillable = [
        'amount', 
        'business_id', 
        'date_to_pay', 
    ]; 

    public function businnes(){
        return $this->belongsTo('App\Business')->withDefault([
            'name' => 'Negocio Desconocido',
        ]);
    }
}

<?php

namespace App;

use Carbon\Carbon;
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

    public function description() {
        
        if($this->type == 1) {
            $date = new Carbon($this->created_at);
            $date->setMonth($this->month);
            return "Mensualidad $date->englishMonth - $this->year" ;
        }

        else if($this->type == 2)
            return "Deposito";

        return "";

    }

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

    public function business(){
        return $this->belongsTo('App\Business')->withDefault([
            'name' => 'Negocio Desconocido',
        ]);
    }
}

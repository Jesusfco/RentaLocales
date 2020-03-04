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

    public $timestamps = false; 

    public function business(){
        return $this->belongsTo('App\Business')->withDefault([
            'name' => 'Negocio Desconocido',
        ]);
    }

    public function local(){
        return $this->belongsTo('App\Local')->withDefault([
            'description' => 'local Desconocido',
        ]);
    }

    public function scopeCheckUnique($query, $id_local, $id_business) {
        return $query->where([
            ['local_id', $id_local],
            ['business_id', $id_business],
        ])->first();
    }
}

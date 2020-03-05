<?php

namespace App;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class EnrollmentBusinessUser extends Model
{
    public $timestamps = false; 
    protected $fillable = [
        'business_id', 
        'user_id', 
        'relacion', 
    ]; 
    // protected $primaryKey = 'user_id';

    public function delete() {
        EnrollmentBusinessUser::checkUnique($this->user_id, $this->business_id)->delete();
    }    

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

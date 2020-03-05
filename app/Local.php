<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Local extends Model
{

    protected $primaryKey = "number";
    public $incrementing = false;
    
    protected $fillable = [
        'description', 
        'number', 
    ]; 

    public function business(){
        return $this->hasManyThrough(
            'App\Business',
            'App\EnrollmentBusinessLocal', //Inter table
            'local_id', // Foreign key on INTER table...
            'id', // Foreign key on FINAL table...
            'number', // Local key on THIS model table...
            'business_id' // Local key on INTER table...
            
        );
    }

    public function delete(){
        EnrollmentBusinessLocal::where('local_id', $this->number)->delete();
        return parent::delete();
    }


    public function statusView() {
        if($this->last_enrollment != NULL)
            if($this->last_enrollment->is_occupied)
                return "Arrendado: <a href='" . url('app/negocios/ver',$this->last_enrollment->business_id ) ."'>" . $this->last_enrollment->business->name . '</a>';
        
        return "Disponible para Renta";
    }

    public function enrollments() {
        return $this->hasMany('App\EnrollmentBusinessLocal', 'local_id', 'number');
    }

    public function last_enrollment() {
        return $this->hasOne('App\EnrollmentBusinessLocal', 'local_id', 'number')->latest();
    }

    public function description_resume(){
        return $this->description;
    }

    public function scopeFormatSujest($query) {
        return $query->select(DB::raw("number AS value"), DB::raw("number AS data"));
    }
}

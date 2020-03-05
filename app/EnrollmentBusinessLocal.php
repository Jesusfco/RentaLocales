<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use Carbon\Carbon;

class EnrollmentBusinessLocal extends Model
{

    protected $fillable = [
        'business_id', 
        'local_id', 
        'is_occupied', 
    ]; 

    // public $timestamps = false; 

    // protected $primaryKey = ['business_id', 'local_id'];

    public function periodo() {
        $carbon = new Carbon($this->created_at);

        $string = $carbon->toFormattedDateString() . " - ";
        if($this->created_at != $this->updated_at) {
            $carbon = new Carbon($this->updated_at);
            $string .= $carbon->toFormattedDateString();
        } else {
            $string .= "Actual";
        }
        return $string;
    }
    public function delete() {
        EnrollmentBusinessLocal::checkUnique($this->local_id, $this->business_id)->delete();
    }    

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

    public function scopeCheckUnique($query, $local_id, $business_id) {
        return $query->where([
            ['local_id', $local_id],
            ['business_id', $business_id],
        ]);
    }

    
}

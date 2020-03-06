<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Business extends Model
{

    protected $fillable = [
        'name', 
        'description', 
        'type', 
    ]; 
   
    public function receipts() {
        return $this->hasMany('App\Receipt');
    }

    public function delete() {
        EnrollmentBusinessLocal::where('business_id', $this->id)->delete();
        EnrollmentBusinessUser::where('business_id', $this->id)->delete();
        return parent::delete();
    }

    public function users(){
        return $this->hasManyThrough(
            'App\User',
            'App\EnrollmentBusinessUser', //Inter table
            'business_id', // Foreign key on INTER table...
            'id', // Foreign key on FINAL table...
            'id', // Local key on THIS model table...
            'user_id' // Local key on INTER table...
            
        );
    }

    
    public function locals(){
        return $this->hasManyThrough(
            'App\Local',
            'App\EnrollmentBusinessLocal', //Inter table
            'business_id', // Foreign key on INTER table...
            'number', // Foreign key on FINAL table...
            'id', // Local key on THIS model table...
            'local_id' // Local key on INTER table...
            
        );
    }

    public function getLocalsView(){
        $string = '';
        foreach($this->enrollmentLocals as $enroll)
            $string .= "#$enroll->local_id ";
        return $string;
    }

    public function enrollmentUsers() {
        return $this->hasMany('App\EnrollmentBusinessUser');
    }

    public function localsOcuppied() {
        return $this->hasMany('App\EnrollmentBusinessLocal')->where('is_occupied', true);
    }
    public function enrollmentLocals() {
        return $this->hasMany('App\EnrollmentBusinessLocal');
    }

    public function monthly_payments() {
        return $this->hasMany('App\MonthlyPayment');
    }

    public function currentMonthly() {
        return $this->hasOne('App\MonthlyPayment')->latest();
    }

    public function last_receipt() {
        return $this->hasOne('App\Receipt')->withDefault([
            'created_at' => NULL,
        ])->latest();
    }

    public function scopeName($query, $name) {
        return $query->where('name', 'LIKE', '%' . $name . '%');
    }

    public function scopeFormatSujest($query) {
        return $query->select(DB::raw("name AS value"), DB::raw("id AS data"));
    }
    
}

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

    public function enrollmentUsers() {
        return $this->hasMany('App\EnrollmentBusinessUser');
    }

    public function monthly_payments() {
        return $this->hasMany('App\MonthlyPayment');
    }

    public function currentMonthly() {
        return $this->hasOne('App\MonthlyPayment')->latest();
    }

    public function last_receipt() {
        return $this->hasOne('App\Receipt')->latest();
    }

    public function scopeName($query, $name) {
        return $query->where('name', 'LIKE', '%' . $name . '%');
    }

    public function scopeFormatSujest($query) {
        return $query->select(DB::raw("name AS value"), DB::raw("id AS data"));
    }
    
}

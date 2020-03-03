<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function monthly_payments() {
        return $this->hasMany('App\MonthlyPayment');
    }

    public function currentMonthly() {
        return $this->hasMany('App\MonthlyPayment')->latest();
    }

    public function last_receipt() {
        return $this->hasOne('App\Receipt')->latest();
    }
    
}

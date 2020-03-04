<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{

    protected $primaryKey = "number";
    public $incrementing = false;
    
    protected $fillable = [
        'description', 
        'number', 
    ]; 

    public function description_resume(){
        return $this->description;
    }
}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'patern', 'matern', 'phone1', 'phone2','user_type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function type() {
        if($this->user_type_id == 1) return 'Arrendatario';
        return "Arrendador";
    }

    public function fullname() { return "$this->name $this->patern $this->matern"; }

    public function scopeFormatSujest($query) {
        return $query->select(DB::raw("CONCAT(`name`, ' ', IFNULL(`patern`, ''), ' ', IFNULL(`matern`, '')) AS value"), DB::raw("id AS data"));
    }

    public function scopeWhereName($query, $name) {
        return $query->where(DB::raw("CONCAT(`name`, ' ', IFNULL(`patern`, ''), ' ', IFNULL(`matern`, ''))"), 'LIKE', '%' . $name . '%');
    }

    public function business(){
        return $this->hasManyThrough(
            'App\Business',
            'App\EnrollmentBusinessUser', //Inter table
            'user_id', // Foreign key on INTER table...
            'id', // Foreign key on FINAL table...
            'id', // Local key on THIS model table...
            'business_id' // Local key on INTER table...
            
        );
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Supervisor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [ 
        'name',  
        'email',
        'password'
    ];

    public function lawyers(){
       return $this->hasMany(Lawyer::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Lawyer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guards = [];
    protected $fillable = [
     'supervisor_id',
     'name',
     'email',
     'phone_number',
     'address',
     'password'
    ];

    public function supervisor(){
        return $this->belongsTo(Supervisor::class);
    }
}

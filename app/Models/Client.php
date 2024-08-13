<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
      'supervisor_id',
      'lawyer_id',
      'name',
      'email',
      'password'
    ];
}
//  Client::create(['supervisor_id'=>1, 'name'=>'ct1', 'email'=> 'cmaillient1@email.com', 'password'=>'123456']);
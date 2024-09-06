<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'supervisor_id',  
        'payment_date',
        'total_amount',
        'valid_date'
    ];
}

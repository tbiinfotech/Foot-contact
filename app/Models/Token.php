<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $table= 'device_token'; 
    protected $fillable = [
        'user_id',
        'device_token',
    ];
}
 
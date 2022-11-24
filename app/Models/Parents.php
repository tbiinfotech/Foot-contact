<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    protected $table= 'parents';
    protected $fillable = [
        'first_name', 
        'last_name',
        'user_id',
    ];
}

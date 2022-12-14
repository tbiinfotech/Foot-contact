<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trophies extends Model
{
    use HasFactory;
    protected $table= 'trophies'; 
    protected $fillable = [
        'club_id',
        'status',
        'name',
        'image',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachRole extends Model
{
    use HasFactory;
    protected $table= 'coach_roles'; 
    protected $fillable = [
        'user_id',
        'role_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachGroup extends Model
{
    use HasFactory;
    protected $table= 'coach_groups'; 
    protected $fillable = [
        'user_id',
        'group_id',
      
    ];
}

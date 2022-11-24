<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerGroup extends Model
{
    use HasFactory;
    protected $table= 'player_groups'; 
    protected $fillable = [
        'user_id',
        'group_id',
    ];
}

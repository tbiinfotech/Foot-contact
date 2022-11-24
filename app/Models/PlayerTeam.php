<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerTeam extends Model
{
    use HasFactory;
    protected $table= 'player_teams'; 
    protected $fillable = [
        'user_id',
        'team_id'
    ];
    
    
}

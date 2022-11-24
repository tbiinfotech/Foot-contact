<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachTeam extends Model
{
    use HasFactory;
    protected $table= 'coach_teams'; 
    protected $fillable = [
        'user_id',
        'team_id',
      
    ];
}
 
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory; 
    protected $table= 'match'; 
    protected $fillable = [
        'event_type_id',
        'match_type_id',
        'club_name',
        'sport_category_id',
        'team',
        'opponent_team',
        'is_home',
        'date',
        'appointment_time',
        'fixture_time',
        'end_time',
        'address',
        'additional_info',
        'score',
        'scores',
        'assists',
        'status',
        'created_at',
        'updated_at'
    ];
}

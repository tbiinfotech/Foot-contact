<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachEventPlayer extends Model
{
    use HasFactory;
    protected $table = 'coach_event_player';
    protected $fillable = [
        'coach_id',
        'event_id',
        'is_accept',
        'is_present',
        'player_id',
        'status'
    ];
    public function getPlayer($id)
    {
       $palyer= User::where(['id'=>$id])->first();
       return $palyer;
    }
}

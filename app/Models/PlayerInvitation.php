<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerInvitation extends Model
{
    use HasFactory;
    protected $table = 'player_invitation';
    protected $fillable = [
        'event_id',
        'user_id',
        'is_accept'
    ];
}

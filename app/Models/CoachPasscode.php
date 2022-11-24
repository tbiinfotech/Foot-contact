<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachPasscode extends Model
{
    use HasFactory;
    protected $table = 'coach_passcode';
    protected $fillable = [
        'user_id',
        'title',
        'passcode'
    ];
}

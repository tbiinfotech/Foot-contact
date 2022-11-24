<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traning extends Model
{
    use HasFactory;
    protected $table = 'training';
    protected $fillable = [
        'event_type_id',
        'club_name',
        'sport_category_id',
        'team',
        'date',
        'start_time',
        'end_time',
        'is_recurrent',
        'status',
        'created_at',
        'updated_at'
    ];
}

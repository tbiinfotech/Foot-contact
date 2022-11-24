<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchType extends Model
{
    use HasFactory;
    protected $table= 'match_type';
    protected $fillable = [
        'title',
        'status'
    ];
}

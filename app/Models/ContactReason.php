<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactReason extends Model
{
    use HasFactory;
    protected $table= 'contact_reason';
    protected $fillable = [
        'title',
        'status',
        'description'
        
    ];
}

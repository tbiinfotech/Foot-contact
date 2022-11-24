<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ContactReason;

class ContactUs extends Model
{
    use HasFactory;
    protected $table= 'contact_us';
    protected $fillable = [
        'contact_reason_id',
        'message',
        'status'
    ];
    public function contactReason(){
        return $this->hasOne('App\Models\ContactReason');

    }
}

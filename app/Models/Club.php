<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    protected $table= 'clubs'; 
    protected $fillable = [
        'user_id',
        'name',
        'official_id_number',
        'logo',
        'president',
        'main_address',
        'city',
        'postal_code',
        'official_email',
        'contact_email',
        'phone_number',
        'website_url',
        'federation_page_link',
        'facebook',
        'instagram',
        'twitter',
      
    ];
    public function currentpage()
    {
        $current_page=  request()->get('page');
        if(empty($current_page)){
            $current_page=  1;
        }
        return $current_page;
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
    public function currentpage()
    {
        $current_page=  request()->get('page');
        if(empty($current_page)){
            $current_page=  1;
        }
        return $current_page;
    }
}

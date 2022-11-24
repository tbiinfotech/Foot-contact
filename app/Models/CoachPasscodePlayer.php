<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachPasscodePlayer extends Model
{
    use HasFactory;
    protected $table = 'coach_passcode_player';
    protected $fillable = [
        'coach_id',
        'player_id',
        'coach_passcode_id'
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

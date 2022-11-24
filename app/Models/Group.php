<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group extends Model
{
    use HasFactory;

    const PLAYER = 1;
    const COACH = 2;
    const TEAM = 3;
    protected $table = 'groups';
    protected $fillable = [
        'name',
        'description',
        'logo',
        'status',
        'user_id'

    ];

    public function getCount($id, $type)
    {
        if ($type == Group::PLAYER) {
            $data = PlayerGroup::where(['group_id' => $id])->count();
        } elseif ($type == Group::TEAM) {
            $data =  TeamGroup::where(['group_id' => $id])->count();
        } else {
            $data = CoachGroup::where(['group_id' => $id])->count();
        }
        return $data;
    }
    public function getPlayer() 
    {
        return $this->hasMany(PlayerGroup::class);
    }
    public function currentpage()
    {
        $current_page=  request()->get('page');
        if(empty($current_page)){
            $current_page=  1;
        }
        return $current_page;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';
    protected $fillable = [
        'club_info_id',
        'club_admin_id',
        'category',
        'team_rank',
        'year_limit',
        'team_name',
        'image',
        'gender',
        'season',
        'teamcode',
        'championship'

    ];

    public function currentpage()
    {
        $current_page =  request()->get('page');
        if (empty($current_page)) {
            $current_page =  1;
        }
        return $current_page;
    }
    public function teamCoach($id)
    {
        $list = [];
        $team_coachs = DB::table('coach_teams')
            ->select('users.*')
            ->Join('users', 'coach_teams.user_id', '=', 'users.id')
            ->where(['coach_teams.team_id' => $id])->get();
        foreach ($team_coachs as $team_coach) {
            $a['id'] = $team_coach->id;
            $a['name'] = $team_coach->name;
            if (!empty($a)) {
                $a['image'] = "http://15.188.226.196/public" . '/Uploads/profile-picture.jpg';
                if ($team_coach->image)
                    $a['image'] = "http://15.188.226.196/public/Uploads/" . $team_coach->image;
            }
            $list[] = $a;
        }
        return $list;
    }
    public function teamPlayer($id)
    {
        $list = [];
        $team_players =  DB::table('player_teams')
            ->select('users.*')
            ->Join('users', 'player_teams.user_id', '=', 'users.id')
            ->where(['player_teams.team_id' => $id])->get();
        foreach ($team_players as $team_player) {
            $a['id'] = $team_player->id;
            $a['name'] = $team_player->name;
            if (!empty($a)) {
                $a['image'] = "http://15.188.226.196/public" . '/Uploads/profile-picture.jpg';
                if ($team_player->image)
                    $a['image'] = "http://15.188.226.196/public/Uploads/" . $team_player->image;
            }
            $list[] = $a;
        }
        return $list;
    }
}

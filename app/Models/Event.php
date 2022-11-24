<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;

    const CANCEL = 2;
    const EVENT_MATCH = 1;
    const EVENT_TRAINING = 2;
    const GENERAL_EVENT = 3;
    const LEAGUE = 1;
    const CUP_GAME = 2;
    const FRINDLY = 3;
    const HOME = 1;
    const AWAY = 2;

    protected $table = 'event';
    protected $fillable = [
        'event_type_id',
        'match_type_id',
        'club_name',
        'sport_category_id',
        'team',
        'opponent_team',
        'is_home',
        'date',
        'image',
        'appointment_time',
        'fixture_time',
        'end_time',
        'address',
        'latitude',
        'longitude',
        'additional_info',
        'score',
        'type',
        'scores',
        'assists',
        'is_recurrent',
        'title',
        'status',
        'user_id',
        'created_at',
        'updated_at'
    ];
    public function opponentTeam($id)
    {
        
        $team = Team::find($id);
        $title= isset($team->title)?$team->title:'';
        return $title;
    }
    public function eventPlayerList($id)
    {
        $data = [];
        $models =   DB::table('users')
            ->select('users.first_name', 'users.last_name', 'users.image', 'coach_event_player.*')
            ->leftJoin('coach_event_player', 'users.id', '=', 'coach_event_player.player_id')
            ->where([
                'coach_event_player.event_id' => $id
            ])
            ->get();
        foreach ($models as $model) {
            $a['id'] = $model->player_id;
            $a['name'] = $model->first_name . ' ' . $model->last_name;
            $a['image'] =    "http://15.188.226.196/public" . '/Uploads/match.jpg';
            if ($model->image)
            $a['image'] = "http://15.188.226.196/public/Uploads/" . $model->image;
            $a['checkbox'] =  true;
            $data[] = $a;
        }
        return $data;
    }
}

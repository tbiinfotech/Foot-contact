<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\CoachPasscodePlayer;
use App\Models\CoachTeam;
use App\Models\PlayerTeam;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;

class TeamController extends Controller
{
    //list of team
    public function playerTeamList()
    {
        try {
            $list = [];
            $id =  auth()->user()->id;

            //every player have one coach according to passcode get the coach of the team
            $player = CoachPasscodePlayer::where(['player_id' => $id])->first();
            if (!empty($player)) {
                $datas = DB::table('teams')
                    ->select('teams.*')
                    ->Join('coach_teams', 'teams.id', '=', 'coach_teams.team_id')
                    ->where(['coach_teams.user_id' => $player->coach_id])
                    ->get();

                foreach ($datas as $data) {
                    $is_join =  PlayerTeam::where([
                        'user_id' => Auth::user()->id,
                        'team_id' => $data->id
                    ])->first();
                    if (!empty($is_join)) {
                        $join = '1';
                    } else {
                        $join = '0';
                    }
                    $a['id'] = $data->id;
                    $a['club_info_id'] = $data->club_info_id;
                    $a['club_admin_id'] = $data->club_admin_id;
                    $a['category'] = $data->category;
                    $a['team_rank'] = $data->team_rank;
                    $a['year_limit'] = $data->year_limit;
                    $a['team_name'] = $data->team_name;
                    $a['image'] = "http://15.188.226.196/public" . '/Uploads/profile-picture.jpg';
                    if ($data->image)
                        $a['image'] = "http://15.188.226.196/public/Uploads/" . $data->image;
                    $a['season'] = $data->season;
                    $a['teamcode'] = $data->teamcode;
                    $a['championship'] = $data->championship;
                    $a['gender'] = $data->gender;
                    $a['is_join'] = $join;
                    $list[] = $a;
                }
                return response()->json([
                    'success' => true,
                    'data' => $list,
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 400);
        }
    }
    public function coachTeamList()
    {
        // try {
            $list = [];
            $id =  auth()->user()->id;
            if (auth()->user()->role_id == 3) {

                $datas = DB::table('teams')
                    ->select('teams.*')
                    ->Join('coach_teams', 'teams.id', '=', 'coach_teams.team_id')
                    ->where(['coach_teams.user_id' => $id])
                    ->get();
            } else {
                $player = CoachPasscodePlayer::where(['player_id' => $id])->first();
                if (!empty($player)) {
                    $d1 = DB::table('teams')
                        ->select('teams.*')
                        ->Join('coach_teams', 'teams.id', '=', 'coach_teams.team_id')
                        ->where(['coach_teams.user_id' => $player->coach_id]);
                    $datas = DB::table('teams')
                        ->select('teams.*')
                        ->Join('coach_teams', 'teams.id', '=', 'coach_teams.team_id')
                        ->where(['coach_teams.user_id' =>  $id])
                        ->union($d1)->get();
                     
                }
            }

            foreach ($datas as $data) {
                $a['id'] = $data->id;
                $a['club_info_id'] = $data->club_info_id;
                $a['club_admin_id'] = $data->club_admin_id;
                $a['category'] = $data->category;
                $a['team_rank'] = $data->team_rank;
                $a['year_limit'] = $data->year_limit;
                $a['team_name'] = $data->team_name;
                $a['image'] = "http://15.188.226.196/public" . '/Uploads/profile-picture.jpg';

                if ($data->image)
                    $a['image'] = "http://15.188.226.196/public/Uploads/" . $data->image;
                $a['season'] = $data->season;
                $a['teamcode'] = $data->teamcode;
                $a['championship'] = $data->championship;
                $a['gender'] = $data->gender;
                $list[] = $a;
            }
            return response()->json([
                'success' => true,
                'data' => $list,
            ], 200);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Data not found'
        //     ], 400);
        // }
    }
    public function joinTeam(Request $request)
    {
        try {
            $request = json_decode(file_get_contents("php://input"), true);
            $id = $request['id'];
            $teamcode = $request['teamcode'];
            $message = '';
            $auth_user =  auth()->user()->id;
            $team = Team::where(['id' => $id, 'teamcode' => $teamcode])->first();
            if (!empty($team)) {
                $exist_as_coach = CoachTeam::where([
                    'team_id' => $id,
                    'user_id' => $auth_user
                ])->first();
                $exist_as_player = PlayerTeam::where([
                    'team_id' => $id,
                    'user_id' => $auth_user
                ])->first();
                if (empty($exist_as_player) && empty($exist_as_coach)) {
                    PlayerTeam::create([
                        'team_id' => $id,
                        'user_id' => $auth_user
                    ]);
                    $message = "You add successfuly";
                } else {
                    $message = "You are already member";
                }

                return response()->json([
                    'success' => true,
                    'message' => $message
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'wrong code'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 400);
        }
    }

    public function teamDetail($id)
    {
        try {
            $team = [];
            $a =  Team::where(['id' => $id])->first();
            if (!empty($a)) {
                $a['img'] = "http://15.188.226.196/public" . '/Uploads/profile-picture.jpg';
                if ($a->image) {
                    $a['img'] = "http://15.188.226.196/public/Uploads/" . $a->image;
                }
                $a['team_coach'] = $a->teamCoach($a->id);
                $a['team_player'] = $a->teamPlayer($a->id);
                $team[] = $a;
                return response()->json([
                    'success' => true,
                    'data' => $team,
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 400);
        }
    }
}

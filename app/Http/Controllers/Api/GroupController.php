<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoachEventPlayer;
use App\Models\CoachGroup;
use App\Models\CoachPasscodePlayer;
use App\Models\Event;
use App\Models\Group;
use App\Models\Notes;
use App\Models\PlayerGroup;
use App\Models\PlayerTeam;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    //list of group
    public function list()
    {
        try {
            $list = [];
            $id =  auth()->user()->id;
            $datas = DB::table('groups')
                ->select('groups.*')
                ->Join('player_groups', 'groups.id', '=', 'player_groups.group_id')
                ->where(['player_groups.user_id'])
                ->get();
            foreach ($datas as $data) {
                $a['id'] = $data->id;
                $a['name'] = $data->name;
                $a['description'] = $data->description;
                $a['logo'] = "http://15.188.226.196/public" . '/Uploads/profile-picture.jpg';
                if ($data->logo)
                    $a['logo'] = "http://15.188.226.196/public/Uploads/" . $data->logo;
                $a['status'] = $data->status;
                $list[] = $a;
            }
            return response()->json([
                'success' => true,
                'data' => $list,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 400);
        }
    }

    //group details
    public function groupDetail($id)
    {
        try {
            $group = [];
            $a =  Group::where(['id' => $id])->first();
            if (!empty($a)) {
                $a['logo'] =  "http://15.188.226.196/public" . '/Uploads/profile-picture.jpg';
                if ($a->image)
                    $a['logo'] =  "http://15.188.226.196/public/Uploads/" . $a->image;
            }
            $a['group_member'] =  PlayerGroup::where(['group_id' => $id])->count();
            $group[] = $a;
            if (!empty($group)) {
                $user_id =  Auth::user()->id;
                $data = [
                    'group' => $group,
                ];
            }
            return response()->json([
                'success' => true,
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 400);
        }
    }
    /**
     * Group Team List
     */
    public function teamList($group_id)
    {
        try {
            $data = DB::table('team_groups')
                ->select('teams.*')
                ->Join('teams', 'team_groups.team_id', '=', 'teams.id')
                ->where(['team_groups.group_id' => $group_id])
                ->get();
            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 400);
        }
    }

    /**
     * Group Player List
     */
    public function groupPlayer($group_id)
    {
        try {
            $datas = DB::table('player_groups')
                ->select('users.*')
                ->Join('users', 'player_groups.user_id', '=', 'users.id')
                ->where(['player_groups.group_id' => $group_id])
                ->get();
            foreach ($datas as $data) {
                $a['id'] = $data->id;
                $a['name'] = $data->first_name . ' ' . $data->last_name;
                $a['image'] = "http://15.188.226.196/public" . '/Uploads/profile-picture.jpg';
                if ($data->image)
                    $a['image'] = "http://15.188.226.196/public/Uploads/" . $data->image;
                $list[] = $a;
            }
            return response()->json([
                'success' => true,
                'data' => $list
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 400);
        }
    }
    /**
     * Group Coach List
     */
    public function groupCoach($group_id)
    {
        try {
            $datas = DB::table('coach_groups')
                ->select('users.*')
                ->Join('users', 'coach_groups.user_id', '=', 'users.id')
                ->where(['coach_groups.group_id' => $group_id])
                ->get();
            foreach ($datas as $data) {
                $a['id'] = $data->id;
                $a['name'] = $data->first_name . ' ' . $data->last_name;
                $a['image'] =  "http://15.188.226.196/public" . '/Uploads/profile-picture.jpg';
                if ($data->image)
                    $a['image'] =  "http://15.188.226.196/public/Uploads/" . $data->image;
                $list[] = $a;
            }
            return response()->json([
                'success' => true,
                'data' => $list
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 400);
        }
    }

    /**
     * Team Player
     */
    public function teamPlayer()
    {
        try {
            $list = [];
            $request = json_decode(file_get_contents("php://input"), true);
            $team_id = $request['team_id'];
            $data = DB::table('player_teams')
                ->select('users.*', 'player_teams.id as player_team_id')
                ->Join('users', 'player_teams.user_id', '=', 'users.id')
                ->where(['player_teams.team_id' => $team_id])
                ->get();
            foreach ($data as $dat) {
                $player_count =  PlayerTeam::where(['user_id' => $dat->id])->count();
                $a['id'] = $dat->player_team_id;
                $a['player_id'] = $dat->id;
                $a['name'] = $dat->first_name . ' ' . $dat->last_name;
                $a['image'] =  "http://15.188.226.196/public" . '/Uploads/profile-picture.jpg';
                if ($dat->image)
                    $a['image'] =  "http://15.188.226.196/public/Uploads/" . $dat->image;
                $a['player_count'] = $player_count;
                $list[] = $a;
            }
            return response()->json([
                'success' => true,
                'data' => $list
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 400);
        }
    }
    /**
     * List of all event according to coach
     */
    public function coach_event($page)
    {
        try {
            $current_date = date("Y-m-d", strtotime(date("Y-m-d")));
            $request = json_decode(file_get_contents("php://input"), true);
            $user_id =   Auth::user()->id;
            $role_id = Auth::user()->role_id;
            $limit = 5;
            $offset = ($limit * $page) - $limit;
            $eventModel = new Event();
            $data = [];
            //player role
            if ($role_id == 4) {
                $coach_of_palyer = CoachPasscodePlayer::where(['player_id' => $user_id])->first();
                if (!empty($coach_of_palyer)) {
                // get the club and player's coach event
                $club_id = User::where(['id' => $coach_of_palyer->coach_id])->first();
                if (!empty($club_id)) {
                    $user_ids = $coach_of_palyer->coach_id . "," . $club_id->created_by_id;
                    $user_ids = explode(",", $user_ids);
                    $events = Event::whereIn('status', [0, 1, 3])
                    ->whereIn('user_id', $user_ids)
                       ->whereDate('date', '>=', date('Y-m-d'))
                        ->orderBy('date', 'ASC')->offset($offset)
                        ->limit(10)->get();
                    foreach ($events as $event) {
                        $check_player = DB::table('event')
                        ->select('event.*')
                        ->Join('player_teams', 'event.opponent_team', '=', 'player_teams.team_id')
                        ->where([
                            'player_teams.user_id' => $user_id,
                        ])
                        ->first();
                        $event_player_count = CoachEventPlayer::where(['event_id' => $event->id, 'is_accept' => 1])->count();
                        $team_name = Team::where(['id' => $event->sport_category_id])->first();
                        $opponent_team_name = Team::where(['id' => $event->opponent_team])->first();
                        $a = $event;
                        $a['team_name'] = isset($team_name->title) ? $team_name->title : '';
                        $a['date'] = date('d/m/Y', strtotime($event->date));
                        $a['event_player_count'] = $event_player_count;
                        $a['opponent_team_name'] = isset($opponent_team_name->team_name) ? $opponent_team_name->team_name : '';
                        $a['event_player_list'] = $eventModel->eventPlayerList($event->id);

                        if (!empty($check_player)) {
                            $a['is_request'] = '1';
                            if (!empty($check_player->image)) {
                                $a['image'] =  "http://15.188.226.196/public/Uploads/" . $check_player->image;
                            } else {
                                if ($check_player->event_type_id == 1) {
                                    $a['image'] =   "http://15.188.226.196/public" . '/Uploads/match.jpg';
                                } elseif ($check_player->event_type_id == 2) {
                                    $a['image'] =   "http://15.188.226.196/public" . '/Uploads/general.jpg';
                                } else {
                                    $a['image'] =  "http://15.188.226.196/public" . '/Uploads/traning.jpg';
                                }
                            }
                            $a['player_event_id'] = $check_player->id;
                            $a['is_accept'] = "";
                        } else {
                            if (!empty($event->image)) {
                                $a['image'] = "http://15.188.226.196/public/Uploads/" . $event->image;
                            } else {
                                if ($event->event_type_id == 1) {
                                    $a['image'] =    "http://15.188.226.196/public" . '/Uploads/match.jpg';
                                } elseif ($event->event_type_id == 2) {
                                    $a['image'] =    "http://15.188.226.196/public" . '/Uploads/general.jpg';
                                } else {
                                    $a['image'] =   "http://15.188.226.196/public" . '/Uploads/traning.jpg';
                                }
                            }
                            $a['is_request'] =0;
                            $a['player_event_id'] = 0;
                            $a['is_accept'] = 0;
                        }
                        $data[] = $a;
                    }
                }
            }
            } else {

                $club = User::where(['id' => $user_id])->first();
                if (!empty($club)) {
                    $user_ids = $user_id . "," . $club->created_by_id;
                    $user_ids = explode(",", $user_ids);
                    $events = Event::whereIn('status', [0, 1, 3])
                        ->whereIn('user_id', $user_ids)
                        ->whereDate('date', '>=', date('Y-m-d'))
                        ->orderBy('date', 'ASC')
                        ->offset($offset)
                        ->limit(10)
                        ->get();
                } else {
                    $events = Event::whereIn('status', [0, 1, 3])
                        ->where(['user_id' => $user_id])
                        ->whereDate('date', '>=', date('Y-m-d'))
                        ->orderBy('date', 'ASC')
                        ->offset($offset)
                        ->limit(10)
                        ->get();
                }
                foreach ($events as $event) {
                    $event_player_count = CoachEventPlayer::where(['event_id' => $event->id, 'is_accept' => 1])->count();
                    $team_name = Team::where(['id' => $event->sport_category_id])->first();
                    $opponent_team_name = Team::where(['id' => $event->opponent_team])->first();
                    $a = $event;
                    $a['team_name'] = isset($team_name->title) ? $team_name->title : '';
                    $a['date'] = date('d/m/Y', strtotime($event->date));
                    $a['event_player_count'] = $event_player_count;
                    $a['opponent_team_name'] = isset($opponent_team_name->team_name) ? $opponent_team_name->team_name : '';
                    $a['event_player_list'] = $eventModel->eventPlayerList($event->id);

                    if (!empty($event->image)) {
                        $a['image'] = "http://15.188.226.196/public/Uploads/" . $event->image;
                    } else {
                        if ($event->event_type_id == 1) {
                            $a['image'] =  "http://15.188.226.196/public/Uploads/match.jpg";
                        } elseif ($event->event_type_id == 2) {
                            $a['image'] =   "http://15.188.226.196/public/Uploads/general.jpg";
                        } else {
                            $a['image'] =  "http://15.188.226.196/public/Uploads/traning.jpg";
                        }
                    }
                    $data[] = $a;
                }
            }
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Event List'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }

    /**
     * Player detail
     */
    public function playerDetail($id)
    {
        try {
            $data = User::where(['id' => $id])->first();
            $list = [];
            $a['id'] = $data->id;
            $a['name'] = $data->first_name . ' ' . $data->last_name;
            $a['image'] =  "http://15.188.226.196/public" . '/Uploads/profile-picture.jpg';
            if ($data->image)
                $a['image'] = "http://15.188.226.196/public/Uploads/" . $data->image;
            $a['email'] = $data->email;
            $a['phone'] = $data->phone;
            $a['created_at'] = $data->created_at;
            $a['common_group'] = PlayerGroup::where(['user_id' => $id])->count();
            $a['event'] = PlayerTeam::where(['user_id' => $id])->count();
            $list[] = $a;
            return response()->json([
                'success' => true,
                'data' => $list
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 400);
        }
    }
    /**
     * Coach children detail
     */
    public function childrenList()
    {
        try {
            $user_id =   Auth::user()->id;
            $group_list = CoachGroup::distinct('group_id')->pluck('group_id')->toArray();
            $datas =  DB::table('player_groups')
                ->select('users.*')
                ->Join('users', 'player_groups.user_id', '=', 'users.id')
                ->where(['users.has_parent' => 1])
                ->whereIn('player_groups.group_id', $group_list)
                ->distinct('id')
                ->get();
            $list = [];
            foreach ($datas as $data) {
                $a['id'] = $data->id;
                $a['name'] = $data->first_name . ' ' . $data->last_name;
                $a['image'] =  "http://15.188.226.196/public" . '/Uploads/profile-picture.jpg';
                if ($data->image)
                    $a['image'] = "http://15.188.226.196/public/Uploads/" . $data->image;
                $a['email'] = $data->email;
                $a['phone '] = $data->phone;
                $a['created_at'] = $data->created_at;
                $list[] = $a;
            }
            return response()->json([
                'success' => true,
                'data' => $list
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 400);
        }
    }
}

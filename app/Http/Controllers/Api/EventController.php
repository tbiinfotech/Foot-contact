<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoachEventPlayer;
use App\Models\CoachPasscodePlayer;
use App\Models\Event;
use App\Models\Notification;
use App\Models\PlayerTeam;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Token;
use App\Models\User;

class EventController extends Controller
{
    //
    /**
     * Api to add event
     */
    public function create_event(Request $request)
    {
        try {

            $filename = '';
            DB::beginTransaction();
            $id =  Auth::user()->id;
            //Request parameters
            $event_type_id = $request->event_type_id;
            $match_type_id = $request->match_type_id;
            $sport_category_id = 1;
            $opponent_team = $request->opponent_team;
            $is_home = $request->is_home;
            $event_date = str_replace("/", "-", $request->date);
            $date = date("Y-m-d", strtotime($event_date));
            $appointment_time = date("H:i", strtotime($request->appointment_time));
            $fixture_time = date("H:i", strtotime($request->fixture_time));
            $end_time = date("H:i", strtotime($request->end_time));
            $address = $request->address;
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $additional_info = $request->additional_info;
            $player_ids = explode(",", $request->players);
            $title = !empty($request->title) ? $request->title : '';
            $recurrent = $request->is_recurrent; //0 is No 1 is Yes
            //image

            if ($request->hasFile('image')) {
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            }
            //Event Create
            $event = Event::create([ 
                'event_type_id' => $event_type_id,
                'match_type_id' => $match_type_id,
                'image' => isset($filename) ? $filename : '',
                'sport_category_id' => 1,
                'opponent_team' => $opponent_team,
                'is_home' => $is_home,
                'date' => $date,
                'appointment_time' => $appointment_time,
                'fixture_time' => $fixture_time,
                'is_recurrent' => $recurrent,
                'title' => $title,
                'end_time' => $end_time,
                'address' => $address,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'additional_info' => $additional_info,
                'user_id' => $id,
            ]);
            //Team Player
            foreach ($player_ids as $player) {
                $exist_event_player = CoachEventPlayer::where([
                    'coach_id' => $id,
                    'event_id' => $event->id,
                    'player_id' => $player
                ])->exists();
                if (!$exist_event_player) {
                    CoachEventPlayer::create([
                        'coach_id' => $id,
                        'event_id' => $event->id,
                        'player_id' => $player
                    ]);
                    if ($event->event_type_id == 1) {
                        $image =    "http://15.188.226.196/public" . '/Uploads/match.jpg';
                    } elseif ($event->event_type_id == 2) {
                        $image =    "http://15.188.226.196/public" . '/Uploads/general.jpg';
                    } else {
                        $image =   "http://15.188.226.196/public" . '/Uploads/traning.jpg';
                    }

                    Notification::create([
                        "logo" => $image,
                        'title' => "New Event Invitation",
                        'description' => "New Event Invitation on " . $date,
                        'to_user' => $player,
                        'from_user' => $id,
                        'is_read' => 0,
                        'type' => $event->event_type_id
                    ]);
                    // $user = auth()->user()->id;
                    $token = Token::where(['user_id' => $player])->orderBy('id', 'DESC')->first();
                    if (!empty($token)) {

                        $notification = new Notification();
                        $notification->sendNotifications($token->device_token, "New Event Invitation", "New Event Invitation");
                    }
                }
            }
            $players_list = DB::table('coach_event_player')
                ->select('users.*')
                ->Join('users', 'coach_event_player.player_id', '=', 'users.id')
                ->where(['coach_event_player.event_id' => $event->id])
                ->get();
            DB::commit();
            $event->date = str_replace("-", "/", $event_date);
            $response = ['event' => $event];
            return response()->json([
                'success' => true,
                'data' => $response,
                // 'players_list' => $players_list,
                'message' => 'Event Created'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Invalid Token'
            ], 400);
        }
    }
    /**
     * Api to Edit event
     */
    public function edit_event(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $event_detail = Event::find($id);
            $filename = '';
            $auth_id =  Auth::user()->id;
            //Request parameters
            $event_type_id = $request->event_type_id;
            $match_type_id = $request->match_type_id;
            $sport_category_id = 1;
            $opponent_team = $request->opponent_team;
            $is_home = $request->is_home;
            $event_date = str_replace("/", "-", $request->date);
            $date = date("Y-m-d", strtotime($event_date));
            $appointment_time = date("H:i", strtotime($request->appointment_time));
            $fixture_time = date("H:i", strtotime($request->fixture_time));
            $end_time = date("H:i", strtotime($request->end_time));
            $address = $request->address;
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $additional_info = $request->additional_info;
            $player_ids = explode(",", $request->players);
            $title = !empty($request->title) ? $request->title : '';
            $recurrent = $request->is_recurrent; //0 is No 1 is Yes

            //image

            if ($request->hasFile('image')) {
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            }
            //Event Create
            $event = Event::where(['id' => $id])->update([
                'event_type_id' => $event_type_id,
                'match_type_id' => $match_type_id,
                'image' => isset($filename) ? $filename : '',
                'sport_category_id' => 1,
                'opponent_team' => $opponent_team,
                'is_home' => $is_home,
                'date' => $date,
                'appointment_time' => $appointment_time,
                'fixture_time' => $fixture_time,
                'is_recurrent' => $recurrent,
                'title' => $title,
                'end_time' => $end_time,
                'address' => $address,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'additional_info' => $additional_info,
                'user_id' => $auth_id,
            ]);
            $players = CoachEventPlayer::where([
                'coach_id' => Auth::user()->id,
                'event_id' => $id
            ])->get();
            foreach ($players as $player) {
                $player->delete();
            }
            //Team Player
            foreach ($player_ids as $player) {
                $exist_event_player = CoachEventPlayer::where([
                    'coach_id' => $auth_id,
                    'event_id' => $id,
                    'player_id' => $player
                ])->exists();
                if (!$exist_event_player) {
                    CoachEventPlayer::create([
                        'coach_id' => $auth_id,
                        'event_id' => $id,
                        'player_id' => $player
                    ]);
                    Notification::create([
                        'title' => "New Event Invitation",
                        'description' => "New Event Invitation on" . $date,
                        'to_user' => $player,
                        'from_user' => $auth_id,
                        'is_read' => 0,
                        'type' => $event_detail->event_type_id
                    ]);
                    $user = auth()->user()->id;
                    $token = Token::where(['user_id' => $user])->first();
                    $notification = new Notification();
                    $notification->sendNotifications($token->device_token, "New Event Invitation", "New Event Invitation");
                }
            }
            $players_list = DB::table('coach_event_player')
                ->select('users.*')
                ->Join('users', 'coach_event_player.player_id', '=', 'users.id')
                ->where(['coach_event_player.event_id' => $id])
                ->get();
            DB::commit();
            $event_detail->date = str_replace("-", "/", $event_date);
            $response = ['event' => $event_detail];
            return response()->json([
                'success' => true,
                'data' => $response,
                'players_list' => $players_list,
                'message' => 'Event Created'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Invalid Token'
            ], 400);
        }
    }


    /**
     * Api to accept event
     */
    public function accept_invite($event_id)
    {
        try {
            $event =  Event::find($event_id);
            
            $data = PlayerTeam::where('team_id', $event->team)->update([
                'is_accept' => 1
            ]);
            Notification::create([
                'title' => "Event Accept",
                'description' => "Event Accept",
                'to_user' => $event->user_id,
                'from_user' => Auth::user()->id,
                'is_read' => 0,
                'type' => $event->event_type_id
            ]);
            $token = Token::where(['user_id' => $event->user_id])->orderBy('id', 'DESC')->first();
            if (!empty($token)) {

                $notification = new Notification();
                $notification->sendNotifications($token->device_token, "Event get accept", "Event get accept");
            }
            return response()->json([
                'success' => true,
                'message' => 'Invite Accept'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Token'
            ], 400);
        }
    }
    /**
     * Cancel Event
     */
    public function cancel_event($event_id)
    {
        try {
            $data = Event::where('id', $event_id)->update([
                'status' => Event::CANCEL
            ]);
            $event = Event::find($event_id);
            Notification::create([
                'title' => "Event Cancel",
                'description' => "Event Cancel",
                'to_user' => $event->user_id,
                'from_user' => Auth::user()->id,
                'is_read' => 0,
                'type' => $event->event_type_id
            ]);
            $token = Token::where(['user_id' => $event->user_id])->orderBy('id', 'DESC')->first();
            if (!empty($token)) {
                $notification = new Notification();
                $notification->sendNotifications($token->device_token, "Event Cancel", "New Event Cancel");
            }
            return response()->json([
                'success' => true,
                'message' => 'Event Cancel'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Token'
            ], 400);
        }
    }
    /**
     * Coach Event player list
     */
    public function event_player_list($id)
    {
        try {
            $list = [];
            $datas =  CoachEventPlayer::where(['event_id' => $id])->get();
            foreach ($datas as $data) {

                $a['id'] = $data->id;
                $a['player_id'] = $data->player_id;
                $a['player_detail'] = $data->getPlayer($data->player_id);
                $a['is_accept'] = $data->is_accept;
                $a['is_present'] = $data->is_present;
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
                'message' => 'Invalid Token'
            ], 400);
        }
    }
    /**
     * Api to get details of event
     */
    public function event_detail($event_id)
    {
        try {
            $event =  Event::find($event_id);
            return response()->json([
                'success' => true,
                'data' => $event,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Token'
            ], 400);
        }
    }
    /**
     * Event List
     */

    public function event_list(Request $request)
    {
        try {
            $data = [];
            $user_id =   Auth::user()->id;
            $data = json_decode(file_get_contents("php://input"), true);
            $role_id = Auth::user()->role_id;
            $page = $data['page'];
            $date = str_replace("/", "-", $data['date']); //echo $date;
            $date = date("Y-m-d", strtotime($date)); //date("d", strtotime($date)) < 10 ? date("Y-m-d", strtotime($request['date'])) : date("Y-m-d", strtotime($date));
            $limit = 5;
            $eventModel = new Event();
            $offset = ($limit * $page) - $limit;
            if ($role_id == 4) {
                $coach_of_palyer = CoachPasscodePlayer::where(['player_id' => $user_id])->first();
                
                if (!empty($coach_of_palyer)) {
                    // get the club and player's coach event
                    $club_id = User::where(['id' => $coach_of_palyer->coach_id])->first();
                   
                    if (!empty($club_id)) {
                        $user_ids = $coach_of_palyer->coach_id . "," . $club_id->created_by_id;
                        $user_ids = explode(",", $user_ids);
                       
                        $events = Event::where([
                            'date' => $date
                        ])
                        ->whereIn('status', [0, 1, 3])
                        ->whereIn('user_id', $user_ids)
                        ->orderBy('id', 'DESC')
                        ->offset($offset)
                        ->limit($limit)->get();
                      
                        foreach ($events as $event) {

                            //check player of that team
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

                            $a['event_player_count'] = $event_player_count;
                            $a['date'] = date('d/m/Y', strtotime($event->date));
                            $a['team_name'] = isset($team_name->title) ? $team_name->title : '';
                            $a['opponent_team_name'] = isset($opponent_team_name->team_name) ? $opponent_team_name->team_name : '';
                            $a['event_player_list'] = $eventModel->eventPlayerList($event->id);
                            if (!empty($check_player)) {
                                $a['is_request'] = '1';
                                $a['player_event_id'] = $check_player->id;
                                if (!empty($check_player->image)) {
                                    $a['image'] = "http://15.188.226.196/public/Uploads/" . $check_player->image;
                                } else {
                                    if ($check_player->event_type_id == 1) {
                                        $a['image'] =    "http://15.188.226.196/public" . '/Uploads/match.jpg';
                                    } elseif ($check_player->event_type_id == 2) {
                                        $a['image'] =    "http://15.188.226.196/public" . '/Uploads/general.jpg';
                                    } else {
                                        $a['image'] =   "http://15.188.226.196/public" . '/Uploads/traning.jpg';
                                    }
                                }
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
                                $a['is_request'] = 0;
                                $a['player_event_id'] = 0;
                                $a['is_accept'] = 0;
                            }
                            $data[] = $a;
                        }
                    }
                }
            } else {
                 // get the club and  coach event
                $club = User::where(['id' => $user_id])->first();
                if (!empty($club)) {
                    $user_ids = $user_id . "," . $club->created_by_id;
                    $user_ids = explode(",", $user_ids);
                    $events = Event::where([
                        'date' => $date
                    ])
                        ->whereIn('user_id', $user_ids)
                        ->whereIn('status', [0, 1, 3])
                        ->offset($offset)
                        ->limit($limit)->orderBy('id', 'DESC')->get();
                } else {
                    Event::where([
                        'user_id' => $user_id,
                        'date' => $date
                    ])
                        ->whereIn('status', [0, 1, 3])
                        ->offset($offset)
                        ->limit($limit)->orderBy('id', 'DESC')->get();
                }
                foreach ($events as $event) {
                    $team_name = Team::where(['id' => $event->sport_category_id])->first();
                    $opponent_team_name = Team::where(['id' => $event->opponent_team])->first();
                    $a = $event;
                    $a['team_name'] = isset($team_name->title) ? $team_name->title : '';
                    $a['opponent_team_name'] = isset($opponent_team_name->team_name) ? $opponent_team_name->team_name : '';
                    $a['date'] = date('d/m/Y', strtotime($event->date));
                    $event_player_count = CoachEventPlayer::where(['event_id' => $event->id, 'is_accept' => 1])->count();
                    $a['event_player_count'] = $event_player_count;
                    $a['event_player_list'] = $eventModel->eventPlayerList($event->id);
                    if (!empty($event->image)) {
                        //   $a['image'] =  env('URL') . '/Uploads/' . $event->image;
                        $a['image'] =  "http://15.188.226.196/public/Uploads/" . $event->image;
                    } else {
                        if ($event->event_type_id == 1) {
                            $a['image'] =   "http://15.188.226.196/public/Uploads/match.jpg";
                        } elseif ($event->event_type_id == 2) {
                            $a['image'] =   'http://15.188.226.196/public/Uploads/general.jpg';
                        } else {
                            $a['image'] =  'http://15.188.226.196/public/Uploads/traning.jpg';
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
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }
    /**
     * Event List
     */

    public function montly_event_list(Request $request)
    {
        try {
            $data = [];
            $user_id =   Auth::user()->id;
            $data = json_decode(file_get_contents("php://input"), true);
            $role_id = Auth::user()->role_id;
            $page = $data['page'];
            $month = $data['month'];
            $date = str_replace("/", "-", $data['date']);
            $date = date("Y-m-d", strtotime($date));
            $limit = 5;
            $offset = ($limit * $page) - $limit;
            if ($role_id == 4) {
                $events = Event::whereIn('status', [0, 1, 3])
                    ->whereMonth('date', '=', $month)
                    ->orderBy('id', 'DESC')->offset($offset)
                    ->limit($limit)->get();
                foreach ($events as $event) {
                    $check_player = DB::table('event')
                        ->select('event.*', 'coach_event_player.id as player_event_id', 'coach_event_player.is_accept')
                        ->Join('coach_event_player', 'event.id', '=', 'coach_event_player.event_id')
                        ->where([
                            'coach_event_player.player_id' => $user_id,
                            'coach_event_player.event_id' => $event->id
                        ])
                        ->first();
                    $a['start'] = isset($event->date) ? ($event->date . ' ' . $event->appointment_time) : '';
                    $a['duration'] = isset($event->end_time) ? $event->end_time : '';
                    $data[] = $a;
                }
            } else {
                $events = Event::whereIn('status', [0, 1, 3])
                    ->where([
                        'user_id' => $user_id,
                    ])
                    ->whereMonth('date', '=', $month)
                    ->offset($offset)
                    ->limit($limit)->orderBy('id', 'DESC')->get();
                foreach ($events as $event) {
                    $check_player = DB::table('event')
                        ->select('event.*', 'coach_event_player.id as player_event_id', 'coach_event_player.is_accept')
                        ->Join('coach_event_player', 'event.id', '=', 'coach_event_player.event_id')
                        ->where([
                            'coach_event_player.player_id' => $user_id,
                            'coach_event_player.event_id' => $event->id
                        ])
                        ->first();
                    $a['start'] = isset($event->date) ? ($event->date . ' ' . $event->appointment_time) : '';
                    $a['duration'] = isset($event->end_time) ? $event->end_time : '';
                    $data[] = $a;
                }
            }
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Event List'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }
    /**
     *   Player event list
     */

    public function player_event_list($page)
    {
        try {
            $data = [];
            $user_id =   Auth::user()->id;
            $limit = 5;
            $offset = ($limit * $page) - $limit;
            $events = DB::table('event')
                ->select('event.*', 'coach_event_player.id as player_event_id')
                ->Join('coach_event_player', 'event.id', '=', 'coach_event_player.event_id')
                ->where(['coach_event_player.player_id' => $user_id])
                ->offset($offset)->limit(10)
                ->get();
            foreach ($events as $event) {
                $a = $event;
                if (!empty($event->image)) {
                    $a['image'] = "http://15.188.226.196/public/Uploads/" . $event->image;
                } else {
                    if ($event->event_type_id == 1) {
                        $a['image'] =  "http://15.188.226.196/public" . '/Uploads/match.jpg';
                    } elseif ($event->event_type_id == 2) {
                        $a['image'] =   "http://15.188.226.196/public" . '/Uploads/general.jpg';
                    } else {
                        $a['image'] =  "http://15.188.226.196/public" . '/Uploads/traning.jpg';
                    }
                }
                $data[] = $a;
            }
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Event List'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }
    /**
     *   Player event detail
     */

    public function player_event_detail($id)
    {
        try {
            $event = Event::find($id);
            $players = CoachEventPlayer::where(['event_id' => $id])->get();
            $data = ['event' => $event, 'players' => $players];
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Event List'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }
    /**
     *   Player event status
     */

    public function player_event_status(Request $request)
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $player_event_id = $data['player_event_id'];
            $is_accept = $data['is_accept']; // 1 is accept and 2 is decline
            $coach_event = CoachEventPlayer::where(['id' => $player_event_id])->update([
                'is_accept' => $is_accept
            ]);
            return response()->json([
                'success' => true,
                'message' => 'status update'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }

    /**
     * message notification
     */

    public function message_notification(Request $request)
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $notification =   Notification::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'to_user' => $data['to_user'],
                'from_user' => $data['from_user'],
                'is_read' => 0,
            ]);
            return response()->json([
                'success' => true,
                'data' =>  $notification,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }
}

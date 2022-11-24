<?php

namespace App\Http\Controllers;

use App\Models\CoachPasscodePlayer;
use App\Models\Event;
use App\Models\SportCategory;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;


class EventController extends Controller
{
    //
    public function index()
    {
        try {
            $evt = [];
            $mach = [];
            $trang = [];
            $club_id = Auth::user()->id;
            //combine the club and coach id's
            $coach_id = User::where(['created_by_id' => $club_id])->pluck('id')->toarray();
            $coach_id[] = array_push($coach_id, $club_id);
            //event
            $matchs = Event::where([
                'event_type_id' => 1,
            ])
                ->whereIn('user_id', $coach_id)
                ->get();

            foreach ($matchs as $match) {
                $array = [];
                $array['title'] = $match->title;
                $array['start'] = $match->date . 'T' . $match->fixture_time;
                $array['allDay'] = false;
                $mach[] = $array;
            }
            //match
            $tranings = Event::where([
                'event_type_id' => 2,
            ])->whereIn('user_id', $coach_id)
                ->get();
            foreach ($tranings as $traning) {
                $array = [];
                $array['title'] = $traning->title;
                $array['start'] = $traning->date . 'T' . $traning->fixture_time;
                $array['allDay'] = false;
                $trang[] = $array;
            }
            //traning 
            $events = Event::where([
                'event_type_id' => 3,
            ])->whereIn('user_id', $coach_id)
                ->get();
            foreach ($events as $event) {
                $array = [];
                $array['title'] = $event->title;
                $array['start'] = $event->date . 'T' . $event->fixture_time;
                $array['allDay'] = false;
                $evt[] = $array;
            }
            return view('event.index', ['match' => $mach, 'traning' => $trang, 'event' => $evt]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Add
     */
    public function add(Request $request)
    {
        try {
            $team = Team::where(['club_admin_id' => Auth::user()->id])->get();
            return view('event.add', ['team' => $team]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * create
     */
    public function create(Request $request)
    {
        try {
        if ($request->recurrent == 1) {
            // when recurrent repeated events are created upto that month according to the day
            $date = date("Y-m-d", strtotime($request->date));
            $lastday = date('Y-m-t', strtotime($date));
            if ($request->hasFile('image')) {
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            }
            for ($i = 1; $i <= 4; $i++) {
                if ($lastday > $date) {
                    $data = Event::create([
                        'sport_category_id' => 1,
                        'event_type_id' => $request->event_type_id,
                        'title' => $request->title,
                        'date' => $date,
                        'image' => isset($filename) ? $filename : '',
                        'recurrent' => $request->recurrent,
                        'appointment_time' => date("H:i", strtotime($request->appointment_time)),
                        'fixture_time' => date("H:i", strtotime($request->fixture_time)),
                        'match_type_id' => $request->match_type_id,
                        'is_home' => $request->is_home,
                        'opponent_team' => $request->opponent_team,
                        'end_time' => date("h:i", strtotime($request->end_time)),
                        'address' => $request->address,
                        'additional_info' => $request->additional_info,
                        'user_id' => Auth::user()->id
                    ]);
                }
                $repeat = strtotime("+7 day", strtotime($date));
                $date = date('Y-m-d', $repeat);
            }
        } else {
            $data = Event::create([
                'sport_category_id' => 1,
                'event_type_id' => $request->event_type_id,
                'title' => $request->title,
                'date' => date("Y-m-d", strtotime($request->date)),
                'recurrent' => $request->recurrent,
                'image' => isset($filename) ? $filename : '',

                'appointment_time' => date("H:i", strtotime($request->appointment_time)),
                'fixture_time' => date("H:i", strtotime($request->fixture_time)),
                'match_type_id' => $request->match_type_id,
                'is_home' => $request->is_home,
                'opponent_team' => $request->opponent_team,
                'end_time' => date("h:i", strtotime($request->end_time)),
                'address' => $request->address,
                'additional_info' => $request->additional_info,
                'user_id' => Auth::user()->id
            ]);
        }
        //notification
        if ($data->event_type_id == 1) {
            $image =    "http://15.188.226.196/public" . '/Uploads/match.jpg';
        } elseif ($data->event_type_id == 2) {
            $image =    "http://15.188.226.196/public" . '/Uploads/general.jpg';
        } else {
            $image =   "http://15.188.226.196/public" . '/Uploads/traning.jpg';
        }
        $coach_created_by_clubs = User::where(['created_by_id' => Auth::user()->id])->get();
        foreach ($coach_created_by_clubs as $coach_created_by_club) {
            $exist_CoachPasscodePlayer = CoachPasscodePlayer::where([
                'coach_id' => $coach_created_by_club->id,
            ])->pluck('player_id')->toarray();
            foreach($exist_CoachPasscodePlayer as $exist_CoachPasscodePlayers)
            {
                Notification::create([
                    "logo" => $image,
                    'title' => "New Event Invitation",
                    'description' => "New Event Invitation by club",
                    'to_user' => $exist_CoachPasscodePlayers,
                    'from_user' => Auth::user()->id,
                    'is_read' => 0,
                    'type' => $data->event_type_id
                ]);
            }
            Notification::create([
                "logo" => $image,
                'title' => "New Event Invitation",
                'description' => "New Event Invitation by club",
                'to_user' => $coach_created_by_club->id,
                'from_user' => Auth::user()->id,
                'is_read' => 0,
                'type' => $data->event_type_id
            ]);
        }

        return redirect('event-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}

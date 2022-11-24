<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Models\CoachEventPlayer;
use App\Models\CoachPasscode;
use App\Models\Event;
use App\Models\Group;
use App\Models\Notification;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Ladumor\OneSignal\OneSignal;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Exceptions\JWTException;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //    try {
        $user_id = Auth::user()->id;
        $user_detail = User::where(['id' => $user_id])->first();
        $otp = '1234'; //rand(1111, 9999);
        $phone = $user_detail->phone;
        // if (!empty($phone)) {
        try {
            $account_sid = 'ACdff222cf9b10fd6f79a03df17f94a7c6';
            $auth_token = 'd8ccb066d462fae645a3beffdf93d9c0';
            $twilio_number = "+19253971037";
            $client = new Client($account_sid, $auth_token);
            $message =   $client->messages->create(
                // Where to send a text message (your cell phone?)
                '+33' . $phone,
                array(
                    'from' => $twilio_number,
                    'body' => 'OTP is' . $otp
                )
            );
        } catch (\Twilio\Exceptions\RestException $e) {
            echo "Error sending SMS: " . $e->getCode() . ' : ' . $e->getMessage() . "\n";
        }

        return view('auth.authentication');
        // } else {
        //     return view('auth.sendotp');
        // }

        // } catch (\Exception $e) {
        //     return $this->error($e->getMessage());
        // }
    }

    // public function sendotp(Request $request)
    // {
    //     try {
    //         $user_id = Auth::user()->id;
    //         $phone = $request->phone;
    //         $otp = $user_id == '' ? '1234' : rand(1111, 9999);
    //         $event = User::where(['id' => $user_id])->update([
    //             'phone' => $phone,
    //             'otp' => $otp,
    //             'otp_verify' => 0
    //         ]);
    //         $account_sid = 'ACdff222cf9b10fd6f79a03df17f94a7c6';
    //         $auth_token = 'd8ccb066d462fae645a3beffdf93d9c0';
    //         $twilio_number = "+19253971037";
    //         $client = new Client($account_sid, $auth_token);
    //         $message =   $client->messages->create(
    //             // Where to send a text message (your cell phone?)
    //             '+33' . $phone,
    //             array(
    //                 'from' => $twilio_number,
    //                 'body' => 'OTP is' . $otp
    //             )
    //         );
    //         return view('auth.authentication');
    //     } catch (\Exception $e) {
    //         return $this->error($e->getMessage());
    //     }
    // }
    public function verification(Request $request)
    {
        try {
            $user = Auth::user()->id;
            $user_detail = User::where(['id' => $user])->first();
            if ($request->code == $user_detail->otp) {
                return redirect('dashboard');
            } else {
                return redirect('/login');
            }
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    public function dashboard()
    {
        try {
            $id = Auth::user()->id;
            $currentuser = User::find($id);
            $club=0;
            if (Auth::user()->role_id == 1) {
                //list of events on dashboard
                $upcoming_events = Event::whereDate('date', '>=', Carbon::now())->limit(4)->orderBy('id', 'DESC')->get();
                $recent_events = Event::limit(4)->orderBy('id', 'DESC')->get();
                //list of coach on dashboard
                $active_users = User::where(['role_id' => 4, 'is_archive' => 0])->count();
                $users = User::where(['role_id' => 4])->count();
                //list of users on dashboard
                $club = User::where(['role_id' => 2])->count();
                $coach = User::where(['role_id' => 3])->count();
              
            } else {
                //list of events on dashboard
                $upcoming_events = Event::where(['user_id' => $id])->whereDate('date', '>=', Carbon::now())->limit(4)->orderBy('id', 'DESC')->get();
                $recent_events = Event::where(['user_id' => $id])->limit(4)->orderBy('id', 'DESC')->get();
                //list of users on dashboard
                $passcode =    DB::table('coach_passcode_player')
                ->select('coach_passcode_player.*')
                ->leftJoin('users', 'coach_passcode_player.coach_id', '=', 'users.id')
                ->where(['users.created_by_id' => $id])
                ->pluck('coach_passcode_player.player_id');
                $active_users = User::where(['role_id' => 4, 'is_archive' => 0])->whereIn('id', $passcode)->count();
                $users = User::where(['role_id' => 4])->whereIn('id', $passcode)->count();
                 //list of coach on dashboard
                $coach = User::where(['role_id' => 3,'created_by_id'=>$id])->count();
               
            }


            return view(
                'home',
                [
                    'users' => $users,
                    'active_users' => $active_users,
                    'upcoming_events' => $upcoming_events,
                    'recent_events' => $recent_events,
                    'coach' => $coach,
                    'club' => $club,
                    'currentuser' => $currentuser
                ]
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    public function error()
    {
        return view('error');
    }
    public function logoutUser()
    {
        try {
            $user = Auth::user()->id;
            auth()->logout();
            // Session::flush();

            return redirect('/login');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * Edit Profile
     */
    public function edit_profile()
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $passcode = CoachPasscode::where(['user_id' => $id])->first();
        return view('edit-profile', ['id' => $id, 'data' => $data, 'passcode' => $passcode]);
    }
    /**
     * update
     */
    public function update(Request $request, $id)
    {
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            } else {
                $clubinfo = User::where('id', $id)->first();
                $filename = $clubinfo->image;
            }
            $data =  User::where('id', $id)->update([
                'name' => $request->first_name . ' ' . $request->last_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'image' => $filename,
                'phone' => $request->phone
            ]);
            return redirect('dashboard');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * change_password
     */
    public function change_password()
    {
        try {
            $id = Auth::user()->id;
            return view('auth.change-password', ['id' => $id]);
        } catch (\Exception $e) {
            echo $this->error($e->getMessage());
            return redirect('/login');
        }
    }
    public function updatePassword(Request $request)
    {
        try {
            $password = Hash::make($request->password);
            // $validator = FacadesValidator::make($request->all(), [
            //     'password'  =>  'required|min:8|confirmed',
            // ]);
            // if ($validator->fails()) {
            //     return back()->withErrors($validator->errors())->withInput();
            // }
            $data = User::where(['id' => $request->token])
                ->update(['password' => $password]);
            auth()->logout();
            return redirect('/login');
        } catch (\Exception $e) {
            echo $this->error($e->getMessage());
            return redirect('/login');
        }
    }

    /**
     * read notification
     */

    public function event_reminder()
    {
        try {
            $events = DB::table('event')
                ->select(
                    'event.*',
                    'coach_event_player.id as player_event_id',
                    'coach_event_player.player_id as player_id',
                    'coach_event_player.is_accept'
                )
                ->leftJoin('coach_event_player', 'event.id', '=', 'coach_event_player.event_id')
                ->where(['coach_event_player.is_accept' => 0])
                ->get();
            foreach ($events as $event) {
                $date = date('Y-m-d');
                if ($date == $event->date) {
                    $time = date($event->appointment_time, strtotime('-1 hour'));
                    if ($time == date('H:i:s')) {
                        Notification::create([
                            'title' => "Please accept or decline invitation",
                            'description' => "New Event Invitation on" . $event->date,
                            'to_user' => $event->player_id,
                            'from_user' => $event->user_id,
                            'is_read' => 0,
                            'type' => $event->event_type_id
                        ]);
                        $token = Token::where(['user_id' => $event->player_id])->orderBy('id', 'DESC')->first();
                        if (!empty($token)) {

                            $notification = new Notification();
                            $notification->sendNotifications($token->device_token, "Please accept or decline invitation", "Please accept or decline invitation");
                        }
                    }
                }
            }
            return response()->json([
                'success' => true,
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }
    /**
     * read notification
     */

    public function event_reminder_before()
    {
        try {
            $events = DB::table('event')
                ->select(
                    'event.*',
                    'coach_event_player.id as player_event_id',
                    'coach_event_player.player_id as player_id',
                    'coach_event_player.is_accept'
                )
                ->leftJoin('coach_event_player', 'event.id', '=', 'coach_event_player.event_id')
                ->get();
            foreach ($events as $event) {
                $date = date('Y-m-d');
                if ($date == $event->date) {
                    $time = date($event->appointment_time, strtotime('-1 hour'));
                    if ($time == date('H:i:s')) {
                        // to player
                        Notification::create([
                            'title' => "Please accept or decline invitation",
                            'description' => "New Event Invitation on" . $event->date,
                            'to_user' => $event->player_id,
                            'from_user' => $event->user_id,
                            'is_read' => 0,
                            'type' => $event->event_type_id
                        ]);
                        $token = Token::where(['user_id' => $event->player_id])->orderBy('id', 'DESC')->first();
                        if (!empty($token)) {

                            $notification = new Notification();
                            $notification->sendNotifications($token->device_token, "Please accept or decline invitation", "Please accept or decline invitation");
                        }
                        // to coach
                        Notification::create([
                            'title' => "Please accept or decline invitation",
                            'description' => "New Event Invitation on" . $event->date,
                            'to_user' => $event->user_id,
                            'from_user' => $event->user_id,
                            'is_read' => 0,
                            'type' => $event->event_type_id
                        ]);

                        $token2 = Token::where(['user_id' => $event->user_id])->orderBy('id', 'DESC')->first();
                        if (!empty($token)) {

                            $notification = new Notification();
                            $notification->sendNotifications($token2->device_token, "Please accept or decline invitation", "Please accept or decline invitation");
                        }
                    }
                }
            }
            return response()->json([
                'success' => true,
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }

    public function chat()
    {
        return view('auth.chat');
    }
    public function savePushNotificationToken()
    {
        auth()->user()->update(['device_token' => "rtsrgtdfgwt3456fhdfhgdhsdazxxx"]);
        return response()->json(['token saved successfully.']);
    }

    public function sendPushNotification()
    {
        $projectId = "footcontact-bf34f";
        $db = new FirestoreClient([
            'projectId' => $projectId,
        ]);
        # [START fs_set_document]
        # [START firestore_data_set_from_map]
        $data = [
            'name' => 'Los Angeles',
            'state' => 'CA',
            'country' => 'USA'
        ];
        $db->collection('samples/php/cities')->document('LA')->set($data);
        dd('sd');
    }

    public function notificationPopup()
    {
        $headers = array(
            "Content-Type: application/json; charset=utf-8"
        );

        $content = array(
            'en' => "testing from backend"
        );

        $headings = array(
            'en' => "testing from backend"
        );
        $device[] = 'aa182b08-1158-4ca2-8674-bef9d26c5c93';
        $fields = array(
            'app_id' => '1c922212-a21f-4170-91b8-64ec5a5c74fd',
            'include_player_ids' => $device,
            'contents' => $content,
            'headings' => $headings
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $response = curl_exec($ch);
        $error = curl_error($ch);
        $errorno = curl_errno($ch);
        curl_close($ch);

        if ($error) {
            $status = false;
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $errorMsg = 'Error: ' . $error . ' Status: ' . $statusCode;
            $responseId = null;
        } else {
            $status = true;
            $errorMsg = '';
            $decodedResp = json_decode($response, true);
            $responseId = isset($decodedResp['id']) ? $decodedResp['id'] : null;
        }
        return array(
            'status' => $status,
            'error_message' => $errorMsg,
            'response_id' => $responseId
        );
    }
    //     $headers = array(               
    //         "Content-Type: application/json; charset=utf-8"
    //     ); 
    //     $fields['include_player_ids'] = ['a8c9c353-5a9f-41d2-a896-791134415d37'];
    //     $message = 'hey!! This is a test push.!';
    //     $test =   OneSignal::sendPush($fields, $message);
    //     dd($test);
    // }

    public function firebaseChat()
    {
        return view('auth.home');
    }
}

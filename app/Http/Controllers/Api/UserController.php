<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClubNotes;
use App\Models\CoachGroup;
use App\Models\CoachPasscode;
use App\Models\CoachPasscodePlayer;
use App\Models\Notification;
use App\Models\Parents;
use App\Models\PlayerGroup;
use App\Models\PlayerTeam;
use App\Models\Token;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{

    /**
     * Register 
     */

    public function register(Request $request)
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $phone  = !empty($data['phone']) ? $data['phone'] : '';
            $email  = !empty($data['email']) ? $data['email'] : '';
            $exist_phn = DB::table('users')
                ->where(['phone' => $phone])
                ->first();
            $exist_mail = DB::table('users')
                ->where(['email' => $email])
                ->first();
            if (!empty($exist_phn) || !empty($exist_mail)) {
                return response()->json([
                    'success' => false,
                    'message' => 'User already exist!'
                ], 200);
            }
            $account_sid = 'ACdff222cf9b10fd6f79a03df17f94a7c6';
            $auth_token = 'd8ccb066d462fae645a3beffdf93d9c0';
            $twilio_number = "+19253971037";
            $client = new Client($account_sid, $auth_token);
            $random = rand(1111, 9999);

            $device_token  = !empty($data['device_token']) ? $data['device_token'] : '';
            $id  = !empty($data['id']) ? $data['id'] : '';
            
            if (!empty($phone)) {
                //send otp by phone 
                $user = User::where('phone', '=', $phone)->first();
                if (empty($user)) {
                    $user = User::create([
                        'name' => 'player',
                        'first_name' => 'player',
                        'last_name' => 'player',
                        'phone' => $phone,
                        'token' =>  '1234',
                        'role_id' => '4',
                    ]);
                    // $message=   $client->messages->create( 
                    //     '+917009218272',
                    //     array(
                    //         'from' => $twilio_number,
                    //         'body' => 'OTP'. '1234'
                    //     )
                    // );
                    $user = User::where('phone', '=', $phone)->first();
                }
            } else {
                $user = User::where('email', '=', $email)->first();
                if (empty($user)) {
                    $user = User::where('id', $id)->update([
                        'email' => $email,
                        'token' =>  '1234',
                    ]);
                    $user = User::where('email', '=', $email)->first();
                }
            }
            $device_token = Token::create([
                'user_id' => $user->id,
                'device_token' => $device_token
            ]);
            return response()->json([
                'success' => true,
                'user' => $user,
                'message' => 'otp sent'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
            ], 400);
        }
    }
    /**
     * send OTP
     */

    public function send_otp(Request $request)
    {
        try {
            $account_sid = 'ACdff222cf9b10fd6f79a03df17f94a7c6';
            $auth_token = 'd8ccb066d462fae645a3beffdf93d9c0';
            $twilio_number = "+19253971037";
            $client = new Client($account_sid, $auth_token);
            $random = rand(1111, 9999);
            $data = json_decode(file_get_contents("php://input"), true);
            $phone  = !empty($data['phone']) ? $data['phone'] : '';
            $email  = !empty($data['email']) ? $data['email'] : '';
            $device_token  = !empty($data['device_token']) ? $data['device_token'] : '';
            $id  = !empty($data['id']) ? $data['id'] : '';
          
            if (!empty($phone)) {
                $exist_phn = DB::table('users')
                ->where(['phone' => $phone])
                ->first();
           
            if (empty($exist_phn)) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not exist!'
                ], 200);
            }
                //send otp by phone 
                $user = User::where('phone', '=', $phone)->whereIn('role_id',[3,4,5])->first();
                if (empty($user)) {
                    $user = User::create([
                        'name' => 'player',
                        'first_name' => 'player',
                        'last_name' => 'player',
                        'phone' => $phone,
                        'token' =>  '1234',
                        'role_id' => '4',
                    ]);
                    // $message=   $client->messages->create( 
                    //     '+917009218272',
                    //     array(
                    //         'from' => $twilio_number,
                    //         'body' => 'OTP'. '1234'
                    //     )
                    // );
                    $user = User::where('phone', '=', $phone)->first();
                }else{
                  if($user->is_archive==1)
                  {
                    return response()->json([
                        'success' => false,
                        'message' => 'User is not active'
                    ], 200);
                  }
                }
            } else {
                $user = User::where('email', '=', $email)->whereIn('role_id',[3,4,5])->first();
                if (empty($user)) {
                    $user = User::where('id', $id)->update([
                        'email' => $email,
                        'token' =>  '1234',
                    ]);
                    $user = User::where('email', '=', $email)->first();
                }else{
                    if($user->is_archive==1)
                    {
                      return response()->json([
                          'success' => false,
                     
                          'message' => 'User is not active'
                      ], 200);
                    }
                  }
            }
            $device_token = Token::create([
                'user_id' => $user->id,
                'device_token' => $device_token
            ]);
            return response()->json([
                'success' => true,
                'user' => $user,
                'message' => 'otp sent'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'You are not allowed to perform this action'
            ], 400);
        }
    }
    /**
     * verify OTP
     */

    public function verify_otp(Request $request)
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            if (!empty($data['phone'])) {
                $credentials = User::where('phone', '=', $data['phone'])->where('token', '=', $data['otp'])->first();
            } else {
                $credentials = User::where('email', '=', $data['email'])->where('token', '=', $data['otp'])->first();
            }
            if (!empty($credentials)) {
                $token = \JWTAuth::fromUser($credentials);
                return response()->json([
                    'success' => true,
                    'role_id'=>$credentials->role_id,
                    'access_token' => $token
                ], 200);
            }
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ], 400);
        }
    }
    /**
     * Passcode
     */

    public function passcode(Request $request)
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $id  = !empty($data['id']) ? $data['id'] : '';
            $passcode  = !empty($data['passcode']) ? $data['passcode'] : '';
            //match the poasscode
            $data = CoachPasscode::where(['passcode' => $passcode])->first();
            if (!empty($data)) {
                // player select the code of coach
                $exist_CoachPasscodePlayer = CoachPasscodePlayer::where([
                    'coach_id' => $data->user_id,
                    'player_id' => $id,
                ])->exists();
                if (!$exist_CoachPasscodePlayer) {
                    $coach_player = CoachPasscodePlayer::create([
                        'coach_id' => $data->user_id,
                        'player_id' => $id,
                        'coach_passcode_id' => $data->id
                    ]);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Passcode matches'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'invalid code'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ], 400);
        }
    }
    /**
     * Resend OTP
     */

    public function resend_otp(Request $request)
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $id  = !empty($data['id']) ? $data['id'] : '';
            $otp = '1234';
            User::where('id', $id)->update([
                'token' => $otp
            ]);
            return response()->json([
                'success' => true,
                'message' => 'OTP sent'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ], 400);
        }
    }
    /**
     * verify email
     */

    public function verify_email(Request $request)
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $id = $data['id'];
            $email = $data['email'];
            // update player info
            $user =  User::where(['email' => $email])->exists();
            if ($user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email already exist'
                ], 400);
            }
            $link = 'http://127.0.0.1:8000/api/email-status/' . $id . '/' . $email;
            return response()->json([
                'success' => true,
                'message' => 'Email Verified',
                'link' => $link
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }
    /**
     * update email status
     */

    public function email_status($id, $email)
    {
        try {
            User::where('id', $id)->update([
                'email' => $email
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Email verified'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }

    /**
     * passcode player list
     */

    public function coach_player($id)
    {
        try {
            $datas = DB::table('users')
                ->select('users.*')
                ->leftJoin('coach_passcode_player', 'users.id', '=', 'coach_passcode_player.player_id')
                ->where('coach_passcode_player.coach_id', '=', $id)
                ->get();
                
            $list = [];
            foreach ($datas as $data) {
                $a['id'] = $data->id;
                $a['name'] = $data->first_name . ' ' . $data->last_name;  
                $a['checkbox'] = false;
                $a['image'] = "http://15.188.226.196/public/Uploads/profile-picture.jpg";
                if ($data->image)
                    $a['image'] =  "http://15.188.226.196/public/Uploads/".$data->image;
                $list[] = $a;
            }
            return response()->json([
                'success' => true,
                'data' => $list,
                'message' => 'player list'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }
    /**
     * Coach Event List
     */
    public function coach_event_player($id)
    {
        try {
            $datas = DB::table('coach_event_player')
                ->select('users.*')
                ->Join('users', 'coach_event_player.player_id', '=', 'users.id')
                ->where(['coach_event_player.event_id' => $id])
                ->get();
            $list = [];
            foreach ($datas as $data) {

                $a['id'] = $data->id;
                $a['name'] = $data->first_name . ' ' . $data->last_name;
                if (!empty($data->image)) {
                    $a['image'] = "http://15.188.226.196/public/Uploads/" . $data->image;
                } else {
                    $a['image'] =    "http://15.188.226.196/public/Uploads/match.jpg";
                }
                $list[] = $a;
            }

            return response()->json([
                'success' => true,
                'data' => $list,
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
     * update Profile
     */

    public function update_profile(Request $request, $id)
    {
        try {
            $filename = '';
            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $email = $request->email;
            $date_of_birth =  date("Y-m-d", strtotime($request['date_of_birth']));

            if ($request->hasFile('image')) {
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            }
            // update player info
            $user =  User::where('id', $id)->update([
                'name' =>  $request->first_name . ' ' . $request->last_name,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'image' => $filename,
                'email' => $email,
                'date_of_birth' => $date_of_birth,
                'role_id' => 4,
                'status' => 1,
                'has_parent' => $request->has_parent
            ]);
            // if parent add parent info
            if ($request->has_parent == 1) {
                $parent_first_name = $request->parent_first_name;
                $parent_last_name = $request->parent_last_name;
                Parents::create([
                    'first_name' => $parent_first_name,
                    'last_name' => $parent_last_name,
                    'user_id' => $id,
                ]);
            }
            $response = ['message' => 'Profile updated'];
            return response()->json([
                'success' => true,
                'message' => 'Profile Update'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Token'
            ], 400);
        }
    }
    /**
     * Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'role' => $user->role_id,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
    /**
     * Logout
     */
    public function logout(Request $request)
    {
        //Request is validated, do logout        
        try {
            JWTAuth::parseToken()->invalidate(true);
            $token = $request->device_token;
            $device_token = Token::where(['device_token' => $token])->delete();
            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * event list
     */

    public function event_type_list()
    {
        try {
            $data = DB::table('event_type')->paginate(10);
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
     * match type list
     */
    public function match_type_list()
    {
        try {
            $data = DB::table('match_type')->paginate(10);
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
     * team player table player_team
     */
    public function team_player(Request $request)
    {
        try {
            $team_id = $request->team_id;
            $player_id = $request->player_id;
            $players = explode(",", $player_id);
            foreach ($players as $player) {
                $exist_player = PlayerTeam::where(['team_id' => $team_id, 'user_id' => $player])->exists();
                if (!$exist_player) {
                    PlayerTeam::create([
                        'user_id' => $player,
                        'team_id' => $team_id
                    ]);
                }
            }
            return response()->json([
                'success' => true,
                'data' => "Team Created"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
            ], 400);
        }
    }
    /**
     * group player table player_groups
     */
    public function group_player(Request $request)
    {
        try {
            $group_id = $request->group_id;
            $player_id = $request->player_id;
            $players = explode(",", $player_id);
            foreach ($players as $player) {
                $exist_player = PlayerGroup::where(['group_id' => $group_id, 'user_id' => $player])->exists();
                if (!$exist_player) {
                    PlayerGroup::create([
                        'user_id' => $player,
                        'group_id' => $group_id
                    ]);
                }
            }
            return response()->json("Group Created", 200);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * group coach table coach_groups
     */
    public function coach_group(Request $request)
    {
        try {
            $group_id = $request->group_id;
            $coach_id = $request->coach_id;
            $exist_coach = CoachGroup::where(['group_id' => $group_id, 'user_id' => $coach_id])->exists();
            if (!$exist_coach) {
                CoachGroup::create([
                    'user_id' => $coach_id,
                    'group_id' => $group_id
                ]);
            }
            return response()->json("Coach Group Created", 200);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * profile details
     */
    public function profile_detail($id)
    {
        try {
            $list = [];
            $data = User::where(['id' => $id])->first();

            if (!empty($data->image)) {
                $data['image'] =  "http://15.188.226.196/public/Uploads/". $data->image;
            } else {
                $data['image'] = "http://15.188.226.196/public/Uploads/profile-picture.jpg";
            }

            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * Passcode
     */

    public function groupCode(Request $request)
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $id =  !empty($data['id']) ? $data['id'] : '';
            $passcode  = !empty($data['passcode']) ? $data['passcode'] : '';
            //match the poasscode
            $data = CoachPasscode::where(['passcode' => $passcode])->first();
            if (!empty($data)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Passcode matches'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ], 400);
        }
    }

    /**
     * Coach passcode list
     */

    public function passcodeList()
    {
        try {
            $user_id =   Auth::user()->id;
            $data = CoachPasscode::where(['user_id' => $user_id])->get();
            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }
    /**
     * update Coach Profile
     */

    public function update_coach_profile(Request $request, $id)
    {
        try {
            Log::error($request);
            $user_detail = User::where(['id' => $id])->first();
            if (!empty($user_detail)) {
                $last_name = $request->last_name;
                $first_name = $request->first_name;
                $filename = $user_detail->image;
                if ($request->hasFile('image')) {
                    $file = $request->file('image')->getClientOriginalName();
                    $filename = time() . $file;
                    $path = public_path('/Uploads');
                    $file = $request->file('image');
                    $file->move($path, $filename);
                }
                Log::error($filename);
                // update player info
                User::where('id', $id)->update([
                    'name' => $first_name . ' ' . $last_name,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'image' => $filename
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Profile Update'
                ], 200);
            }
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Invalid Token'
            ], 400);
        }
    }
    /**
     * get notification
     */

    public function notification_list()
    {
        try {
            $user_id =   Auth::user()->id;
            $data = Notification::where(['to_user' => $user_id])->limit(3)->get();
            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }
    /**
     * read notification
     */

    public function notification_read($id)
    {
        try {
            $data =  Notification::where('id', $id)->update([
                'is_read' => 1
            ]);
            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }
     /**
     * get notification
     */

    public function club_notes_list()
    {
        try {
            $user_id =   Auth::user()->id;
            $club_id= User::where(['id'=>$user_id])->first();
            $datas = ClubNotes::where(['status' => 0,'user_id'=>$club_id->created_by_id])->get();
            foreach ($datas as $data) {
                $a = $data;
                if (!empty($data->image)) {
                    $a['image'] ="http://15.188.226.196/public/Uploads/" . $data->image;
                } else {
                        $a['image'] =  "http://15.188.226.196/public/Uploads/profile-picture.jpg";
                }
                $d[] = $a;
            } 
            return response()->json([
                'success' => true,
                'data' => $d
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }
    public function club_notes_list_player()
    {
        try {
            $user_id =   Auth::user()->id;
            $coach_of_palyer = CoachPasscodePlayer::where(['player_id' => $user_id])->first();
            if (!empty($coach_of_palyer)) { 
            $club_id= User::where(['id'=>$coach_of_palyer->coach_id])->first();
            $datas = ClubNotes::where(['status' => 0,'user_id'=>$club_id->created_by_id])->get();
            foreach ($datas as $data) {
                $a = $data;
                if (!empty($data->image)) {
                    $a['image'] ="http://15.188.226.196/public/Uploads/" . $data->image;
                } else {
                        $a['image'] =  "http://15.188.226.196/public/Uploads/profile-picture.jpg";
                }
                $d[] = $a;
            }   }
            return response()->json([
                'success' => true,
                'data' => $d
            ], 200);
      
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email'
            ], 400);
        }
    }
}

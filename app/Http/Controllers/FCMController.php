<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\User as Users;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FCMController extends Controller
{
    //

    public function home()
    {
        $auth_user = Auth::user()->id;
        $passcode =    DB::table('coach_passcode_player')
            ->select('coach_passcode_player.*')
            ->leftJoin('users', 'coach_passcode_player.coach_id', '=', 'users.id')
            ->where(['users.created_by_id' => $auth_user])
            ->pluck('coach_passcode_player.player_id');
        $user1 = Users::where(['is_archive' => 0])->whereIn('role_id', [4, 5])->whereIn('id', $passcode)->get();
        $user2 = Users::where(['created_by_id'=>$auth_user,'is_archive' => 0])->whereIn('role_id', [3, 5])->get();
        $merged = $user1->merge($user2);

          $users = $merged->all();


        $first_user = DB::table('users')->whereIn('role_id', [3, 4])->first();
        return view('auth.home', [
            'users' => $users,
            'first_user' => $first_user->id,
            'first_user_name' => $first_user->name

        ]);
    }
    public function index(Request $req)
    {
        $input = $req->all();
        $fcm_token = $input['fcm_token'];
        $user_id = $input['user_id'];


        $user = User::findOrFail($user_id);

        $user->fcm_token = $fcm_token;
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'User token updated successfully.'
        ]);
    }
}

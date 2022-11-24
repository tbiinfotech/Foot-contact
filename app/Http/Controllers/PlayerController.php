<?php

namespace App\Http\Controllers;

use App\Models\CoachPasscode;
use App\Models\CoachPasscodePlayer;
use App\Models\Group;
use App\Models\Parents;
use App\Models\PlayerGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Validators\Validator;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class PlayerController extends Controller
{
    // index page
    public function index()
    {
        try {
            $auth_user = Auth::user()->id; 
            $search = request()->get('search');
            $group_search = request()->get('group');
            $club_search = request()->get('club');
            //group list
            $group = Group::get();
            //club list
            $club = User::where(['role_id' => 2])->get();
            //main query
            if (Auth::user()->role_id == "1") {
                $data = User::where(['is_archive' => 0])->whereIn('role_id', [4,5]);
            } else {
                $passcode =    DB::table('coach_passcode_player')
                    ->select('coach_passcode_player.*')
                    ->leftJoin('users', 'coach_passcode_player.coach_id', '=', 'users.id')
                    ->where(['users.created_by_id' => $auth_user])
                    ->pluck('coach_passcode_player.player_id');
                $data = User::where(['is_archive' => 0])->whereIn('role_id', [4,5])->whereIn('id', $passcode);
            }
            //search conditions 
            if (isset($search)) {
                $data = $data->where('name', 'LIKE', "%{$search}%");
            } elseif (isset($group_search)) {
                if ($group_search > 0) {
                    $player_group = PlayerGroup::where(['group_id' => $group_search])->pluck('user_id')->toarray();
                    $data = $data->whereIn('id', $player_group);
                } else {
                    return redirect('player-index');
                }
            } elseif (isset($club_search)) {
                if ($club_search > 0) {
                    $club_palyer = DB::table('users')
                        ->select('users.*', 'coach_passcode_player.player_id')
                        ->join('coach_passcode_player', 'users.id', '=', 'coach_passcode_player.coach_id')
                        ->where(['users.id' => $club_search])
                        ->pluck('coach_passcode_player.player_id')->toarray();
                    $data = $data->whereIn('id', $club_palyer);
                } else {
                    return redirect('player-index');
                }
            }
            $data = $data->orderBy('id', 'DESC')->paginate(10);
            return view('player.index', ['data' => $data, 'group' => $group, 'club' => $club, 'search' => $search]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    // view page detail
    public function view()
    {
        try {
            $id = request()->get('id');
            $data = User::find($id);
            $coach_groups =  DB::table('teams')
                ->select('teams.*')
                ->rightJoin('player_teams', 'teams.id', '=', 'player_teams.team_id')
                ->where(['player_teams.user_id' => $id])
                ->get();
            $parent =  Parents::where(['user_id' => $id])->get();
            return view('player.view', ['data' => $data, 'coach_groups' => $coach_groups, 'parent' => $parent]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    //update status
    public function status()
    {
        try {
            $id = request()->get('id');
            $data = User::where('id', $id)->update(['status' => 0]);
            return view('player.view', ['data' => $data]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * Delete
     */
    public function delete()
    {
        try {
            $id = request()->get('id');
            $data =  User::where('id', $id)
                ->update(['is_archive' => 0]);
            return redirect('player-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Not Delete
     */
    public function notdelete()
    {
        try {
            $id = request()->get('id');
            $data =  User::where('id', $id)
                ->update(['is_archive' => 1]);
            return redirect('player-index');
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
    /**
     * edit
     */
    public function edit()
    {
        try {
            $id = request()->get('id');
            $data = User::find($id);
            return view('player.edit', ['id' => $id, 'data' => $data]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * export
     */
    public function export()
    {
        try {
            $name = "fc-players-" . date('Ymd') . ".csv";
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=" . $name);
            header("Pragma: no-cache");
            header("Expires: 0");

            $players = User::where(['role_id' => 4])->get();;
            $columns = array(
                'id', 'First Name', 'Last Name', 'Email', 'Phone',
                'Clubs Name', 'Groups Name', 'Teams Name',
                'Parent First Name', 'Parent Last Name'
            );

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($players as $player) {
                $parents = Parents::where(['user_id' => $player->id])->get();
                fputcsv($file, array(
                    $player->id, $player->first_name, $player->last_name,
                    $player->email, "\n" . $player->phone,
                    $player->playerClubName($player->id),
                    $player->playerGroupName($player->id),
                    $player->playerTeamName($player->id),
                    $player->first_name, $player->last_name
                ));
            }
            exit();
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
    // Import
    public function input()
    {
        try {
            return view('player.import');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * import
     */
    public function import(Request $request)
    {
        try {
            $validator = FacadesValidator::make($request->all(), [
                "image" => "required|mimes:csv|max:10000"
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }
            set_time_limit(0);
            if ($request->hasFile('image')) {
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            }
            $file = "http://15.188.226.196/public/" . "/Uploads/" . $filename;
            $handle = fopen($file, "rb");
            while (($getData = fgetcsv($handle, 10000, ",")) !== FALSE) {
                $first_name = isset($getData[0]) ? $getData[0] : '';
                $last_name = isset($getData[1]) ? $getData[1] : '';
                $email = isset($getData[2]) ? $getData[2] : '';
                $phone = isset($getData[3]) ? $getData[3] : '';
                $otp = '1234';
                $role_id = 4;
                $exist = User::where('phone', '=', $phone)->orWhere('email', '=', $email)->first();
                if (empty($exist)) {
                    $data = User::create([
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'phone' => $phone,
                        'role_id' => $role_id
                    ]);
                }
            }
            return redirect('player-index');
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
    /**
     * update
     */
    public function update(Request $request, $id)
    {
        try {
            $filename = "";
            if ($request->hasFile('image')) {
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            }else{
                $player= User::where('id', $id)->first();
                $filename=$player->image;
            }

            $data =  User::where('id', $id)->update([
                'name' => $request->first_name . ' ' . $request->last_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'image' => $filename,
                'phone' => $request->phone
            ]);
            return redirect('player-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}

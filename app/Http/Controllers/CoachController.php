<?php

namespace App\Http\Controllers;

use App\Models\CoachGroup;
use App\Models\CoachPasscode;
use App\Models\CoachPasscodePlayer;
use App\Models\CoachRole;
use App\Models\CoachTeam;
use App\Models\Group;
use App\Models\PlayerGroup;
use App\Models\Team;
use App\Models\User;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class CoachController extends Controller
{
    // index page
    public function index()
    {
        try {
            $data = User::where([
                'created_by_id' => Auth::user()->id,
                'is_archive' => 0
            ])->whereIn('role_id', [3, 5])->orderBy('id', 'DESC')->paginate(10);
            return view('coach.index', ['data' => $data]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    // add form
    public function addForm()
    {
        try {
            $group = Team::get();
            $teams = Team::where(['club_admin_id' => Auth::user()->id])->get();
            $passcode = CoachPasscodePlayer::where(['coach_id' => Auth::user()->id])->pluck('player_id');
            $players = User::where(['role_id' => 4])->whereIn('id', $passcode);
            $role = DB::table('roles')->where(['is_subrole' => 1])->get();
            return view('coach.add', [
                'group' => $group,
                'role' => $role,
                'teams' => $teams,
                'players' => $players
            ]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    // add
    public function add(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = FacadesValidator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'image' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric|unique:users|digits:10',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }
            if ($request->hasFile('image')) {
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            }
            //random string
            $length = 15;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $user = User::create([
                'name' => $request['first_name'] . ' ' . $request['last_name'],
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'image' => isset($filename) ? $filename : '',
                'phone' => $request['phone'],
                'reset_token' => $randomString,
                'password' => Hash::make('admin@123'),
                'role_id' => '3',
                'created_by_id' => Auth::user()->id,
                'token' => '1234'
            ]);

            //passcode
            $passcode = CoachPasscode::create([
                'user_id' =>  $user->id,
                'title' => "Orignal Sport Club",
                'passcode' => rand(111111, 999999)

            ]);
            DB::commit();
            return redirect('coach-index');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }
    /**
     * coach_existing
     */
    public function coach_existing()
    {
        try {
            $auth_user = Auth::user()->id;
            $coachs = User::where(['role_id' => 3, 'is_archive' => 0])->get();
            $passcode =  DB::table('coach_passcode_player')
                ->select('coach_passcode_player.*')
                ->leftJoin('users', 'coach_passcode_player.coach_id', '=', 'users.id')
                ->where(['users.created_by_id' => $auth_user])
                ->pluck('coach_passcode_player.player_id');
            $players = User::where(['role_id' => 4, 'is_archive' => 0])->whereIn('id', $passcode)->get();

            return view('coach.edit', ['coachs' => $coachs, 'players' => $players]);
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
            $data =  User::find($id);
            $coachs = User::where(['role_id' => 3])->get();
            //list of team
            $teams = Team::where(['club_admin_id' => Auth::user()->id])->get();
            // team that assign to coach
            $coach_team =  DB::table('teams')
                ->select('teams.*', 'coach_teams.id as coach_group')
                ->rightJoin('coach_teams', 'teams.id', '=', 'coach_teams.team_id')
                ->where(['coach_teams.user_id' => $id])
                ->get();
            // Assign role to coach
            $coach_assign_roles =  DB::table('roles')
                ->select('roles.*', 'coach_roles.id as coach_role')
                ->rightJoin('coach_roles', 'roles.id', '=', 'coach_roles.role_id')
                ->where(['coach_roles.user_id' => $id])
                ->get();
            return view('coach.update', [
                'id' => $id,
                'data' => $data,
                'teams' => $teams,
                'coachs' => $coachs,
                'coach_team' => $coach_team,
                'coach_assign_roles' => $coach_assign_roles
            ]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * assign-player
     */
    public function assign_player()
    {
        try {
            $auth_user = Auth::user()->id;
            $id = request()->get('id');
            $data =  User::find($id);
            $passcode =  DB::table('coach_passcode_player')
                ->select('coach_passcode_player.*')
                ->leftJoin('users', 'coach_passcode_player.coach_id', '=', 'users.id')
                ->where(['users.created_by_id' => $auth_user])
                ->pluck('coach_passcode_player.player_id');
            //player list who are active
            $players = User::where(['role_id' => 4, 'is_archive' => 0])->whereIn('id', $passcode)->get();
            //list of team
            $teams = Team::where(['club_admin_id' => Auth::user()->id])->get();
            // team that assign to coach
            $coach_team =  DB::table('teams')
                ->select('teams.*', 'coach_teams.id as coach_group')
                ->rightJoin('coach_teams', 'teams.id', '=', 'coach_teams.team_id')
                ->where(['coach_teams.user_id' => $id])
                ->get();
            // Assign role to coach
            $coach_assign_roles =  DB::table('roles')
                ->select('roles.*', 'coach_roles.id as coach_role')
                ->rightJoin('coach_roles', 'roles.id', '=', 'coach_roles.role_id')
                ->where(['coach_roles.user_id' => $id])
                ->get();
            return view('coach.update-player', [
                'id' => $id,
                'data' => $data,
                'players' => $players,
                'coach_team' => $coach_team,
                'teams' => $teams,
                'coach_assign_roles' => $coach_assign_roles
            ]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * assign-player
     */
    public function assign_coach_to_player(Request $request, $id)
    {
        try {
            $validator = FacadesValidator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }
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

            $user =  User::where('id', $id)->update([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'image' => isset($filename) ? $filename : '',
                'phone' => $request['phone'],
                'role_id' => User::COACH_PLAYER,
                'created_by_id' => Auth::user()->id
            ]);
            CoachPasscode::create([
                'user_id' =>  $id,
                'title' => "Orignal Sport Club",
                'passcode' => rand(111111, 999999)

            ]);
            return redirect('coach-index');
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
            $validator = FacadesValidator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }
            if ($request->hasFile('image')) {
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            } else {
                $Userinfo = User::where('id', $id)->first();
                $filename = $Userinfo->image;
            }

            $user =  User::where('id', $id)->update([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'image' => isset($filename) ? $filename : '',
                'phone' => $request['phone'],
                'role_id' => '3'
            ]);

            return redirect('coach-index');
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
            $user = User::where(['id' => $id])->first();
            if ($user->role_id == 5) {
                $user =  User::where('id', $id)->update([
                    'role_id' => User::PLAYER
                ]);
            } else {
                $data = User::find($id)->delete();
            }
            return redirect('coach-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    // view page detail
    public function view()
    {
        try {
            $id = request()->get('id');
            $search = request()->get('search');
            $search_player = request()->get('search_player');
            $search_name = request()->get('search_name');
            $search_team = request()->get('search_team');
            $data = User::find($id);
            $group = Group::get();
            $teams = Team::get();
            $passcode = CoachPasscode::where(['user_id' => $id])->first();
            // teams that assign to coach
            $coach_team =  DB::table('teams')
                ->select('teams.*')
                ->rightJoin('coach_teams', 'teams.id', '=', 'coach_teams.team_id')
                ->where(['coach_teams.user_id' => $id])
                ->get();
            //search team
            if (!empty($search)) {

                $coach_team_data =  DB::table('teams')
                    ->select('teams.*')
                    ->rightJoin('coach_teams', 'teams.id', '=', 'coach_teams.team_id')
                    ->where(['coach_teams.team_id' => $search])
                    ->get();
            } elseif ($search_team) {
                $coach_team_data =  DB::table('teams')
                    ->select('teams.*')
                    ->rightJoin('coach_teams', 'teams.id', '=', 'coach_teams.team_id')
                    ->where('teams.team_name', 'LIKE', "%{$search_team}%")
                    ->get();
            } else {
                $coach_team_data =  DB::table('teams')
                    ->select('teams.*')
                    ->rightJoin('coach_teams', 'teams.id', '=', 'coach_teams.team_id')
                    ->where(['coach_teams.user_id' => $id])
                    ->get();
            }

            // group that assign to coach
            $coach_team_count =  DB::table('teams')
                ->select('teams.*')
                ->rightJoin('coach_teams', 'teams.id', '=', 'coach_teams.team_id')
                ->where(['coach_teams.user_id' => $id])
                ->count();

            $coach_passcode_player = CoachPasscodePlayer::where(['coach_id' => $id])->pluck('player_id')->toarray();
            $coach_player = User::whereIn('id', $coach_passcode_player)->get();

            // search player
            if (!empty($search_player)) {
                $group_player_list = User::where(['id' => $search_player])->whereIn('id', $coach_passcode_player)->get();
            } elseif ($search_name) {
                $group_player_list =
                    User::where('users.name', 'LIKE', "%{$search_name}%")->whereIn('id', $coach_passcode_player)->get();
            } else {
                $group_player_list = User::whereIn('id', $coach_passcode_player)->get();
            }
            $group_player_count = User::whereIn('id', $coach_passcode_player)->count();
            return view('coach.view', [
                'data' => $data,
                'coach_player' => $coach_player,
                'group_player_count' => $group_player_count,
                'group_player_list' => $group_player_list,
                'group' => $group,
                'passcode' => isset($passcode->passcode) ? $passcode->passcode : '',
                'coach_team' => $coach_team,
                'coach_team_count' => $coach_team_count,
                'coach_team_data' => $coach_team_data,
                'teams' => $teams
            ]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * Coach roles delete 
     */
    public function coach_role_delete(Request $request)
    {
        try {
            $id = request()->get('id');
            $data = CoachRole::find($id)->delete();
            return redirect('coach-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * Archive
     */
    public function archive()
    {
        try {
            $id = request()->get('id');
            $data =  User::where('id', $id)->first();
            if ($data->is_archive == 0) {
                User::where('id', $id)->update(['is_archive' => 1]);
                return redirect('coach-index');
            } else {
                User::where('id', $id)->update(['is_archive' => 0]);
                return redirect('archive-coach');
            }
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
    /** 
     * Coach group delete 
     */
    public function coach_group_delete(Request $request)
    {
        try {
            $id = request()->get('id');
            $data = CoachGroup::find($id)->delete();
            return redirect('coach-index');
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
            $name = "fc-coach-" . date('Ymd') . ".csv";

            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=" . $name);
            header("Pragma: no-cache");
            header("Expires: 0");

            $coachs = User::where(['role_id' => 3])->get();;
            $columns = array('Name', 'email', 'phone');

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($coachs as $coach) {
                fputcsv($file, array($coach->first_name . ' ' . $coach->last_name, $coach->email, $coach->phone));
            }
            exit();
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
}

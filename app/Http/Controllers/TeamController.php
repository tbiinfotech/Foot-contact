<?php

namespace App\Http\Controllers;

use App\Models\ClubInfo;
use App\Models\CoachPasscodePlayer;
use App\Models\CoachTeam;
use App\Models\PlayerTeam;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class TeamController extends Controller
{
    // index page
    public function index()
    {
        try {
            $data = Team::where(['club_admin_id' => Auth::user()->id])->orderBy('id', 'DESC')->paginate(10);
            return view('team.index', ['data' => $data]);
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
            $id = Auth::user()->id;
            $validator = FacadesValidator::make($request->all(), [
                'category' => 'required',
                'team_rank' => 'required',
                'year_limit' => 'required',
                'image' => 'required',
                'season' => 'required',
                'championship' => 'required',
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
            $club_admin_id = User::where(['id' => $id])->first();
            $data = Team::create([
                'club_info_id' => isset($club_admin_id->club_info_id) ? $club_admin_id->club_info_id : 0,
                'club_admin_id' => $id,
                'category' => $request->category,
                'team_rank' => $request->team_rank,
                'year_limit' => $request->year_limit,
                'team_name' => $request->category . '-' . $request->team_rank,
                'image' => $filename,
                'season' => $request->season,
                'teamcode'=>rand(10000,999999), 
                'championship' => $request->championship,
            ]);
          
            //add coaches
            $coaches = $request->coach;
            if (!empty($coaches)) {
                foreach ($coaches as $coach) {
                    //if coach is already player
                    $exist_as_player = PlayerTeam::where([
                        'team_id' => $data->id,
                        'user_id' => $coach
                    ])->first();
                    if(empty($exist_as_player)){
                        $exist_coach = CoachTeam::where(['team_id' => $data->id, 'user_id' => $coach])->exists();
                        if (!$exist_coach) {
                            CoachTeam::create([
                                'team_id' => $data->id,
                                'user_id' => $coach
                            ]);
                        }
                    }
                }
            }
            return redirect('team-index');
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
            $auth_user = Auth::user()->id;
            $id = request()->get('id');
            $data = Team::find($id);
            $clubs = ClubInfo::get();
            $passcode =    DB::table('coach_passcode_player')
                    ->select('coach_passcode_player.*')
                    ->leftJoin('users', 'coach_passcode_player.coach_id', '=', 'users.id')
                    ->where(['users.created_by_id' => $auth_user])
                    ->pluck('coach_passcode_player.player_id');
                $players = User::where(['role_id' => 4])->whereIn('id', $passcode);
            // $players = User::whereIn('id', $passcode)->get();
            $coaches = User::where(['is_archive' => 0, 'created_by_id' => Auth::user()->id])->whereIn('role_id',[3,5])->get();
            $coach_teams =  DB::table('coach_teams')
                ->select('users.*', 'coach_teams.id as coach_team_id')
                ->Join('users', 'coach_teams.user_id', '=', 'users.id')
                ->where(['coach_teams.team_id' => $id])
                ->where(['users.is_archive' => 0])
                ->get();
            //lists
            // $players_teams =  DB::table('player_teams')
            //     ->select('users.*','player_teams.id as player_team_id')
            //     ->Join('users', 'player_teams.user_id', '=', 'users.id')
            //     ->where(['player_teams.team_id' => $id])
            //     ->get();


            return view('team.edit', [
                'id' => $id, 'data' => $data,
                'clubs' => $clubs, 'players' => $players, 'coaches' => $coaches,
                'coach_teams' => $coach_teams,
                // 'players_teams' => $players_teams
            ]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * update
     */
    public function update(Request $request, $id)
    {
        // try {
        $auth_id = Auth::user()->id;
        $club_admin_id = User::where(['club_info_id' => $request->club_info_id])->first();
        $team_detail = Team::where(['id' => $id])->first();
        /**
         * validator
         */
        $validator = FacadesValidator::make($request->all(), [
            // 'club_info_id' => 'required',
            'category' => 'required',
            'team_rank' => 'required',
            'year_limit' => 'required',
            'team_name' => 'required',
            'image' => 'required',
            'season' => 'required',
            'coach'=>'required',
            'championship' => 'required',
        ]);
        /**
         * File 
         */
        if ($request->hasFile('image')) {
            $file = $request->file('image')->getClientOriginalName();
            $filename = time() . $file;
            $path = public_path('/Uploads');
            $file = $request->file('image');
            $file->move($path, $filename);
        }
        if (empty($filename)) {
            $filename = $team_detail->image;
        }
        $club_admin_id = User::where(['id' => $auth_id])->first();

        $data =  Team::where('id', $id)->update([
            'club_info_id' => isset($club_admin_id->club_info_id) ? $club_admin_id->club_info_id : 0,
            'club_admin_id' => $auth_id,
            'category' => $request->category,
            'team_rank' => $request->team_rank,
            'year_limit' => $request->year_limit,
            'team_name' => $request->team_name,
            'image' => $filename,
            'gender' => $request->gender,
            'season' => $request->season,
            'championship' => $request->championship,
        ]);
        
        //add coaches
        $coaches = $request->coach;
        if (!empty($coaches)) {
            $exist_coach = CoachTeam::where(['team_id' => $id])->delete();
            foreach ($coaches as $coach) {
                CoachTeam::create([
                    'team_id' => $id,
                    'user_id' => $coach
                ]);
            }
        }
        return redirect('team-index');
        // } catch (\Exception $e) {
        //     return $this->error($e->getMessage());
        // }
    }
    /**
     * Delete
     */
    public function delete()
    {
        try {
            $id = request()->get('id');
            $data = Team::find($id)->delete();
            $exist_coach = CoachTeam::where(['team_id' => $id])->delete();
            $exist_player = PlayerTeam::where(['team_id' => $id])->delete();

            return redirect('team-index');
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
    // view page detail
    public function view()
    {
         try {
        $id = request()->get('id');
        $data = Team::find($id);
        //query
        $coach_query = DB::table('coach_teams')
            ->select('users.*')
            ->Join('users', 'coach_teams.user_id', '=', 'users.id')
            ->where(['coach_teams.team_id' => $id])
            ->where(['users.is_archive' => 0]);
        $player_query = DB::table('player_teams')
            ->select('users.*')
            ->Join('users', 'player_teams.user_id', '=', 'users.id')
            ->where(['player_teams.team_id' => $id])
            ->where(['users.is_archive' => 0]);

        // count 
        $coach_count = $coach_query->count();
        $player_count = $player_query->count();

        //lists
        $players =  $player_query->get();
        $coaches =  $coach_query->get();


        return view('team.view', [
            'data' => $data,
            'coach_count' => $coach_count,
            'player_count' => $player_count,
            'players' => $players,
            'coaches' => $coaches,
        ]);
         } catch (\Exception $e) {
             return $this->error($e->getMessage());
         }
    }
    /**
     * team_coach_delete
     */
    public function team_coach_delete(Request $request)
    {
        try {
            $id = request()->get('id');
            $data = CoachTeam::find($id)->delete();
            return redirect('team-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * Coach roles delete 
     */
    public function team_player_delete(Request $request)
    {
        try {
            $id = request()->get('id');
            $data = PlayerTeam::find($id)->delete();
            return redirect('team-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}

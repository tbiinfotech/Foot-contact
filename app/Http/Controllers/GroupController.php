<?php

namespace App\Http\Controllers;

use App\Models\CoachGroup;
use App\Models\Group;
use App\Models\PlayerGroup;
use App\Models\Team;
use App\Models\TeamGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class GroupController extends Controller
{
    // index page
    public function index()
    {
        try {
            $id = Auth::user()->id;
            $data = Group::where(['user_id' => $id])->orderBy('id', 'DESC')->paginate(10);
            return view('group.index', [
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    // group add form
    public function group_add_form()
    {
        $teams = Team::get();
        $players = User::where(['role_id' => '4'])->get();
        $coaches = User::where(['role_id' => '3'])->get();

        return view(
            'group.add',
            [
                'teams' => $teams,
                'players' => $players,
                'coaches' => $coaches
            ]
        );
    }

    // add
    public function add(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = Auth::user()->id;
            $validator = FacadesValidator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'image' => 'required',
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
            $data = Group::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'logo' => $filename,
                'user_id' => $id
            ]);

            // add player
            $players = $request->player;
            if (!empty($players)) {
                foreach ($players as $player) {
                    $exist_player = PlayerGroup::where(['group_id' => $data->id, 'user_id' => $player])->exists();
                    if (!$exist_player) {
                        PlayerGroup::create([
                            'group_id' => $data->id,
                            'user_id' => $player
                        ]);
                    }
                }
            }

            //add team
            $teams = $request->team;
            if (!empty($teams)) {
                foreach ($teams as $team) {
                    $exist_team = TeamGroup::where(['group_id' => $data->id, 'team_id' => $team])->exists();
                    if (!$exist_team) {
                        TeamGroup::create([
                            'group_id' => $data->id,
                            'team_id' => $team
                        ]);
                    }
                }
            }

            //add coaches
            $coaches = $request->coach;
            if (!empty($coaches)) {
                foreach ($coaches as $coach) {
                    $exist_coach = CoachGroup::where(['group_id' => $data->id, 'user_id' => $coach])->exists();
                    if (!$exist_coach) {
                        CoachGroup::create([
                            'group_id' => $data->id,
                            'user_id' => $coach
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect('group-index');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    // view page detail
    public function view()
    {
        try {
            $id = request()->get('id');
            $data = Group::find($id);
            // count player,teams,coach
            $coach_count = CoachGroup::where(['group_id' => $id])->count();
            $team_count = TeamGroup::where(['group_id' => $id])->count();
            $player_count = PlayerGroup::where(['group_id' => $id])->count();

            //lists
            $players =  DB::table('player_groups')
                ->select('users.*')
                ->Join('users', 'player_groups.user_id', '=', 'users.id')
                ->where(['player_groups.group_id' => $id])
                ->get();

            $coaches =  DB::table('coach_groups')
                ->select('users.*')
                ->Join('users', 'coach_groups.user_id', '=', 'users.id')
                ->where(['coach_groups.group_id' => $id])
                ->get();

            $teams =  DB::table('team_groups')
                ->select('teams.*')
                ->Join('teams', 'team_groups.team_id', '=', 'teams.id')
                ->where(['team_groups.group_id' => $id])
                ->get();

            return view('group.view', [
                'data' => $data,
                'coach_count' => $coach_count,
                'team_count' => $team_count,
                'player_count' => $player_count,
                'players' => $players,
                'coaches' => $coaches,
                'teams' => $teams
            ]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    //update status
    public function status()
    {
        try {
            $id = request()->get('id');
            $data = Group::where('id', $id)->update(['status' => 0]);
            return view('group.view', ['data' => $data]);
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
            $data = Group::find($id)->delete();
            $teams = TeamGroup::where(['group_id' => $id])->delete();
            $players = PlayerGroup::where(['group_id' => $id])->delete();
            $coaches = CoachGroup::where(['group_id' => $id])->delete();
            return redirect('group-index');
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
            $data = Group::where(['id'=>$id])->first();
            $teams = Team::get();
            $players = User::where(['role_id' => '4'])->get();
            $coaches = User::where(['role_id' => '3'])->get();
            return view('group.edit', [
                'id' => $id, 
                'data'=>$data,
                'players' => $players,
                'coaches' => $coaches,
                'teams' => $teams
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
        DB::beginTransaction();
        try {
            $id = Auth::user()->id;
            $validator = FacadesValidator::make($request->all(), [
                // 'name' => 'required',
                // 'description' => 'required',
                'image' => 'required',
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
            $name= $request['name'];
            $pieces = explode(" ", $name);
            $data = Group::where('id', $id)->update([
                'name' => $request['name'],
                'first_name' => $pieces[0],
                'last_name' => $pieces[1],
                'description' => $request['description'],
                'logo' => $filename,
                'user_id' => $id
            ]);

            // add player
            $players = $request->player;
            if (!empty($players)) {
                foreach ($players as $player) {
                    $exist_player = PlayerGroup::where(['group_id' => $id, 'user_id' => $player])->exists();
                    if (!$exist_player) {
                        PlayerGroup::create([
                            'group_id' => $id,
                            'user_id' => $player
                        ]);
                    }
                }
            }

            //add team
            $teams = $request->team;
            if (!empty($teams)) {
                foreach ($teams as $team) {
                    $exist_team = TeamGroup::where(['group_id' => $id, 'team_id' => $team])->exists();
                    if (!$exist_team) {
                        TeamGroup::create([
                            'group_id' => $id,
                            'team_id' => $team
                        ]);
                    }
                }
            }

            //add coaches
            $coaches = $request->coach;
            if (!empty($coaches)) {
                foreach ($coaches as $coach) {
                    $exist_coach = CoachGroup::where(['group_id' => $id, 'user_id' => $coach])->exists();
                    if (!$exist_coach) {
                        CoachGroup::create([
                            'group_id' => $id,
                            'user_id' => $coach
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect('group-index');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
       
    }
    /**
     * export
     */
    public function export()
    {
        try {
            $user_id = Auth::user()->id;
            $name = "fc-group-" . date('Ymd') . ".csv";
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=" . $name);
            header("Pragma: no-cache");
            header("Expires: 0");
            $groups = Group::where(['user_id' => $user_id])->get();
            if (!empty($groups)) {
                $columns = array('id', 'Name', 'Players', 'Teams', 'Coaches');
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                foreach ($groups as $group) {
                    fputcsv($file, array($group->id, $group->name, $group->getCount($group->id, Group::PLAYER), $group->getCount($group->id, Group::TEAM), $group->getCount($group->id, Group::COACH)));
                }
                exit();
            }
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Group;
use App\Models\Parents;
use App\Models\PlayerGroup;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Validators\Validator;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ArchiveController extends Controller
{
    // index page
    public function index()
    {
        try {
            $auth_user = Auth::user()->id;
            if (Auth::user()->role_id == "1") {
                // user showing on the admin panel
                $data = User::where(['is_archive' => 1])->whereIn('role_id', [4, 5]);
            } else {
                // user showing on the club panel
                $passcode =    DB::table('coach_passcode_player')
                    ->select('coach_passcode_player.*')
                    ->leftJoin('users', 'coach_passcode_player.coach_id', '=', 'users.id')
                    ->where(['users.created_by_id' => $auth_user])
                    ->pluck('coach_passcode_player.player_id');
                $data = User::where(['is_archive' => 1])->whereIn('role_id', [4, 5])->whereIn('id', $passcode);
            }
            //search conditions
            $data = $data->orderBy('id', 'DESC')->paginate(10);
            return view('archive.index', ['data' => $data]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    // archive coach
    public function archiveCoach()
    {
        try {
            $data = User::where(['is_archive' => 1, 'created_by_id' => Auth::user()->id,])
            ->whereIn('role_id', [3, 5])
            ->orderBy('id', 'DESC')
            ->paginate(10);
            return view('archive.coach', ['data' => $data]);
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
            $coach_groups =  DB::table('groups')
                ->select('groups.*')
                ->rightJoin('player_groups', 'groups.id', '=', 'player_groups.group_id')
                ->where(['player_groups.user_id' => $id])
                ->get();
            $parent =  Parents::where(['user_id' => $id])->get();
            return view('archive.view', ['data' => $data, 'coach_groups' => $coach_groups, 'parent' => $parent]);
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
            // to set player unachrive
            $id = request()->get('id');
            $data =  User::where('id', $id)
                ->update(['is_archive' => 0]);
            return redirect('archive-index');
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
}

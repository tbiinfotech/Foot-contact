<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    const SUPER_ADMIN = 1;
    const CLUB_ADMIN = 2;
    const COACH = 3;
    const PLAYER = 4;

    const COACH_PLAYER = 5;

  
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'image',
        'email',
        'date_of_birth',
        'password',
        'phone',
        'parent_user_id',
        'has_parent',
        'otp_verify',
        'otp', 
        'is_archive',
        'role_id',
        'status',
        'sport_category_id',
        'verified',
        'token',
        'token_expires_at',
        'email_verified_at', 
        'device_token',
        'reset_token',
        'fcm_token',
        'updated_at',
        'club_info_id',
        'created_by_id',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function currentpage()
    {
        $current_page=  request()->get('page');
        if(empty($current_page)){
            $current_page=  1;
        }
        return $current_page;
    }
    public function getUserCount($id)
    { 
       $data = User::where(['created_by_id'=>$id])->count();
        return $data;
    }
    public function getGroupName($id)
    {
        $name = " ";
        $groups = DB::table('groups')
            ->select('groups.name')
            ->rightJoin('coach_groups', 'groups.id', '=', 'coach_groups.group_id')
            ->where(['coach_groups.user_id' => $id])->limit(2)
            ->get();
        foreach ($groups as $group) {

            $name .= $group->name.",";
        }
        return $name;
    }
    public function getClubName($id)
    {
        $groups = DB::table('clubs') 
            ->select('clubs.name')
            ->Join('users', 'clubs.id', '=', 'users.club_info_id')
            ->where(['users.id'=>$id])
            ->first();
       return $groups->name;
    }
    public function getGroupCount($id)
    {
        $groups = DB::table('groups')
            ->select('groups.name')
            ->rightJoin('coach_groups', 'groups.id', '=', 'coach_groups.group_id')
            ->where(['coach_groups.user_id' => $id])
            ->count();
        return $groups;
    }
    /**
     * count number of group player
     */
    public function playerGroupCount($id)
    {
        $groups = DB::table('teams')
            ->select('teams.*')
            ->rightJoin('player_teams', 'teams.id', '=', 'player_teams.team_id')
            ->where(['player_teams.user_id' => $id])
            ->count();
        return $groups;
    }
     /**
     * count number of group player name
     */
    public function playerGroupName($id)
    {
        $name = " ";
        $groups = DB::table('groups')
            ->select('groups.name')
            ->rightJoin('player_groups', 'groups.id', '=', 'player_groups.group_id')
            ->where(['player_groups.user_id' => $id])->limit(2)
            ->get();
        foreach ($groups as $group) {

            $name .= $group->name.",";
        }
        return $name;
    }
      /**
     * count number of coach player name
     */
    public function playerClubName($id)
    {
        $groups = DB::table('users')
            ->select('users.*')
            ->rightJoin('coach_passcode_player', 'users.id', '=', 'coach_passcode_player.coach_id')
            ->where(['coach_passcode_player.player_id' => $id])->first();
       $name=isset($groups->first_name)?$groups->first_name:'';
        return $name;
    }
     /**
     * count number of tea, player
     */
    public function playerTeamCount($id)
    {
        $teams =  DB::table('teams')
        ->select('teams.*')
        ->rightJoin('coach_teams', 'teams.id', '=', 'coach_teams.team_id')
        ->where(['coach_teams.user_id' => $id])
        ->count();
         
        return $teams;
    }
      /**
     * count number of coach player name 
     */
    public function playerTeamName($id)
    {
     
        $teams =  DB::table('teams')
        ->select('teams.*')
        ->rightJoin('coach_groups', 'teams.id', '=', 'coach_groups.group_id')
        ->where(['coach_groups.user_id' => $id])
        ->first();
       
        // dd($teams); 
       $name=isset($teams->team_name)?$teams->team_name:'';
        return $name;
    }
}

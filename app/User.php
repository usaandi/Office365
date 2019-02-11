<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;


    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token', 'phone', 'birthday',
        'skype', 'image', 'description', 'ADMsince',
        'team',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'users_skills');
    }



    public function strengths()
    {
        return $this->hasMany(UserStrength::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'users_departments');
    }

    public function department()
    {
        return $this->hasOne('App\UserDepartment', 'user_id');
    }

    public function userDepartments()
    {
        return $this->hasMany(UserDepartment::class);
    }

    public function team()
    {
        return $this->hasOne('App\UserTeam', 'user_id');
    }

    public function hobbies()
    {
        return $this->belongsToMany('App\Hobby', 'users_hobbies')
            ->using('App\UserHobby');
    }

    public function userHobbies()
    {
        return $this->hasMany(UserHobby::class);
    }

    public function children()
    {
        return $this->hasMany('App\UserChildren', 'user_id');
    }

    public function userCareerRole()
    {
        return $this->hasMany(UserCareerRole::class);
    }


    public function userCareerRoleMilestones()
    {
        return $this->hasMany(UserCareerRoleMilestone::class);
    }

    public function userStrength()
    {
        return $this->hasMany(UserStrength::class);
    }

    public function userStrengths()
    {
        return $this->belongsToMany(Strength::class, 'users_strengths')
            ->withPivot('rank');
    }

    public function isModeratorOfTeam($teamId)
    {
        if (\Auth::user()->hasRole('Moderator')) {
            $userId = \Auth::user()->id;
            $moderator = UserTeamModerator::where('user_id', $userId)
                ->where('team_id', $teamId)
                ->get(['team_id']);
            return $moderator->count() === 1;
        }
        return FALSE;
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'users_teams');
    }


    public function moderator()
    {

        $teamIds = [];

        if (\Auth::user()->hasRole('Moderator')) {
            $userId = \Auth::user()->id;
            $teamIds = UserTeamModerator::where('user_id', $userId)
                ->get(['team_id'])->toArray();
        }
        return json_encode($teamIds);

    }

}

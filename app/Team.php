<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table='teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'team_name',
    ];

    public function user() {
        return $this->belongsTo(UserTeam::class);
    }

    public function moderator(){
        return $this->belongsToMany(UserTeamModerator::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'users_teams');
    }

    public function moderators()
    {
        return $this->belongsToMany(User::class,'users_teams_moderators');
    }
}

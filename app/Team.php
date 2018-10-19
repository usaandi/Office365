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
        return $this->belongsTo('App\UserTeam');
    }

    public function moderator(){
        return $this->belongsToMany(UserTeamModerator::class);
    }
}

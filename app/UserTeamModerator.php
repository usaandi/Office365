<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTeamModerator extends Model
{
    protected $fillable = ['user_id','team_id'];
    protected $table = 'users_teams_moderators';

}

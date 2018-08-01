<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TeamModerator extends Pivot
{
    protected $table=('teams_moderators');

    public function moderator(){
        return $this->belongsTo('App\Team');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserTeam extends Pivot
{
    protected $table=('users_teams');

    public function user(){
        return $this->belongsTo('App\User');
    }
}

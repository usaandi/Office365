<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_name', 'team_abbr'
    ];

    public function user() {
        return $this->hasMany('App\UserTeam');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class TeamDepartment extends Pivot
{
    protected $table = 'departments_teams';

    public function team() {
        return $this->belongsTo('App\Team', 'department_id', 'team_id');
    }

    public function department() {
        return $this->belongsTo('App\Department', 'team_id', 'department_id');
    }

}

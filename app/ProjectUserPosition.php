<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUserPosition extends Model
{
    protected $table = 'projects_users_positions';
    protected $fillable = ['user_id', 'project_id', 'position_id'];

}

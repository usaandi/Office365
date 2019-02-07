<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTechnologyUser extends Model
{
    protected $table = 'projects_technologies_users';
    protected $fillable = ['user_id', 'project_id', 'technologies_id'];
}

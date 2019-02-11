<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTechnologyUser extends Model
{
    protected $table = 'projects_technologies_users';
    protected $fillable = ['user_id', 'project_id', 'technology_id'];

    public static function userTechnologies($projectId)
    {
        return ProjectTechnologyUser::with('users', 'technologies')->where('project_id', $projectId)->get();
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function technologies()
    {
        return $this->hasMany(Technology::class, 'id', 'technology_id');
    }
}

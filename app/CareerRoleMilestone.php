<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CareerRoleMilestone extends Model
{
    protected $table = 'career_roles_milestones';
    protected $fillable = ['task','career_role_id'];

    public function careerRole()
    {
        return $this->belongsTo(CareerRole::class);
    }

    public function userCareerRoleMilestones()
    {
        return $this->belongsToMany(UserCareerRoleMilestone::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CareerRole extends Model
{
    protected $table = 'career_roles';
    protected $fillable= ['title','description'];

    public function userCareerRole() {
        return $this->belongsTo(UserCareerRole::class);
    }

    public function careerRoleMilestones() {
        return $this->hasMany(CareerRoleMilestone::class);
    }

}

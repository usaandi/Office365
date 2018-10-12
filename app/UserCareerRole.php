<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCareerRole extends Model
{
    protected $table = 'users_career_roles';

    protected $fillable = [
        'user_id',
        'career_role_id',
        'title',
        'description',
        'current_role',
    ];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function careerRole()
    {
        return $this->hasOne(CareerRole::class);
    }

    public function careerRoleMilestone()
    {
        return $this->hasMany(UserCareerRoleMilestone::class, 'user_career_role_id');
    }
}

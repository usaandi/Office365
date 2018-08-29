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
        'description'
    ];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function careerRole()
    {
        return $this->hasOne(CareerRole::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    protected $table = 'users_skills';

    protected $fillable = ['skill_value', 'skill_id', 'user_id'];
}

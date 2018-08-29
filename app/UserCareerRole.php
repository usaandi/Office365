<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserCareer extends Pivot
{
    protected $table='users_career_roles';

    protected $fillable = ['user_id', 'career_role_id'];
}

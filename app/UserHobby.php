<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserHobby extends Pivot {

    protected $table = 'users_hobbies';

    protected $fillable = ['user_id', 'hobby_id'];

}
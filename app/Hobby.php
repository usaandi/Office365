<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $table = 'hobbies';

    public function users() {
        return $this->belongsToMany('App\User', 'users_hobbies')
            ->using('App\UserHobby');
    }

}

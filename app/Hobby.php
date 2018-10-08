<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $table = 'hobbies';

    protected $fillable = ['name'];

    public function users() {
        return $this->belongsToMany('App\User', 'users_hobbies')
            ->using('App\UserHobby');
    }

}

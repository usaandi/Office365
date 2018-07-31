<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $table = 'hobbies';

    public function hobby(){
        return $this ->belongsTo('App\UserHobby');
    }
}

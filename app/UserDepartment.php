<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model
{

    protected $table = 'users_departments';

    public function user(){
        return $this->belongsTo('App\User');
    }
}

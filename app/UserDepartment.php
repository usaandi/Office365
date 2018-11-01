<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserDepartment extends Pivot
{

    protected $table = 'users_departments';

    public function user(){
        return $this->belongsTo('App\User');
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChildren extends Model
{
    protected $table = 'users_children';


    public function children(){
        return $this->belongsTo('App\User');
    }
}

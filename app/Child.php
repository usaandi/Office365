<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $table = 'children';


    public function child(){
        return $this->belongsTo('App\User');
    }
}

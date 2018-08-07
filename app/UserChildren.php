<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChildren extends Model
{
    protected $table = 'users_children';

    protected $fillable=['year_born','name','user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}

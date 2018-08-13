<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserChildren extends Model
{
    protected $table = 'users_children';

    protected $fillable=['year_born','name','user_id'];
    protected $dates=['year_born'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function getAge(){
        $this->attributes['year_born']->diff(Carbon::now())->format('%y years , %m months %d days');
    }
}

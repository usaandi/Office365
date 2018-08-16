<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;


    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token' ,'phone', 'birthday',
        'skype', 'image', 'description', 'ADMsince',
        'team',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token',
    ];

    public function department() {
        return $this->hasOne('App\UserDepartment', 'user_id');
    }

    public function hobbies() {
        return $this->belongsToMany('App\Hobby', 'users_hobbies')
            ->using('App\UserHobby');
    }

    public function children() {
        return $this->hasMany('App\UserChildren', 'user_id');
    }
    public function info() {
        return $this->hasMany('App\UserInfo', 'user_id');
    }



}

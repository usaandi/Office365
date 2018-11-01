<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_name', 'department_abbr', 'department_info',
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'users_departments')
            ->using('App\UserDepartment');
    }

    public function departmentUsers()
    {
        return $this->belongsToMany(User::class,'users_departments');
    }

    /*public function userss()
    {
        return $this->hasManyThrough(User::class,UserDepartment::class,'id','user_id','id');
    }*/
}

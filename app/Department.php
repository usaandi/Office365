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

    public function user() {
        return $this->hasMany('App\UserDepartment');
    }
    public function team() {
        return $this->hasMany('App\TeamDepartment');
    }
}

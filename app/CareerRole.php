<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'career_roles';
    protected $fillable= ['title','description'];

    public function userCareer() {
        return $this->belongsTo('App\UserCareer');
    }

    public function careerMilestone() {
        return $this->belongsTo('App\CareerRoleMilestone');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCareerRoleMilestone extends Model
{
     protected $table = 'users_career_roles_milestones';

     protected $fillable=[
         'milestone_id',
         'user_id',
         'assigned_id',
         'task',
         'reminder',
         'completed'
     ];

     public function user(){
         return $this->hasOne(User::class);
     }
     public function careerRoleMilestone(){
         return $this->hasOne(CareerRoleMilestone::class);
     }

    public function assignee() {
         return $this->belongsTo(User::class, 'assigned_id');
    }

}

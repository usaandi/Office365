<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechnologyUser extends Model
{
    protected $table = 'technologies_users';
    protected $fillable = ['user_id', 'technology_id'];
}

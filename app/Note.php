<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['title', 'description', 'user_career_role_id', 'assigner_id'];
    protected $table = 'notes';


    public function career()
    {
        return $this->hasMany(UserCareerRole::class, 'id');
    }

    public static function getNameByUserId($id)
    {
        return User::where('id', $id)->first()->name;
    }

}

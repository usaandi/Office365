<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Strength extends Model
{
    protected $table='strengths';

    protected $fillable=[
        'strength_name',
        'strength_description',
    ];

    public function strengthCategory(){
        return $this->hasMany(StrengthCategory::class);
    }
    public function userStrength(){
        return $this->belongsToMany(UserStrength::class);
    }



}

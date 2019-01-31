<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['position_name'];

    public static function getPositionsNames()
    {
        return Position::get(['position_name']);
    }
}

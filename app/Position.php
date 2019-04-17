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

    public static function getPositionObjectByName($name)
    {
        return $position = Position::where('position_name', $name)->first();
    }

    public static function createPosition($name)
    {
        return $position = Position::create(['position_name' => $name]);
    }
}

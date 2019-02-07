<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $fillable = ['technology_name'];
    protected $table = 'technologies';


    public static function getTechnologyObjectByName($name)
    {
        return Technology::where('technology_name', $name)->first();
    }

    public static function createTechnology($name)
    {
        $technology = Technology::create([
            'technology_name' => $name,
        ]);

        return $technology;
    }
}

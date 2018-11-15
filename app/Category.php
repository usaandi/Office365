<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';

    protected $fillable = [
        'category_name',
        'category_description',
        'category_colour',
    ];

    public function strengthCategory()
    {
        return $this->hasMany(StrengthCategory::class);
    }

    public function strengths()
    {
        return $this->belongsToMany(Strength::class,'strengths_categories');
    }


}

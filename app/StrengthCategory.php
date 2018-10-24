<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StrengthCategory extends Model
{

    protected $table = 'strengths_categories';

    protected $fillable = [
        'strength_id',
        'category_id',
        'category_description',
    ];

    public function strength(){
       return $this->belongsTo(Strength::class);
    }

    public function category(){
       return $this->belongsTo(Category::class);
    }
}

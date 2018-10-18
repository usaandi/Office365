<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StrengthCategory extends Model
{
    protected $fillable = [
        'strength_id',
        'category_id',
        'category_description',
    ];

    public function strength(){
        $this->belongsTo(Strength::class);
    }

    public function category(){
        $this->belongsTo(Category::class);
    }
}

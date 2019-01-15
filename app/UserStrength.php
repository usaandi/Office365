<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStrength extends Model
{
    protected $table = 'users_strengths';

    protected $fillable = [
        'strength_id',
        'user_id',
        'rank',
    ];
    protected $casts = [
        'user_id' => 'integer',
        'strength_id' => 'integer'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function strength()
    {

        return $this->belongsTo(Strength::class);
    }
}

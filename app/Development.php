<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Development extends Model
{
    protected $table = 'developments';

    public function development() {
        return $this->belongsTo('App\UserDevelopment');
    }


}

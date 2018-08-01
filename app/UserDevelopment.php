<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserDevelopment extends Pivot
{
    protected $table='users_development';
}

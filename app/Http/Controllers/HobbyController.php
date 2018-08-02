<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hobby;

class HobbyController extends Controller
{
    public function hobby(){

        $hobbies=Hobby::get(['hobby_name']);

        return $hobbies;

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PersonalDevelopmentController extends Controller
{
    public function userDevelopment($id){

        $user = User::findOrFail($id);

        return view('user.usercareer', compact('user'));
    }
}

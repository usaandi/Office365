<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id){
        $user=User::findOrFail($id);

//

        return view('userinfo')->with('user',$user,'email',$user,'id',$id);
    }

}
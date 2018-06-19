<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
//       $user= DB::table('users')->get('name');
//       return view('home')->with('name',$user);

        return view('home')->with('user',$user,'email',$user,'id',$user);


    }
}

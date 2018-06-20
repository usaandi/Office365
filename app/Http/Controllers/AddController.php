<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AddController extends Controller
{
    public function add(){

//        $name =input::get('name');
//        $email =input::get('email');


        return view('partials.adduser');
    }
    public function store(Request $request){

           $request->validate([
                'name'=>'required',
               'email'=> 'required|email',
               ]

           );
            $name=$request->input('name');
            $email=$request->input('email');

            $user = User::where('email', '=', $email)->first();

            if($user===null){

                User::create(['email' => $email,'name'=>$name,'token'=>null]);

                sleep(4);

                return view('user.adduser');
            }
            else {
                echo 'Sellise nimega isik: '.$name.' ja Emailiga:'.$email.' On juba andmebaasis';
            }


            //return view('partials.adduser');


       // var_dump($name,$email);






    }
}

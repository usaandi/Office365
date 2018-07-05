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


        return view('user.adduser');
    }
    public function store(Request $request){

           $request->validate([

                'name'=>'required',
                'email'=> 'required|email',
                'phone'=> 'required|int',
                'birthday'=> 'required|date',
                'skype'=>'required',
                'team'=>'required',
                'ADMsince'=>'required|date',
               ]
           );
            $name=$request->input('name');
            $email=$request->input('email');
            $phone=$request->input('phone');
            $birthday=$request->input('birthday');
            $skype=$request->input('skype');
            $team=$request->input('team');
            $ADMsince=$request->input('ADMsince');

        //$userteam= Team::where('team_name', '=', $team);

     /*   if ($userteam===null){
            Team::create(['team_name'=>$team]);

        }*/

        $user = User::where('email', '=', $email)->first();

            if($user===null){

                User::create(['email' => $email,'name'=>$name,'token'=>null,'phoneN'=>$phone,
                    'birthday'=>$birthday, 'skype'=>$skype, 'team'=>$team,'ADMsince'=>$ADMsince]);



                return view('user.adduser');
            }
            else {
                echo 'Sellise nimega isik: '.$name.' ja Emailiga:'.$email.' On juba andmebaasis';
            }


            //return view('partials.adduser');


       // var_dump($name,$email);






    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {

        $user = User::findorFail($id);

        return view('user.profileview', compact('user'));
        //->with('user',$user);
//
    }

    public function showedit($id)
    {

        $user = User::findorFail($id);
        $roles = Role::all();
        return view('user.userupdate', compact(['user', 'roles']));
    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'name' => '',
            'email' => 'email',
            'phone' => 'int',
            'birthday' => 'date',
            'skype' => '',
            'team' => '',
            'ADMsince' => 'date',
            'role' => '',
        ]);
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $birthday = $request->input('birthday');
        $skype = $request->input('skype');
        $team = $request->input('team');
        $ADMsince = $request->input('ADMsince');
        $role = $request->input('role');

        $user = User::findOrFail($id);

        $userRole = Role::findByName($role);

        if (!$user->hasRole($userRole)) {

            $user->removeRole($user->roles()->first()->name);
            $user->assignRole($userRole);
        }

        $user->update(['email' => $email, 'name' => $name, 'phoneN' => $phone,
        'birthday' => $birthday, 'skype' => $skype, 'team' => $team, 'ADMsince' => $ADMsince]);
        $user->save();

        return redirect()->back();


    }
}
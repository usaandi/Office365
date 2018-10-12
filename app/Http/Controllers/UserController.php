<?php

namespace App\Http\Controllers;

use App\Department;
use App\Team;
use Illuminate\Http\Request;
use App\User;
use App\UserInfo;
use auth;
use Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function show($id)
    {

        $userModel = User::findorFail($id);
        $user = $userModel->toArray();

        $userDepartment = $userModel->department()->get(['department_id'])->first();
        $userTeam =$userModel->team()->get(['team_id'])->first();

        if ($userDepartment !== NULL) {
            $department = Department::find($userDepartment->department_id);
            $user['department'] = $department->department_name;
            $user['department_id'] = $department->id;
        }
        if($userTeam !== NULL){
            $team = Team::find($userTeam->team_id);
            $user['team'] = $team->team_name;
            $user['team_id'] = $team->id;
        }
        return view('user.profileview', compact('user'));
    }

    public function showedit($id)
    {

        $user = User::findorFail($id);
        $roles = Role::all();
        return view('user.userupdate', compact(['user', 'roles']));
    }

    public function update(Request $request, $id)
    {

        try{

            //TODO add back authorize code below if live
           /* $authUser = \Auth::user();
            $this->authorize('admin', $authUser);*/

            $request->validate([
                'name' => 'nullable',
                'email' => 'email|nullable',
                'phone' => 'int|nullable',
                'birthday' => 'date|nullable',
                'skype' => 'nullable',
                'ADMsince' => 'date|nullable',
                'role' => 'nullable',
            ]);
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $birthday = $request->input('birthday');
            $skype = $request->input('skype');
            $ADMsince = $request->input('ADMsince');
            $role = $request->input('role');

            $user = User::findOrFail($id);

            $userRole = Role::findByName($role);

            if (!$user->hasRole($userRole)) {

                $user->removeRole($user->roles()->first()->name);
                $user->assignRole($userRole);
            }

            $user->update(['email' => $email, 'name' => $name, 'phoneN' => $phone,
            'birthday' => $birthday, 'skype' => $skype,  'ADMsince' => $ADMsince]);
            $user->save();

            return redirect()->back();
        }catch(\Exception $e){}

    }

    public function updateTeam(Request $request, $id)
    {
        try {

            $user = User::findOrFail($id);
            $this->authorize('update', $user);

            $request->validate([
                'data' => 'string'
            ]);
            $team = $request->data;
            $user->team = $team;
            $user->save();

            return response('success', 200)
                ->header('Content-Type', 'application/json');
        }
        catch(\Exception $e) {
        }
        return response('Error updating user', 400)
            ->header('Content-Type', 'application/json');
    }

    public function updatePhone(Request $request, $id)
    {

        try {

            // Validate that the current user is authorized to do this update.
            // authorize will automatically kill the request if auth fails.


            $user = User::findOrFail($id);
            $this->authorize('update', $user);

            $request->validate([
                'data' => 'integer'
            ]);

            $phone = $request->data;

            $user->phone = $phone;
            $user->save();

            return response('success', 200)
                ->header('Content-Type', 'application/json');

        }
        catch(\Exception $e) {

        }
        return response('Error updating user', 400)
            ->header('Content-Type', 'application/json');

    }

    public function updateEmail(Request $request, $id)
    {
        try {

            $user = User::findOrFail($id);

            $this->authorize('update', $user);
            $request->validate([
                'data' => 'email'
            ]);


            $email = $request->data;

            $user->email =  $email;
            $user->save();

            return response('success', 200)
                ->header('Content-Type', 'application/json');

        }
        catch(\Exception $e) {

        }
        return response('Error updating user', 400)
            ->header('Content-Type', 'application/json');
    }

    public function updateSkype(Request $request, $id)
    {
        try {


            $user = User::findOrFail($id);
            $this->authorize('update', $user);

            $request->validate([
                'data' => 'string'
            ]);


            $skype = $request->data;

            $user->skype = $skype;
            $user->save();

            return response('success', 200)
                ->header('Content-Type', 'application/json');

        }
        catch(\Exception $e) {

        }
        return response('Error updating user', 400)
            ->header('Content-Type', 'application/json');
    }

    public function userIdName()
    {
        $users = User::get(['id','name']);

        return $users;
    }




}
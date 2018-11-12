<?php

namespace App\Http\Controllers;

use App\Department;
use App\Team;
use App\UserDepartment;
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
        try {
            $userModel = User::findorFail($id);
            $user = $userModel->toArray();
            $userModel->userCareerRole()->get();
            $userCareer = $userModel->userCareerRole()->where('current_role',1)->first();
            $userDepartment = $userModel->department()->get(['department_id'])->first();
            $userTeam = $userModel->team()->get(['team_id'])->first();

            if($userCareer !==null){
                $user['career_title'] = $userCareer->title;
                $user['career_description'] = $userCareer->description;
            }

            if ($userDepartment !== NULL) {
                $department = Department::find($userDepartment->department_id);
                $user['department'] = $department->department_name;
                $user['department_id'] = $department->id;
            }
            if ($userTeam !== NULL) {
                $team = Team::find($userTeam->team_id);
                $user['team'] = $team->team_name;
                $user['team_id'] = $team->id;
            }
            return view('user.profileview', compact('user'));
        } catch (\Exception $e) {
            return redirect('/unauthorized');
        }

    }

    public function showedit($id)
    {

        try {
            //TODO Re ADD THIS COMMENTED OUT LINE if going live
             /*$user = \Auth::user();
             $this->authorize('admin', $user);*/

            $user = User::findorFail($id);
            $userDepartment = UserDepartment::where('user_id', $id)->first(['department_id']);
            $departmentId = $userDepartment->department_id;
            $currentDepartment = Department::where('id', $departmentId)->get(['id', 'department_name']);
            $roles = Role::all();
            $departments = Department::all();
            return view('user.userupdate', compact(['user', 'roles', 'departments', 'currentDepartment']));
        } catch (\Exception $e) {
            $errorMessage= $e->getMessage();
            return view('unauthorized.unauthorized', compact(['errorMessage']));
        }

    }

    public function deleteUser(Request $request)
    {
        try {
            $data = $request->all();

            $rules = [
                'userId' => 'required'
            ];
            $validator = Validator::make($data,$rules);
            if($validator->passes()){
                $user = User::findOrFail($data['userId']);


                $user->forceDelete();

                return response('User'.''.$user->name.''.'deleted',200);


            }
        } catch (\Exception $e) {
            $errors = 'Did not find User';
            return response ($errors,500);
        }
    }

    public function update(Request $request, $id)
    {

        try {

            //TODO ReADD THIS COMMENTED OUT LINE
           /*$user = \Auth::user();
            $this->authorize('admin', $user);*/

            $request->validate([
                'name' => 'nullable',
                'phone' => 'int|nullable',
                'birthday' => 'date|nullable',
                'skype' => 'nullable',
                'ADMsince' => 'date|nullable',
                'role' => 'nullable',
                'department' => 'nullable'
            ]);
            $name = $request->input('name');
            $phone = $request->input('phone');
            $birthday = $request->input('birthday');
            $skype = $request->input('skype');
            $ADMsince = $request->input('ADMsince');
            $role = $request->input('role');
            $departmentId = $request->input('department');

            $userDepartment = UserDepartment::where('user_id', $id)->get();
            $userDepartmentId = $userDepartment[0]->department_id;

            if ($userDepartmentId != $departmentId) {

                UserDepartment::where('user_id', $id)->first()->update(['department_id' => $departmentId]);
            }
            $user = User::findOrFail($id);


            $userRole = Role::findByName($role);

            if (!$user->hasRole($userRole)) {

                $user->removeRole($user->roles()->first()->name);
                $user->assignRole($userRole);
            }

            $user->update(['name' => $name, 'phoneN' => $phone,
                'birthday' => $birthday, 'skype' => $skype, 'ADMsince' => $ADMsince]);
            $user->save();

            return redirect()->back();
        } catch (\Exception $e) {


             return view('unauthorized.unauthorized',with(['error' => $e->getMessage()]));
        }

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
        } catch (\Exception $e) {
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

        } catch (\Exception $e) {

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

            $user->email = $email;
            $user->save();

            return response('success', 200)
                ->header('Content-Type', 'application/json');

        } catch (\Exception $e) {

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

        } catch (\Exception $e) {

        }
        return response('Error updating user', 400)
            ->header('Content-Type', 'application/json');
    }

    public function userIdName()
    {
        $users = User::get(['id', 'name']);

        return $users;
    }

    public function AdminUsersListView()
    {
        try {
            $user = \Auth::user();
            $this->authorize('admin', $user);

            return view('admin.userList');

        } catch (\Exception $exception) {
            return redirect('/unauthorized');
        }
    }


}
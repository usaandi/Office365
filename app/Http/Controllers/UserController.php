<?php

namespace App\Http\Controllers;

use App\Department;
use App\Team;
use App\UserDepartment;
use App\UserTeam;
use Illuminate\Http\Request;
use App\User;
use App\UserInfo;
use Carbon\Carbon;
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
            $userCareer = $userModel->userCareerRole()->where('current_role', 1)->first();
            $userDepartment = $userModel->department()->get(['department_id'])->first();
            $userTeam = $userModel->team()->get(['team_id'])->first();

            if ($userCareer !== null) {
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
            $userModel = User::findOrFail($id);
            $this->authorize('update', $userModel);

            $user = User::findorFail($id);

            $userTeam = $user->userTeam()->first();
            $userDepartment = $user->userDepartment()->first();

            $roles = Role::all();
            $departments = Department::all();
            $teams = Team::get(['id as team_id', 'team_name']);
            return view('user.userupdate', compact(['user', 'roles', 'departments', 'userDepartment', 'teams', 'userTeam']));
        } catch (\Exception $e) {
            return view('unauthorized.unauthorized', with(['error' => $e->getMessage()]));
        }

    }

    public function deleteUser(Request $request)
    {
        try {
            $user = \Auth::user();
            $this->authorize('admin', $user);

            $data = $request->all();

            $rules = [
                'userId' => 'required'
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->passes()) {
                $user = User::findOrFail($data['userId']);


                $user->forceDelete();

                return response('User' . '' . $user->name . '' . 'deleted', 200);


            }
        } catch (\Exception $e) {
            return view('unauthorized.unauthorized', with(['error' => $e->getMessage()]));
        }
    }

    public function update(Request $request, $id)
    {

        try {

            $userModel = User::findOrFail($id);
            $this->authorize('update', $userModel);
            $data = $request->all();

            $request->validate([
                'name' => 'required',
                'phone' => 'numeric|nullable',
                'birthday' => 'nullable',
                'skype' => 'nullable',
                'ADMsince' => 'date|nullable',
                'role' => 'nullable',
                'department' => 'nullable',
                'team' => 'nullable'
            ]);

            $birthday = $data['birthday'];


            $realBirthday = Carbon::parse($birthday)->toDateTimeString();
            $realAdmSince = Carbon::parse($data['ADMsince'])->toDateTimeString();

            $name = $request->input('name');
            $phone = $request->input('phone');
            $skype = $request->input('skype');
            $ADMsince = $request->input('ADMsince');
            $role = $request->input('role');
            $departmentId = $request->input('department');
            $teamId = $request->input('team');
            if ($role === null) {
                $role = 'User';
            }

            $userDepartment = UserDepartment::where('user_id', $id)->get();
            $userTeam = UserTeam::where('user_id', $id)->first();

            if ($userTeam === null) {
                userTeam::create([
                    'user_id' => $id,
                    'team_id' => $teamId
                ]);
            } else {
                $userTeam->update(['team_id' => $teamId]);

            }

            if ($userDepartment->isEmpty()) {

                $userDepartments = UserDepartment::create([
                    'user_id' => $id,
                    'department_id' => $departmentId
                ]);
            } else {
                $userDepartmentId = $userDepartment[0]->department_id;
                if ($userDepartmentId != $departmentId) {

                    UserDepartment::where('user_id', $id)->first()->update(['department_id' => $departmentId]);
                }
            }


            $user = User::findOrFail($id);

            $authUser = \Auth::user();


            if ($authUser->hasRole('Admin')) {
                $return = $this->removeRoles($user);
                $userRole = Role::findByName($role);
                $user->assignRole($userRole);


            }

            $user->update(['name' => $name, 'phone' => $phone,
                'birthday' => $realBirthday, 'skype' => $skype, 'ADMsince' => $realAdmSince]);
            $user->save();

            return redirect()->back()->with('success', true);
        } catch (\Exception $e) {


            return view('unauthorized.unauthorized', with(['error' => 'Something went Wrong']));
        }

    }

    protected function removeRoles($user)
    {
        $roles = $user->getRoleNames();
        foreach ($roles as $role) {
            $user->removeRole($role);
        }
        return true;

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
                'data' => 'required|max:15'
            ]);

            $phone = $request->data;
            $phoneTrimmed = str_replace(' ', '', trim($phone));
            $user->phone = $phoneTrimmed;
            $user->save();

            return response('success', 200)
                ->header('Content-Type', 'application/json');

        } catch (\Exception $e) {
            return response('Invalid number', 400)
                ->header('Content-Type', 'application/json');
        }


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

    public function users()
    {
        try {
            $users = User::with('departments')->get();


            return $users;
        } catch (\Exception $e) {
        }
    }


}
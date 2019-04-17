<?php

namespace App\Http\Controllers;


use App\Department;
use App\UserDepartment;
use Illuminate\Http\Request;
use App\User;
use auth;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AddController extends Controller
{
    public function add()
    {

        try {
            $user = \Auth::user();
            $this->authorize('admin', $user);

            $roles = Role::get(['name as role_name', 'id as role_id']);
            $departments = Department::get(['department_name', 'id as department_id']);
            return view('user.adduser', with(['departments' => $departments, 'roles' => $roles]));
        } catch (\Exception $e) {
            return view('unauthorized.unauthorized', with(['error' => $e->getMessage()]));
        }

    }

    public function store(Request $request)
    {
        try {

            $user = \Auth::user();
            $this->authorize('admin', $user);

            $data = $request->all();
            $request->validate([

                    'name' => 'required',
                    'email' => 'required|email',
                    'ADMsince' => 'nullable|date',
                    'department' => 'nullable',
                    'role' => 'required',
                ]
            );
            $name = $request->input('name');
            $email = $request->input('email');
            $ADMsince = $request->input('ADMsince');
            $departmentId = $request->input('department');
            $admJoinDate = Carbon::parse($ADMsince)->toDateTimeString();


            $user = User::where('email', '=', $email)->first();

            if ($user === null) {

                $userId = User::create(['email' => $email, 'name' => $name, 'token' => null, 'ADMsince' => $admJoinDate])->id;

                $userFind = User::findOrFail($userId);

                if ($departmentId) {

                    UserDepartment::create([
                        'user_id' => $userId,
                        'department_id' => $departmentId,
                    ]);
                }

                $roleName = Role::findById($request->input('role'));

                $userFind->assignRole($roleName);


                $userFind->save();


                return redirect()->back()->with('success', true);
            } else {
                return redirect()->back()->with('errors', [$email]);
            }
        } catch (\Exception $e) {
            return view('unauthorized.unauthorized', with(['error' => $e->getMessage()]));
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Department;
use App\UserDepartment;
use Illuminate\Http\Request;
use App\User;
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
                    'phone' => 'required|int',
                    'birthday' => 'required|date',
                    'skype' => 'required',
                    'ADMsince' => 'required|date',
                    'department' => 'required',
                    'role' => 'required',
                ]
            );
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $birthday = $request->input('birthday');
            $skype = $request->input('skype');
            $ADMsince = $request->input('ADMsince');
            $departmentId = $request->input('department');


            $user = User::where('email', '=', $email)->first();

            if ($user === null) {

                $userId = User::create(['email' => $email, 'name' => $name, 'token' => null, 'phone' => $phone,
                    'birthday' => $birthday, 'skype' => $skype, 'ADMsince' => $ADMsince])->id;

                $userFind = User::findOrFail($userId);

                UserDepartment::create([
                   'user_id'=> $userId,
                   'department_id'=> $departmentId,
                ]);
                $roleName = Role::findById($request->input('role'));

                $userFind->assignRole($roleName);



                $userFind->save();



                return redirect()->back();
            } else {
                echo 'Sellise nimega isik: '  .$name . ''.' ja Emailiga: ' . $email . ' On juba olemas';
            }
        } catch (\Exception $e) {
        }
    }
}

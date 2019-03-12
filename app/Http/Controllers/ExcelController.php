<?php

namespace App\Http\Controllers;

use App\Department;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\User;
use App\UserDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;


class ExcelController extends Controller
{
    public function view()
    {
        $user = Auth::user();
        $this->authorize('admin', $user);
        return view('ExcelPage');
    }

    public function downloadExcel()
    {
        $user = Auth::user();
        $this->authorize('admin', $user);
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function importExcel(Request $request)
    {
        $authUser = Auth::user();
        $this->authorize('admin', $authUser);
        $email = null;
        $fullName = null;
        $department = null;
        $birthday = null;
        $admSince = null;
        $phone = null;
        $role = null;
        $users = Excel::toCollection(new UsersImport(), $request->file('import_file'));
        $cutUserList = $users[0]->slice(1, count($users[0]));
        foreach ($cutUserList as $user) {
            $email = $user[0];
            $firstName = $user[1];
            $lastName = $user[2];
            $departmentName = $user[3];
            $birthday = Carbon::parse($user[4])->toDateTimeString();
            $admSince = Carbon::parse($user[5])->toDateTimeString();
            $phone = $user[6];
            $role = $user[7];
            $createUser = User::where('email', $email)->first();

            if ($createUser) {
                $this->removeRoles($createUser);
                $userRole = Role::findByName($role);
                $createUser->assignRole($userRole);
                $createUser->update([
                    'email' => $email,
                    'phone' => $phone,
                    'name' => $firstName . " " . $lastName,
                    'birthday' => $birthday,
                    'ADMsince' => $admSince,
                ]);

            } else {
                $createUser = User::create([
                    'email' => $email,
                    'phone' => $phone,
                    'name' => $firstName . " " . $lastName,
                    'birthday' => $birthday,
                    'ADMsince' => $admSince,

                ]);
                $userRole = Role::findByName($role);
                $createUser->assignRole($userRole);
            }
            $department = Department::where('department_name', $departmentName)->first();
            if ($department) {

            } else {
                $department = Department::create([
                    'department_name' => $departmentName,
                    'department_abbr' => $departmentName,
                    'department_info' => $departmentName,
                ]);

            }
            $userDepartment = UserDepartment::where('user_id', $createUser->id)->first();

            if ($userDepartment) {
                $userDepartment->update([
                    'department_id' => $department->id,
                ]);
            } else {
                UserDepartment::create([
                    'department_id' => $department->id,
                    'user_id' => $createUser->id
                ]);
            }
        }
        return redirect()->route('home');
    }

    protected function removeRoles($user)
    {
        $roles = $user->getRoleNames();
        foreach ($roles as $role) {
            $user->removeRole($role);
        }
        return true;

    }
}

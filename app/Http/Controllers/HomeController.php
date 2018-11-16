<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use auth;
use App\Department;
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

    public function userNoDepartment()
    {

        $userdata = User::with('department')->get(['users.id', 'users.name']);

        foreach ($userdata as $key => $user) {

            if ($user->department !== null) {
                $user->department_id = $user->department->department_id;
            } else {
                $user->department_id = NULL;
            }
            unset($user->department);

        }

        return $userdata;
    }

    public function index()
    {
        /*
        $trash=DB::table('users')
            ->whereNotNull('deleted_at')
            ->get();*/
        $users = User::get();
        foreach ($users as $i => $user) {
            $userCareer = $user->userCareerRole()->where('current_role', 1)->first();
            $userDepartmentId = $user->department()->first();
            if($userDepartmentId){
                $departmentName = Department::find($userDepartmentId->department_id)->department_abbr;
                $users[$i]['current_department'] = $departmentName;
            }
            if ($userCareer) {
                $users[$i]['current_role'] = $userCareer->title;
            }
        }
        return view('home')->with(['users' => $users]);
    }
}

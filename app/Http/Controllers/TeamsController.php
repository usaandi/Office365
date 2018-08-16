<?php

namespace App\Http\Controllers;

use App\Department;
use App\UserDepartment;
use Validator;
use App\User;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function updateTeam(Request $request, $id)
    {

        try {

            $request->validate([
                'data' => 'required|max:30'
            ]);
            $user = User::findOrFail($id);

            $teamName = $request->data;
            $capitalizeTeam = ucfirst($teamName);

            $department = Department::where('department_name',
                $capitalizeTeam)->first();

            if($department === NULL){
                $departmentAbbr=substr($capitalizeTeam,0,-2);
                $department = Department::create
                ([
                    'department_name'=>$capitalizeTeam,
                    'department_abbr'=>$departmentAbbr,
                    'department_info'=>'This is Department: '.$capitalizeTeam,
                ]);
            }

            $userDepartment = $user->department()->first();

            if ($userDepartment === NULL) {
                UserDepartment::create([
                   'department_id' => $department->id,
                   'user_id' => $id
                ]);
            }
            else if ($userDepartment->department_id !== $department->id) {
                $userDepartment->department_id = $department->id;
                $userDepartment->save();
            }

            return response('success', 200)
                ->header('Content-Type', 'application/json');

        } catch (\Exception $e){

            return response('Error updating user', 400)
                ->header('Content-Type', 'application/json');
        }


    }
}

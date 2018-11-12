<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Team;
use App\Department;

class PersonalDevelopmentController extends Controller
{
    public function userDevelopment($id){


        try {


            //$authUser = \Auth::user();
            $userModel= User::findOrFail($id);
            $this->authorize('view', $userModel);

            $user = User::findOrFail($id)->id;

            return view('user.usercareer', compact('user'));


        } catch (\Exception $e) {

        }


    }
    public function userInfo($id)
    {
        $authUserId = \Auth::user()->id;

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
        return $user;
    }
}

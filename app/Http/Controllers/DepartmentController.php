<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function teamDepartment($id){

        $departmentid=Department::findOrFail($id);

        $data=$departmentid->teams()->get(['departments_teams.id','team'])->toArray();

        if (!empty($data)) {

            foreach ($data as $key => $val) {

                if (array_key_exists('pivot', $data[$key])) {
                    unset($data[$key]['pivot']);
                }

            }

        }

        return $data;

    }
    public function userDepartment($id){

        $departmentid=Department::findOrFail($id);

        $data=$departmentid->users()->get(['users_departments.id','name'])->toArray();

        if (!empty($data)) {

            foreach ($data as $key => $val) {

                if (array_key_exists('pivot', $data[$key])) {
                    unset($data[$key]['pivot']);
                }

            }

        }

        return $data;

    }
    public function department(){


        return view('team.departmentView');
    }

    public function departmentInfo(){

        $departments = Department::all();

       return $departments;


    }
    public function view(){

        return view('team.departmentAdd');
    }
    public function store(Request $request){

        $request->validate([
            'departmentName'=>'required|string|min:3|max:255',
            'departmentAbbr'=> 'required|string|min:3|max:10',
            'description'=> 'required|string|min:3|max:255',
        ]);
        $departmentName=$request->input('departmentName');
        $departmentAbbr=$request->input('departmentAbbr');
        $description=$request->input('description');


        $department = Department::where('department_name', '=', $departmentName)->first();

        if($department===null){

            Department::create(['department_name' => $departmentName,
            'department_abbr'=>$departmentAbbr, 'department_info' => $description]);

            return redirect()->back();
        }
        else {
            return response('Duplicate Department entry', 403)
                ->header('Content-Type', 'application/json');
        }

    }

    public function show($id)
    {
        // For some reason the variable name department did not work.

        $dprtment = Department::findOrFail($id);
        $teams = $dprtment->teams()->get();
        $users = $dprtment->users()->get();
        return view('team.teamView')->with(
            [
                'users' => $users,
                'department' => $dprtment,
                'teams' => $teams,
            ]
        );
    }
}

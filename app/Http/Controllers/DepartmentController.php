<?php

namespace App\Http\Controllers;


use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function department(){

        $departments = Department::all();
        return view('team.departmentView')->with('departments',$departments);
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

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
}

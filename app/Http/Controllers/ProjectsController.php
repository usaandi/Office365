<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        try {

            return view('project.project');

        } catch (\Exception $e) {
        }
    }

    public function indexCreate()
    {
        try {
            return view('project.projectCreate');

        } catch (\Exception $e) {
        }
    }
}

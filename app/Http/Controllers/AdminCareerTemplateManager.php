<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCareerTemplateManager extends Controller
{
    public function index()
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);



            return view('admin.adminManageCareerTemplate');
        } catch (\Exception $exception) {
        }
    }
}

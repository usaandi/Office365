<?php

namespace App\Http\Controllers;

use App\CareerRole;
use Illuminate\Http\Request;

class AdminCareerTemplateManager extends Controller
{
    public function index()
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);

            $array = [];
            $careerRoles = CareerRole::get();

            foreach ($careerRoles as $careerRole) {
                $careerRoleMilestones = $careerRole->careerRoleMilestones()->get();

                $array[]=[
                  'title' => $careerRole->title,
                  'description'=> $careerRole->description
                ];
            }

            return view('admin.adminManageCareerTemplate')->with(['array'=>$array]);
        } catch (\Exception $exception) {
        }
    }
}

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


            $careerRoles = CareerRole::with('careerRoleMilestones')->get();

            foreach ($careerRoles as $key => $careerRole) {

                $array[$key]['milestones'] = [];
                $array[$key]['career_role_id'] = $careerRole->id;
                $array[$key]['task'] = $careerRole->title;
                $array[$key]['description'] = $careerRole->description;

                foreach ($careerRole->careerRoleMilestones()->get() as $careerRoleMilestone) {
                    $array[$key]['milestones'][] = [
                        'task' => $careerRoleMilestone->task,
                        'careerRoleMilestoneId' => $careerRoleMilestone->id

                    ];
                }
            }

            return view('admin.adminManageCareerTemplate')->with(['array' => $array]);
        } catch (\Exception $exception) {
        }
    }
}

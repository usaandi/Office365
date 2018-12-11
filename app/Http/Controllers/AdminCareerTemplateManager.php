<?php

namespace App\Http\Controllers;

use App\CareerRole;
use Illuminate\Http\Request;
use Validator;

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

    public function careerUpdate(Request $request, $careerRoleId)
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);

            $data = $request->all();
            $rules = [
                'careerDescription' => 'required|string',
                'careerTask' => 'required|string',
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $careerTask = $data['careerTask'];
                $careerDescription = $data['careerDescription'];

                $sanitizeTask = ucfirst(strtolower($careerTask));


                $careerRole = CareerRole::where('id', $careerRoleId)->update([
                    'title'=> $sanitizeTask, 'description'=>$careerDescription
                ]);

                $careerRoleNew = CareerRole::where('id',$careerRoleId)
                    ->first(['title','description']);
                return response(json_encode($careerRoleNew),200);
            }

        } catch (\Exception $e) {

        }
    }
}

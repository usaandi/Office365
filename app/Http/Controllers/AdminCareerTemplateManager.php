<?php

namespace App\Http\Controllers;

use App\CareerRole;
use App\CareerRoleMilestone;
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

            if($validator->fails()){
                return response('Bad Request', 400);
            }

            if ($validator->passes()) {

                $careerTask = $data['careerTask'];
                $careerDescription = $data['careerDescription'];

                $sanitizeTask = ucfirst(strtolower($careerTask));


                $careerRole = CareerRole::where('id', $careerRoleId)->update([
                    'title' => $sanitizeTask, 'description' => $careerDescription
                ]);

                $careerRoleNew = CareerRole::where('id', $careerRoleId)
                    ->first(['title', 'description']);
                return response(json_encode($careerRoleNew), 200);
            }
        } catch (\Exception $e) {


        }
    }

    public function deleteCareerMilestone(Request $request)
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);
            $data = $request->all();

            $rules = [
                'careerMilestoneId' => 'required|integer'
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $careerRoleMilestone = CareerRoleMilestone::findOrFail($data['careerMilestoneId']);
                 $careerRoleMilestone->delete();

                return response('success', 200);

            }

        } catch (\Exception $e) {
        }
    }

    public function updateCareerMilestone(Request $request, $careerMilestoneId)
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);

            $data = $request->all();
            $rules = [
                'careerMilestoneTask' => 'required|string|max:20',
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $careerMilestoneTask = $data['careerMilestoneTask'];

                $sanitizeTask = ucfirst(strtolower($careerMilestoneTask));

                $careerRole = CareerRoleMilestone::where('id', $careerMilestoneId)->update([
                    'task' => $sanitizeTask]);


                $careerRoleNew = CareerRoleMilestone::where('id', $careerMilestoneId)
                    ->first(['task']);

                return response(json_encode($careerRoleNew), 200);
            }
        } catch (\Exception $e) {
        }
    }

    public function deleteCareer(Request $request)
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);
            $data = $request->all();

            $rules = [
                'careerId' => 'required|integer'
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $careerRole = CareerRole::findOrFail($data['careerId']);
                 $careerRole->delete();

                return response('success', 200);

            }
        } catch (\Exception $e) {
        }
    }

    public function createMilestone(Request $request, $careerId)
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);
            $data = $request->all();
            $rules = [
                'careerMilestoneTask' => 'required|string'
            ];

            $validator = Validator::make($data, $rules);
            if ($validator->passes()) {
                $task = $data['careerMilestoneTask'];
                $careerMilestoneTask = ucfirst(strtolower($task));
                $existsCareerMilestone = CareerRoleMilestone::where('career_role_id', $careerId)->where('task', $careerMilestoneTask)->get();

                if ($existsCareerMilestone->isEmpty()) {
                    $newCareerMilestone = CareerRoleMilestone::create(['task' => $careerMilestoneTask, 'career_role_id' => $careerId]);

                    $jsonObject = [
                        'careerRoleMilestoneId' => $newCareerMilestone->id,
                        'task' => $newCareerMilestone->task,
                    ];

                    return response(json_encode($jsonObject), 200);


                } else {

                }
            }

        } catch (\Exception $e) {
        }
    }
}

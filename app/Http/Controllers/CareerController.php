<?php

namespace App\Http\Controllers;

use App\UserCareerRoleMilestone;
use Illuminate\Http\Request;
use App\CareerRole;
use App\CareerRoleMilestone;
use PhpParser\Node\Expr\Array_;
use Validator;
use App\User;

class CareerController extends Controller
{
    public function show()
    {

        return view('user.addcareer');
    }

    public function create(Request $request)
    {

        try {
            if (!empty($request->all())) {

                $data = $request->all()[0];

                $rules = [
                    'title' => 'required|string|max:30',
                    'description' => 'required|',
                    'milestoneList' => 'array',
                ];

                $validator = Validator::make($data, $rules);

                if ($validator->passes()) {

                    $title = $data['title'];
                    $description = $data['description'];

                    $titlecapitalized = ucfirst($title);

                    $refactorTitle = str_replace('_', ' ', $titlecapitalized);
                    $titleCleared = $refactorTitle;

                    $refactorDescription = str_replace('_', ' ', $description);
                    $descriptionCleared = $refactorDescription;

                    $career = CareerRole::where([
                        'title' => $titleCleared])->get();

                    if ($career->isEmpty()) {

                        $career = CareerRole::create([
                            'title' => $titleCleared,
                            'description' => $descriptionCleared
                        ]);

                        foreach ($data['milestonesList'] as $milestone) {
                            CareerRoleMilestone::create([
                                'task' => $milestone,
                                'career_role_id' => $career->id
                            ]);
                        }
                        unset($milestone);
                    }
                }
            }
        } catch (\Exception $e) {
        }
    }

    public function careerRoleMilestonesData()
    {
        $careerRoles = CareerRole::all();
        return $careerRoles;
    }

    public function returnUserData($id)
    {

        $user = User::find($id);
        $userCareerRoleMilestone = $user->userCareerRole()->with('careerRoleMilestone.assignee')->get();
        $data = [];

        foreach ($userCareerRoleMilestone as $key => $careerRole) {

            $data[$key]['id'] = $careerRole->id;
            $data[$key]['career_role_id'] = $careerRole->career_role_id;
            $data[$key]['user_id'] = $careerRole->user_id;
            $data[$key]['title'] = $careerRole->title;
            $data[$key]['description'] = $careerRole->description;
            $data[$key]['milestones'] = [];

            foreach ($careerRole->careerRoleMilestone as $careerMilestone) {

                $data[$key]['milestones'][] = [
                    'id' => $careerMilestone->id,
                    'milestone_id' => $careerMilestone->milestone_id,
                    'user_id' => $careerMilestone->user_id,
                    'user_career_role_id' => $careerMilestone->user_career_role_id,
                    'assigned_id' => $careerMilestone->assigned_id,
                    'assigned_username' => $careerMilestone->assignee->name,
                    'task' => $careerMilestone->task,
                    'reminder' => $careerMilestone->reminder,
                    'completed' => $careerMilestone->completed,
                ];
            }
        }
        unset($careerRole);
        return $data;
    }

    public function createMilestone(Request $request, $id)
    {
        try {

            $data = $request->all()[0];

            $rules = [
                'taskName' => 'required|string|max:30',
                'reminder' => 'required|',
                'assignerUserId' => 'required|',
                'CareerRoleId' => 'required|'
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $user = User::findOrFail($id);

                $taskName = $data['taskName'];
                $reminder = $data['reminder'];
                $assignerUserId = $data['assignerUserId'];
                $careerRoleId = $data['CareerRoleId'];

                $capitalizeTaskName = ucfirst($taskName);

                $query = $user->userCareerRoleMilestones()
                    ->where('task', $capitalizeTaskName)
                    ->where('user_career_role_id', $careerRoleId)
                    ->get();

                if ($query->isEmpty() === false) {
                     //Return something that To VUE that it is duplicate entry
                    //TODO
                }

                if ($query->isEmpty() === true) {
                    $userCareerMilestone = UserCareerRoleMilestone::create([
                        'user_id' => $id,
                        'assigned_id' => $assignerUserId,
                        'user_career_role_id' => $careerRoleId,
                        'task' => $capitalizeTaskName,
                        'reminder' => $reminder,
                        'completed' => 0,
                        //TODO
                        //Return data back to vue so it can display new milestone.
                    ]);
                }

            }
        }
        catch(\Exception $e) {

        }

    }

    public function createCareer(Request $request, $id)
    {
        try {
            $data = $request->all();

            $rules = [
                'careerRoleId' => 'required|max:6'
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $careerRoleId = $data['careerRoleId'];

                $careerRoleMilestones = CareerRole::with('careerRoleMilestones')->findOrFail($careerRoleId);

                $milestones = [];

                foreach ($careerRoleMilestones->careerRoleMilestones()->get() as $milestone) {
                    $milestones[] = [
                        'id' => '',
                        'milestone_id' => $milestone->id,
                        'user_id' => $id,
                        'user_career_role_id' => '',
                        'assigned_id' => '',
                        'assigned_username' => '',
                        'task' => $milestone->task,
                        'reminder' => '',
                        'completed' => '0',
                    ];
                }

                $array[] = [
                    'career_role_id' => $careerRoleMilestones->id,
                    'title' => $careerRoleMilestones->title,
                    'description' => $careerRoleMilestones->description,
                    'user_id' => $id,
                    'milestones' => $milestones,
                ];

            }

            return $array;

        }
        catch (\Exception $e){

        }
    }

    public function saveCareer(Request $request, $id)
    {

        $data = $request->all();



        $rules = [

            'career_role_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'milestones' => 'nullable|array',
            'milestones.*.id' => 'nullable',
            'milestones.*.milestone_id' => 'nullable',
            'milestones.*.user_id' => 'nullable',
            'milestones.*.user_career_role_id' => 'nullable',
            'milestones.*.assigned_id' => 'nullable',
            'milestones.*.assigned_username' => 'nullable',
            'milestones.*.task' => 'required',
            'milestones.*.reminder' => 'nullable',
            'milestones.*.completed' => 'required',



        ];

        $validator = Validator::make($data, $rules);

        try {
            if ($validator->passes()) {

                if (empty($data['milestones']) === false) {

                    $milestones = $data['milestones'];
                }

                $careerRoleId = $data['career_role_id'];
                $title = $data['title'];
                $description = $data['description'];
                $userId = $data['user_id'];

                $ucTitle = ucfirst($title);

                $user = User::findOrFail($id);

                $query = $user->UserCareerRole()
                    ->where('title', $ucTitle)
                    ->where('user_id', $userId)
                    ->get();

                if ($query->isEmpty() === false) {
                    //Return something that To VUE that it is duplicate entry
                    //TODO
                }
                if ($query->isEmpty() === true) {

                    $userCareerRoleId = $user->UserCareerRole()->create([
                        'career_role_id' => $careerRoleId,
                        'title' => $ucTitle,
                        'description' => $description,
                        'user_id' => $userId,
                    ])->id;
                }

            }
        }catch (\Exception $e){

        }

    }
}
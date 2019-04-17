<?php

namespace App\Http\Controllers;

use App\UserCareerRole;
use App\UserCareerRoleMilestone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\CareerRole;
use App\CareerRoleMilestone;
use PhpParser\Node\Expr\Array_;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class CareerController extends Controller
{
    public function show()
    {
        try {

            return view('user.addcareer');

        } catch (\Exception $e) {
        }

    }

    public function create(Request $request)
    {

        try {
            $authUser = \Auth::user();
            $this->authorize('admin', $authUser);
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
                                'task' => $milestone['milestoneName'],
                                'career_role_id' => $career->id,
                                'description' => $milestone['milestoneDescription']
                            ]);
                        }
                        unset($milestone);

                        return response('Success', 200);
                    }
                }
            }
        } catch (\Exception $e) {
        }
    }

    public function completeMilestone(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $this->authorize('updateMilestone', $user);

            $data = $request->all();
            $rules = [
                'milestoneId' => 'required',
                'status' => 'required',
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->passes()) {

                $userMilestoneId = $data['milestoneId'];
                $userCareermilestone = UserCareerRoleMilestone::where('id', $userMilestoneId)->first();
                $userCareermilestone->update(['completed' => $data['status']]);
                $newValue = $userCareermilestone->completed;
                $dataArray = [
                    'value' => $newValue,
                ];
                return response(json_encode($dataArray), 200);

            }


        } catch (\Exception $e) {
            return response('Something went wrong' . ' ' . $e->getMessage(), 403);
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
            $data[$key]['created_at'] = $careerRole->created_at->toDateString();
            $data[$key]['title'] = $careerRole->title;
            $data[$key]['description'] = $careerRole->description;
            $data[$key]['current_role'] = $careerRole->current_role;
            if ($careerRole->creation_date) {
                $data[$key]['creation_date'] = $careerRole->creation_date;
            } else {
                $data[$key]['creation_date'] = '';
            }

            $data[$key]['milestones'] = [];

            foreach ($careerRole->careerRoleMilestone as $careerMilestone) {


                $data[$key]['milestones'][] = [
                    'id' => $careerMilestone->id,
                    'milestone_id' => $careerMilestone->milestone_id,
                    'user_id' => $careerMilestone->user_id,
                    'user_career_role_id' => $careerMilestone->user_career_role_id,
                    'assigned_id' => $careerMilestone->assigned_id,
                    'assigned_username' => $careerMilestone->assignee->name,
                    'assigned_image' => $careerMilestone->assignee->image,
                    'task' => $careerMilestone->task,
                    'description' => $careerMilestone->description,
                    'reminder' => $careerMilestone->reminder,
                    'completed' => $careerMilestone->completed,
                ];
            }
        }
        unset($careerRole);
        return $data;
    }

    public function deleteCareer(Request $request, $id)
    {
        try {

            $user = User::findOrFail($id);
            $this->authorize('deleteMilestone', $user);
            $data = $request->all();

            $rules = [
                'careerId' => 'required|int'
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $careerId = $data['careerId'];
                $userCareerRole = UserCareerRole::where('id', $careerId)->first();
                $userCareerRole->delete();

                return response($careerId, 200);
            }

        } catch (\Exception $e) {
        }
    }

    public function updateCareer(Request $request, $id)
    {
        try {
            // $authUser = \Auth::user();
            $user = User::findOrFail($id);

            $this->authorize('updateCareer', $user);
            $data = $request->all();

            $rules = [
                'roleTitle' => 'required',
                'descriptionValue' => 'required',
                'careerId' => 'required',
                'creationDate' => 'nullable'
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $SanitizeInput = ucfirst(strtolower($data['roleTitle']));

                $user->userCareerRole()
                    ->where('id', $data['careerId'])
                    ->where('user_id', $id)
                    ->update([
                        'title' => $SanitizeInput,
                        'description' => $data['descriptionValue'],
                        'creation_date' => $data['creationDate'],
                    ]);
                $newData = $user->userCareerRole()->where('id', $data['careerId'])->where('user_id', $id)->first();
                return response(json_encode($newData), 200)
                    ->header('Content-Type', 'application/json');
            }
            if ($validator->fails()) {
                return response('bad request', 400);
            }


        } catch (\Exception $e) {
        }
    }

    public function selectCareer(Request $request, $id)
    {
        try {
            $authUser = \Auth::user();
            $user = User::findOrFail($id);

            $this->authorize('createCareer', $user);

            $data = $request->all();

            $activeRole = $user->userCareerRole()->where('current_role', 1)
                ->update(['current_role' => 0]);

            $inactiveRole = $user->userCareerRole()->where('id', $data['userCareerRoleId'])
                ->update(['current_role' => 1]);
        } catch (\Exception $e) {
        }
    }

    public function createCareer(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $this->authorize('createCareer', $user);
            $authUser = \Auth::user();
            $array = [];
            $data = $request->all();

            $rules = [
                'careerRoleId' => 'required'
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $careerRoleId = $data['careerRoleId'];

                $careerRoleMilestones = CareerRole::with('careerRoleMilestones')->findOrFail($careerRoleId);

                $milestones = [];

                $userCareerRole = UserCareerRole::create([
                    'career_role_id' => $careerRoleId,
                    'user_id' => $id,
                    'title' => $careerRoleMilestones['title'],
                    'description' => $careerRoleMilestones['description'],
                    'current_role' => 0,
                ]);

                foreach ($careerRoleMilestones->careerRoleMilestones()->get() as $milestone) {
                    $userCareerRoleMilestones = UserCareerRoleMilestone::create([
                        'milestone_id' => $milestone->id,
                        'user_id' => $id,
                        'assigned_id' => $authUser->id,

                        'assigned_username' => $authUser->name,
                        'user_career_role_id' => $userCareerRole->id,
                        'task' => $milestone->task,
                        'description' => $milestone->description,
                        'reminder' => null,
                        'completed' => 0,
                    ]);

                    $milestones[] = [
                        'id' => $userCareerRoleMilestones->id,
                        'milestone_id' => $userCareerRoleMilestones->id,
                        'user_id' => $id,
                        'assigned_id' => $authUser->id,
                        'assigned_username' => $authUser->name,
                        'user_career_role_id' => $userCareerRole->id,
                        'task' => $milestone->task,
                        'description' => $milestone->description,
                        'reminder' => null,
                        'completed' => 0,
                    ];
                }

                $array[] = [
                    'id' => $userCareerRole['id'],
                    'career_role_id' => $careerRoleId,
                    'title' => $userCareerRole['title'],
                    'description' => $userCareerRole['description'],
                    'user_id' => $id,
                    'current_role' => 0,
                    'creation_date' => null,
                    'milestones' => $milestones,

                ];

            }

            return $array;

        } catch (\Exception $e) {

        }
    }

    public function saveCareer(Request $request, $id)
    {
        try {
            $data = $request->all();
            $authUser = \Auth::user();
            $user = User::findOrFail($id);
            $this->authorize('createCareer', $user);

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
                'milestones.*.assigned_id' => 'required',
                'milestones.*.assigned_username' => 'required',
                'milestones.*.task' => 'required',
                'milestones.*.reminder' => 'required',
                'milestones.*.completed' => 'required',

            ];

            $validator = Validator::make($data, $rules);


            if ($validator->passes()) {

                $careerRoleId = $data['career_role_id'];
                $title = $data['title'];
                $description = $data['description'];
                $userId = $data['user_id'];
                $ucTitle = ucfirst(strtolower($title));

                $user = User::findOrFail($id);


                $userCareerRole = $user->UserCareerRole()->create([
                    'career_role_id' => $careerRoleId,
                    'title' => $ucTitle,
                    'description' => $description,
                    'user_id' => $userId,
                    'current_role' => 0,
                ]);
                $milestonesArray = [];
                if (empty($data['milestones']) === false) {
                    $milestones = $data['milestones'];
                    foreach ($milestones as $milestone) {
                        $milestonesList = $user->userCareerRoleMilestones()->create([

                            'milestone_id' => $milestone['milestone_id'],
                            'user_id' => $milestone['user_id'],
                            'assigned_id' => $milestone['assigned_id'],
                            'user_career_role_id' => $userCareerRole->id,
                            'task' => $milestone['task'],
                            'reminder' => $milestone['reminder'],
                            'completed' => $milestone['completed'],
                        ]);
                        $milestonesArray[] = [
                            'id' => $milestonesList->id,
                            'milestone_id' => $milestone['milestone_id'],
                            'user_id' => $milestone['user_id'],
                            'assigned_id' => $milestone['assigned_id'],
                            'user_career_role_id' => $userCareerRole->id,
                            'task' => $milestone['task'],
                            'reminder' => $milestone['reminder'],
                            'completed' => $milestone['completed'],
                        ];
                    }
                    unset($milestone);
                }
                $career = [
                    'id' => $userCareerRole->id,
                    'career_role_id' => $careerRoleId,
                    'title' => $ucTitle,
                    'description' => $description,
                    'user_id' => $id,
                    'current_role' => 0,
                    'milestones' => $milestonesArray,
                ];
                $jsonData = json_encode($career);
                return response($jsonData, 200)
                    ->header('Content-Type', 'application/json');

            }
        } catch (\Exception $e) {
        }
    }

    public function createMilestone(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $authUser = \Auth::user();
            $this->authorize('createMilestone', $user);

            $data = $request->all()[0];

            $rules = [
                'taskName' => 'required|string|max:30',
                'reminder' => 'required|',
                'description' => 'nullable',
                'assignerUserId' => 'required|',
                'CareerRoleId' => 'required|'
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $taskName = $data['taskName'];
                $description = $data['description'];
                $reminder = $data['reminder'];
                $assignerUserId = $data['assignerUserId'];
                $careerRoleId = $data['CareerRoleId'];

                $capitalizeTaskName = ucfirst($taskName);

                $query = $user->userCareerRoleMilestones()
                    ->where('user_id', $id)
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
                        'description' => $description,
                        'reminder' => $reminder,
                        'completed' => 0,
                        //TODO
                        //Return data back to vue so it can display new milestone.

                    ]);

                    $assignedUserName = User::find($assignerUserId)->name;

                    $data = array([
                        'user_id' => $id,
                        'assigned_id' => $assignerUserId,
                        'assigned_username' => $assignedUserName,
                        'user_career_role_id' => $careerRoleId,
                        'task' => $capitalizeTaskName,
                        'description' => $description,
                        'reminder' => $reminder,
                        'completed' => 0,
                        'id' => $userCareerMilestone->id,
                    ]);
                    $jsonData = json_encode($data);
                    return response($jsonData, 200)
                        ->header('Content-Type', 'application/json');
                }

            }
        } catch (\Exception $e) {

        }

    }

    public function updateMilestone(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $authUser = \Auth::user();
            $this->authorize('updateMilestone', $user);

            $data = $request->all();

            $rules = [

                'id' => 'required',
                'description' => 'nullable',
                'reminder' => 'nullable',
                'task' => 'required',
                'selected.id' => 'required',
                'selected.name' => 'required',
                'userCareerRoleId' => 'required',


            ];
            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $description = $data['description'];
                $task = ucfirst(strtolower($data['task']));
                $update = $user->userCareerRoleMilestones()->where('id', $data['id'])
                    ->where('user_career_role_id', $data['userCareerRoleId'])
                    ->where('user_id', $id)
                    ->update([
                        'task' => $task,
                        'description' => $description,
                        'reminder' => $data['reminder'],
                        'assigned_id' => $data['selected']['id'],
                    ]);
                if ($update === 1) {
                    $jsonData = $user->userCareerRoleMilestones()->where('id', $data['id'])
                        ->where('user_career_role_id', $data['userCareerRoleId'])
                        ->where('user_id', $id)->first(['id', 'assigned_id', 'task', 'reminder', 'description']);
                    return response(json_encode($jsonData), 200);
                }


            }

        } catch (\Exception $e) {
            return response('failure', 403);
        }
    }

    public function deleteMilestone(Request $request, $id)
    {
        try {

            $user = User::findOrFail($id);

            $authUserId = \Auth::user();
            $this->authorize('deleteMilestone', $user);

            $data = $request->all();


            $rules = [
                'id' => 'nullable',
                'milestone_id' => 'nullable',
                'user_id' => 'required',
                'user_career_role_id' => 'nullable',
                'task' => 'nullable',
                'reminder' => 'nullable',
                'completed' => 'nullable',
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $deleteMilestone = $user->userCareerRoleMilestones()
                    ->where('id', $data['id'])
                    ->where('user_id', $data['user_id'])
                    ->where('user_career_role_id', $data['user_career_role_id']);
                if ($deleteMilestone) {
                    $deleteMilestone->delete();
                    return response('success', 200);

                }
            }
        } catch (\Exception $e) {
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CareerRole;
use App\CareerRoleMilestone;
use PhpParser\Node\Expr\Array_;
use Validator;
use App\User;

class CareerController extends Controller
{
    public function show(){

        return view('user.addcareer');
    }
    public function create(Request $request){

        try {
            if (!empty($request->all())) {

                $data = $request->all()[0];

                $rules = [
                    'title' => 'required|string|max:30',
                    'description' => 'required|',
                    'milestoneList'=> 'array',
                ];

                $validator = Validator::make($data, $rules);

                if ($validator->passes()){

                    $title = $data['title'];
                    $description = $data['description'];

                    $titlecapitalized=ucfirst($title);

                    $refactorTitle = str_replace('_', ' ', $titlecapitalized);
                    $titleCleared = $refactorTitle;

                    $refactorDescription = str_replace('_',' ', $description);
                    $descriptionCleared = $refactorDescription;

                    $career = CareerRole::where([
                        'title' => $titleCleared])->get();

                    if($career->isEmpty()) {

                        $career= CareerRole::create([
                            'title'=> $titleCleared,
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
        }
        catch(\Exception $e) {
        }
    }

    public function careerRoleMilestonesData()
    {
        $careerRoles=CareerRole::all();
        return $careerRoles;
    }

    public function returnUserData($id){

        $user=User::find($id);
        $userCareerRoleMilestone = $user->userCareerRole()->with('careerRoleMilestone.assignee')->get();
        $data = [];

        foreach ($userCareerRoleMilestone as $key => $careerRole) {

            $data[$key]['id']=$careerRole->id;
            $data[$key]['career_role_id']=$careerRole->career_role_id;
            $data[$key]['user_id']=$careerRole->user_id;
            $data[$key]['title']=$careerRole->title;
            $data[$key]['description']=$careerRole->description;
            $data[$key]['milestones'] = [];

            foreach ($careerRole->careerRoleMilestone as $careerMilestone){

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
}

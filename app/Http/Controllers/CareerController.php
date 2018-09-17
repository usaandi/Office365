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
        $careerRoles=CareerRole::all()->toArray();
        return $careerRoles;
    }

    public function returnUserData( $id){

        $userCareerRole= array();
        $userCareerRoleMilestone= array();

        $user=User::find($id);

        $userscr=$user->userCareerRole()
            ->get(['id','career_role_id','user_id','title','description']);

        $userscrm=$user->userCareerRoleMilestones()
            ->get(['id','user_id','milestone_id','assigned_id'
                ,'task','reminder','completed']);

        if(!empty($userscr)){

            foreach ($userscr as $i =>$usercr){

                $userCareerRoleId=$usercr->id;
                $careerRoleId=$usercr->career_role_id;
                $userId=$usercr->user_id;
                $title=$usercr->title;
                $description=$usercr->description;

                $userCareerRole[$i]['id']=$userCareerRoleId;
                $userCareerRole[$i]['career_role_id']=$careerRoleId;
                $userCareerRole[$i]['user_id']=$userId;
                $userCareerRole[$i]['title']=$title;
                $userCareerRole[$i]['description']=$description;
            }
            unset($usercr);
        }
        if(!empty($userscrm)){
            foreach ($userscrm as $i =>$usercrm){

                $careerRoleMilestoneId=$usercrm->id;
                $careerRoleMilestoneUserId=$usercrm->user_id;
                $milestoneId=$usercrm->milestone_id;
                $assignerId=$usercrm->assigned_id;
                $taskName=$usercrm->task;
                $reminder=$usercrm->reminder;
                $completed=$usercrm->completed;

                $userCareerRoleMilestone[$i]['career_role_milestone_id']=$careerRoleMilestoneId;
                $userCareerRoleMilestone[$i]['user_id']=$careerRoleMilestoneUserId;
                $userCareerRoleMilestone[$i]['milestone_id']=$milestoneId;
                $userCareerRoleMilestone[$i]['assigned_id']=$assignerId;
                $userCareerRoleMilestone[$i]['task']=$taskName;
                $userCareerRoleMilestone[$i]['reminder']=$reminder;
                $userCareerRoleMilestone[$i]['completed']=$completed;
            }
            unset($usercrm);
        }
        return [$userCareerRole,$userCareerRoleMilestone];
    }
}

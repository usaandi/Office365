<?php

namespace App\Http\Controllers;

use App\Department;
use App\Team;
use App\UserDepartment;
use App\UserTeam;
use App\UserTeamModerator;
use Spatie\Permission\Models\Role;
use Validator;
use App\User;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function teamView()
    {
        try {

            return view('team.teamView');
        } catch (\Exception $e) {
        }
    }public function viewAdminTeam()
    {
        try {

            return view('Team');
        } catch (\Exception $e) {
        }
    }

    public function createTeam(Request $request)
    {
        try {
            $data = $request->all();

            $rules= [
              'teamName' => 'required|string'
            ];

            $validator = Validator::make($data,$rules);

            if($validator->passes()){

                $teamName =ucfirst(strtolower($data['teamName']));

                $findTeam = Team::where('team_name',$teamName)->get();

                if($findTeam->isEmpty()){

                    Team::create([
                       'team_name' => $teamName
                    ]);

                    return view('team.teamView');
                }
                else {
                   echo 'Selline nimi on olemas';
                }


            }
            
        } catch (\Exception $e) {

            var_dump($e->getMessage());
        }
    }
    public function updateDepartment(Request $request, $id)
    {
        try {

            $request->validate([
                'data' => 'required|max:30'
            ]);

            $user = User::findOrFail($id);

            $departmentName = $request->data;
            $capitalizeTeam = ucfirst($departmentName);

            $department = Department::where('department_name',
                $capitalizeTeam)->first();

            if($department === NULL){
                $departmentAbbr=substr($capitalizeTeam,0,-2);
                $department = Department::create
                ([
                    'department_name'=>$capitalizeTeam,
                    'department_abbr'=>$departmentAbbr,
                    'department_info'=>'This is Department: '.$capitalizeTeam,
                ]);
            }

            $userDepartment = $user->department()->first();

            if ($userDepartment === NULL) {
                UserDepartment::create([
                   'department_id' => $department->id,
                   'user_id' => $id
                ]);
            }
            else if ($userDepartment->department_id !== $department->id) {
                $userDepartment->department_id = $department->id;
                $userDepartment->save();
            }

            return response('success', 200)
                ->header('Content-Type', 'application/json');

        } catch (\Exception $e){
            return response('Error updating user', 400)
                ->header('Content-Type', 'application/json');
        }
    }
    public function updateUserTeam(Request $request, $id){
        try {
           $request->validate([
               'data' => 'required|max:30'
           ]);
           $user = User::findOrFail($id);

           $teamName = $request->data;
           $capitalizeTeam = ucfirst($teamName);

            $team = Team::where('team_name',
                $capitalizeTeam)->first();

            if($team === NULL){
                $team = Team::create
                ([
                    'team_name'=>$capitalizeTeam,
                ]);
            }
            $userTeam = $user->team()->first();
            if ($userTeam === NULL) {
                UserTeam::create([
                    'team_id' => $team->id,
                    'user_id' => $id
                ]);
            }
            else if ($userTeam->team_id !== $team->id) {
                $userTeam->team_id = $team->id;
                $userTeam->save();
            }
            return response('success', 200)
                ->header('Content-Type', 'application/json');
        }catch (\Exception $e){
            return response('Error updating user', 400)
                ->header('Content-Type', 'application/json');
        }
    }

    public function teamInfo(){

        $team=Team::all();
        return $team;

    }
    public function returnView(){

        $users=User::all(['id','name']);
        $teams=Team::all(['id','team_name']);

        return view('team.teamModerator',compact(['users','teams']));
    }
    public function addModerator(Request $request){


        try {
            $data = json_decode(key($request->all()), true);

            $rules = [
                'userId' => 'required',
                'teamId' => 'required'
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->passes()){

                $userId = $data['userId'];
                $teamId = $data['teamId'];
                $user = User::find($userId);

                $moderatorRoleName = 'Moderator';

                if (!$user->hasRole($moderatorRoleName)) {
                    $moderatorRole = Role::findByName($moderatorRoleName);
                    $user->assignRole($moderatorRole);
                }

                $isModeratorOfTeam = (bool) UserTeamModerator::where('user_id', $userId)
                    ->where('team_id', $teamId)
                    ->count();

                if ($isModeratorOfTeam === FALSE) {
                    UserTeamModerator::create([
                        'user_id' => $userId,
                        'team_id' => $teamId
                    ]);
                }

                return redirect()->back();

            }

        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }

    }
}

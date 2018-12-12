<?php

namespace App\Http\Controllers;

use App\Department;
use App\Services\ModeratorService;
use App\Team;
use App\UserDepartment;
use App\UserTeam;
use App\UserTeamModerator;
use Illuminate\Support\Facades\App;
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
    }

    public function delete($id)
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);

            $team = Team::destroy($id);

            return response('Found', 200);


        } catch (\Exception $e) {
        }
    }

    public function update($id, Request $request)
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);

            $data = $request->all();
            $rules = [
                'teamName' => 'required'
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $teamName = ucfirst(strtolower($data['teamName']));
                $team = Team::findOrFail($id);

                $team->update([
                    'team_name' => $teamName
                ]);

                return response(json_encode($team), 200);

            }
        } catch (\Exception $e) {
        }
    }

    public function viewAdminTeam()
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);
            $teams = Team::get();

            return view('Team')->with(['teams' => $teams]);
        } catch (\Exception $e) {
        }
    }

    public function createTeam(Request $request)
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);

            $data = $request->all();

            $rules = [
                'teamName' => 'required|string'
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $teams = Team::get();

                $teamName = ucfirst(strtolower($data['teamName']));

                $findTeam = Team::where('team_name', $teamName)->get();

                if ($findTeam->isEmpty()) {

                    Team::create([
                        'team_name' => $teamName
                    ]);

                    return redirect('/admin/team/list')->with(['teams' => $teams]);
                } else {
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

            if ($department === NULL) {
                $departmentAbbr = substr($capitalizeTeam, 0, -2);
                $department = Department::create
                ([
                    'department_name' => $capitalizeTeam,
                    'department_abbr' => $departmentAbbr,
                    'department_info' => 'This is Department: ' . $capitalizeTeam,
                ]);
            }

            $userDepartment = $user->department()->first();

            if ($userDepartment === NULL) {
                UserDepartment::create([
                    'department_id' => $department->id,
                    'user_id' => $id
                ]);
            } else if ($userDepartment->department_id !== $department->id) {
                $userDepartment->department_id = $department->id;
                $userDepartment->save();
            }

            return response('success', 200)
                ->header('Content-Type', 'application/json');

        } catch (\Exception $e) {
            return response('Error updating user', 400)
                ->header('Content-Type', 'application/json');
        }
    }

    public function updateUserTeam(Request $request, $id)
    {
        try {
            $request->validate([
                'data' => 'required|max:30'
            ]);
            $user = User::findOrFail($id);

            $teamName = $request->data;
            $capitalizeTeam = ucfirst($teamName);

            $team = Team::where('team_name',
                $capitalizeTeam)->first();

            if ($team === NULL) {
                $team = Team::create
                ([
                    'team_name' => $capitalizeTeam,
                ]);
            }
            $userTeam = $user->team()->first();
            if ($userTeam === NULL) {
                UserTeam::create([
                    'team_id' => $team->id,
                    'user_id' => $id
                ]);
            } else if ($userTeam->team_id !== $team->id) {
                $userTeam->team_id = $team->id;
                $userTeam->save();
            }
            return response('success', 200)
                ->header('Content-Type', 'application/json');
        } catch (\Exception $e) {
            return response('Error updating user', 400)
                ->header('Content-Type', 'application/json');
        }
    }

    public function teamInfo()
    {

        $team = Team::all();
        return $team;

    }

    public function returnView($teamId, ModeratorService $checkModerator)
    {


        $userArray = [];

            $users = User::get();

            foreach ($users as $key => $user) {
                $userId = $user->id;

                $alreadyModerator = $checkModerator->isModerator($teamId, $userId);

                if (!$alreadyModerator) {
                    $userArray[] = [
                        'user_id' => $user->id,
                        'user_name' => $user->name,
                    ];
                }
            }



        return view('team.teamModerator', compact(['userArray', 'teamId']));
    }

    public function addModerator(Request $request ,$teamId)
    {


        try {
            $data = $request->all();

            $rules = [
                'userId' => 'required',

            ];
            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $userId = $data['userId'];

                $user = User::find($userId);

                $moderatorRoleName = 'Moderator';

                if (!$user->hasRole($moderatorRoleName)) {
                    $moderatorRole = Role::findByName($moderatorRoleName);
                    $user->assignRole($moderatorRole);
                }

                $isModeratorOfTeam = (bool)UserTeamModerator::where('user_id', $userId)
                    ->where('team_id', $teamId)
                    ->count();

                if ($isModeratorOfTeam === FALSE) {
                    UserTeamModerator::create([
                        'user_id' => $userId,
                        'team_id' => $teamId
                    ]);
                }

                return response(true,200);

            }

        } catch (\Exception $exception) {

        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Services\ModeratorService;
use App\UserTeamModerator;
use Illuminate\Http\Request;
use App\Team;
use App\User;


class AdminTeamController extends Controller
{

    public function index($id, ModeratorService $moderatorService)
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);

            $teamArray = [];
            $team = Team::findOrFail($id);
            $teamArray = [
                'team_name' => $team->team_name,
                'team_id' => $team->id
            ];
            $teamList = $team->with(['moderators', 'users'])->where('id', $id)->first();
            $teamModerators = $teamList->getrelation('moderators');
            $teamUsers = $teamList->getrelation('users');

            if ($teamModerators->isNotEmpty() || $teamUsers->isNotEmpty()) {

                $Users = array_merge($teamUsers->toArray(), $teamModerators->toArray());

                if (is_array($Users)) {

                    $usersListArray = $this->unique_array($Users, 'id');

                    foreach ($usersListArray as $user) {
                        $belongsTeam = $moderatorService->belongsTeam($id, $user['id']);
                        $isModerator = $moderatorService->isModerator($id, $user['id']);

                        $teamArray['users'][] = [
                            'user_name' => $user['name'],
                            'user_id' => $user['id'],
                            'team_moderator' => $isModerator,
                            'belongs_team' => $belongsTeam,
                        ];
                    }
                }
            }
            else {
                $teamArray ['users'] = [];
            }

            return view('admin.adminTeamView', with(['id' => $id, 'team' => $teamArray]));

        } catch (\Exception $e) {
        }
    }

    protected function unique_array($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    public function removeModerator(Request $request)
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);
        } catch (\Exception $e) {
        }
    }

    public function addModerator(Request $request)
    {
        try {
            $auth = \Auth::user();
            $this->authorize('admin', $auth);
        } catch (\Exception $e) {
        }
    }
}

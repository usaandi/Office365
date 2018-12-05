<?php

namespace App\Http\Controllers;

use App\Services\ModeratorService;
use App\UserTeamModerator;
use Illuminate\Http\Request;
use App\Team;
use App\User;
use phpDocumentor\Reflection\Types\Boolean;


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
            $teamUsers = $team->users()->get();

            $isModerator = null;

            if ($teamUsers->isNotEmpty()) {

                foreach ($teamUsers as $user) {

                    $isModerator =  $moderatorService->isModerator($id,$user->id);

                    $teamArray['users'][] = [
                        'user_name' => $user->name,
                        'user_id' => $user->id,
                        'team_moderator' => $isModerator,
                    ];


                }
            } else {
                $teamArray ['users'] = [];
            }
            return view('admin.adminTeamView', with(['id' => $id, 'team' => $teamArray]));

        } catch (\Exception $e) {
        }
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

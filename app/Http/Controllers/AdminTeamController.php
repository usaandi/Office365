<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;

class AdminTeamController extends Controller
{
    public function index($id)
    {
        try {

            $auth = \Auth::user();
            $this->authorize('admin', $auth);

            $team = Team::findOrFail($id)->users()->get();

            return view('admin.adminTeamView', with(['id' => $id]));

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

<?php

namespace App\Http\Controllers;

use App\Note;
use App\User;
use App\UserCareerRole;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function index($id, $roleId)
    {
        try {

            $user = User::findOrFail($id);
            $this->authorize('updateCareer', $user);
            $notes = $this->noteInfo($roleId);


            return view('career.notes')->with('notes', $notes);

        } catch (\Exception $e) {
            return view('unauthorized.unauthorized', with(['error' => 'No permission']));

        }
    }

    protected function noteInfo($careerRoleId)
    {
        try {

            $array = [];
            $careers = UserCareerRole::with('careerNotes')->where('id', $careerRoleId)->first();
            $notes = $careers->careerNotes;

            foreach ($notes as $key => $note) {

                $assignerId = $note['id'];
                $array[$key]['id'] = $note->id;
                $array[$key]['title'] = $note->title;
                $array[$key]['description'] = $note->description;
                $array[$key]['assigner_id'] = $note->assigner_id;
                $array[$key]['assigner_name'] = $note->getNameByUserId($assignerId);
                $array[$key]['created_at'] = $note->created_at->toDateString();

            }
            return $array;

        } catch (\Exception $e) {
        }
    }
}

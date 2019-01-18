<?php

namespace App\Http\Controllers;

use App\Note;
use App\User;
use App\UserCareerRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{


    public function index($id, $roleId)
    {
        try {

            $user = User::findOrFail($id);
            $this->authorize('updateCareer', $user);
            $notes = $this->noteInfo($roleId);


            return view('career.notes')->with('notes', $notes)->with('careerId', $roleId);

        } catch (\Exception $e) {
            return view('unauthorized.unauthorized', with(['error' => 'No permission']));

        }
    }

    public function create(Request $request, $careerId)
    {
        try {


            $validateData = $this->validate($request, [
                'noteDescription' => 'required|string',
                'noteTitle' => 'required|string'
            ]);

            $createNote = Note::createNote($careerId, $validateData);

            $userName = User::findOrFail($createNote['assigner_id'])->name;

            $array = [
                'id' => $createNote['id'],
                'assigner_id' => $createNote['assigner_id'],
                'assigner_name' => $userName,
                'created_at' => $createNote->created_at->toDateString(),
                'description' => $createNote['description'],
                'title' => $createNote['title'],
            ];
            return response($array, 200);

        } catch (\Exception $e) {
        }
    }

    public function update($noteId, Request $request)
    {
        try {

            $noteCheck = Note::findOrFail($noteId);
            $this->authorize('updateNote', $noteCheck);

            $validateData = $this->validate($request, [
                'noteDescription' => 'required|string',
                'noteTitle' => 'required|string'
            ]);

            $update = Note::updateNote($noteId, $validateData);

            if ($update) {
                $note = Note::findOrFail($noteId)->first(['title', 'description'])->toArray(['description', 'title']);
                return response($note, 200);

            }

        } catch (\Exception $e) {
        }

    }

    protected function noteInfo($careerRoleId)
    {
        try {

            $array = [];
            $careers = UserCareerRole::with('careerNotes')->where('id', $careerRoleId)->first();
            $notes = $careers->careerNotes;

            foreach ($notes as $key => $note) {

                $assignerId = $note['assigner_id'];
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

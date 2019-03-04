<?php

namespace App\Http\Controllers;

use App\Note;
use App\User;
use App\UserCareerRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{


    public function count($id)
    {
        $user = Auth::user();
        $count = Note::where('user_career_role_id', $id)->where('assigner_id', $user->id)->orWhere(function ($q) use ($id) {
            $q->where('user_career_role_id', $id)->where('is_public', true);

        })->orWhere(function ($q) use ($id, $user) {
            if ($user->hasRole('Admin')) {
                $q->where('user_career_role_id', $id)->where('admin_can_see', true);
            }

        })->count();

        return $count;
    }

    public function index($id, $roleId)
    {
        try {

            $user = User::findOrFail($id);
            $this->authorize('updateCareer', $user);
            $notes = $this->noteInfoByCareerId($roleId);


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
                'noteTitle' => 'required|string',
                'public' => 'required|bool',
                'adminState' => 'required|bool'
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
                'is_public' => $createNote['is_public'],
                'admin_can_see' => $createNote['admin_can_see'],
            ];
            return response($array, 200);

        } catch (\Exception $e) {
        }
    }

    public function delete(Request $request)
    {
        try {

            $data = $request->all();
            $noteCheck = Note::findOrFail($data['id']);

            $this->authorize('delete', $noteCheck);

            $noteCheck->delete();

            return response('Success', 200);

        } catch (\Exception $e) {
            return response($e->getMessage(), 403);
        }

    }

    public function update($noteId, Request $request)
    {
        try {

            $noteCheck = Note::findOrFail($noteId);
            $this->authorize('updateNote', $noteCheck);

            $validateData = $this->validate($request, [
                'noteDescription' => 'required|string',
                'noteTitle' => 'required|string',
                'publicState' => 'required|bool',
                'adminState' => 'required|bool'

            ]);

            $update = Note::updateNote($noteId, $validateData);

            if ($update) {
                $note = Note::where('id', $noteId)->first(['title', 'description', 'is_public', 'admin_can_see'])->toArray(['description', 'title', 'is_public', 'admin_can_see']);
                return response($note, 200);

            }

        } catch (\Exception $e) {
        }

    }

    public function state(Request $request, $id)
    {
        try {

            $validateData = $this->validate($request, [
                'is_public' => 'required|boolean'
            ]);

            $note = Note::notePublicState($id, $validateData);


        } catch (\Exception $e) {
        }
    }

    protected function noteInfoByCareerId($careerRoleId)
    {
        try {

            $array = [];
            $authUser = Auth::User();
            $userId = $authUser->id;
            $hasRoleAdmin = $authUser->hasRole('Admin');
            $careers = UserCareerRole::with('careerNotes')->where('id', $careerRoleId)->first();
            $notes = $careers->careerNotes()->orderByDesc('id')->get();

            foreach ($notes as $key => $note) {

                if ($note->assigner_id === $userId || $note['is_public'] || $note['admin_can_see'] == $hasRoleAdmin) {
                    $assignerId = $note['assigner_id'];
                    $array[$key]['id'] = $note->id;
                    $array[$key]['admin_can_see'] = $note->admin_can_see;
                    $array[$key]['is_public'] = $note['is_public'];
                    $array[$key]['title'] = $note->title;
                    $array[$key]['description'] = $note->description;
                    $array[$key]['assigner_id'] = $note->assigner_id;
                    $array[$key]['assigner_name'] = $note->getNameByUserId($assignerId);
                    $array[$key]['created_at'] = $note->created_at->toDateString();
                }
            }
            return array_values($array);

        } catch (\Exception $e) {
        }
    }
}

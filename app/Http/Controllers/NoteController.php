<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function index($id, $roleId)
    {
        try {

            $user = User::findOrFail($id);
            $this->authorize('updateCareer', $user);


            return view('career.notes');

        } catch (\Exception $e) {
            return view('unauthorized.unauthorized', with(['error' => 'No permission']));

        }
    }
}

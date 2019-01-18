<?php

namespace App\Policies;

use App\User;
use App\Note;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the note.
     *
     * @param  \App\User $user
     * @param  \App\Note $note
     * @return mixed
     */
    public function view(User $user, Note $note)
    {
        //
    }

    /**
     * Determine whether the user can create notes.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the note.
     *
     * @param  \App\User $user
     * @param  \App\Note $note
     * @return mixed
     */
    public function updateNote(User $user, Note $note)
    {

        if ($user->hasRole('Admin')) {
            return TRUE;
        }

        if ($note['assigner_id'] === $user['id']) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Determine whether the user can delete the note.
     *
     * @param  \App\User $user
     * @param  \App\Note $note
     * @return mixed
     */
    public function delete(User $user, Note $note)
    {
        if ($user->hasRole('Admin')) {
            return TRUE;
        }

        if ($note['assigner_id'] === $user['id']) {
            return TRUE;
        }

        return FALSE;
    }
}

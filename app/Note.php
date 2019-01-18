<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Note extends Model
{
    protected $fillable = ['title', 'description', 'user_career_role_id', 'assigner_id'];
    protected $table = 'notes';


    public function career()
    {
        return $this->hasMany(UserCareerRole::class, 'id');
    }

    public static function getNameByUserId($id)
    {
        return User::where('id', $id)->first()->name;
    }

    public static function updateNote($id, $data)
    {
        $note = Note::findOrfail($id);
        $title = strtolower($data['noteTitle']);
        $description = $data['noteDescription'];
        $updated = $note->update(['description' => $data['noteDescription'], 'title' => $title]);

        return $updated;

    }

    public static function createNote($careerId, $data)
    {
        $title = strtolower($data['noteTitle']);
        $userId = Auth::user()['id'];
        $newNote = Note::create([
            'title' => $title,
            'description' => $data['noteDescription'],
            'user_career_role_id' => $careerId,
            'assigner_id' => $userId,
        ]);

        return $newNote;

    }

}

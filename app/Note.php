<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Note extends Model
{
    protected $fillable = ['title', 'description', 'user_career_role_id', 'assigner_id', 'is_public'];
    protected $table = 'notes';
    protected $casts = [
        'user_career_role_id' => 'integer',
        'assigner_id' => 'integer',
        'is_public' => 'integer',
    ];

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
        $updated = $note->update(['description' => $description, 'title' => $title, 'is_public' => $data['publicState']]);

        return $updated;

    }

    public static function createNote($careerId, $data)
    {
        $title = ucfirst(strtolower($data['noteTitle']));
        $userId = Auth::user()['id'];
        $newNote = Note::create([
            'is_public' => $data['public'],
            'title' => $title,
            'description' => $data['noteDescription'],
            'user_career_role_id' => $careerId,
            'assigner_id' => $userId,

        ]);

        return $newNote;

    }

    public static function notePublicState($id, $state)
    {
        $note = Note::where('id', $id)->update([
            'is_public' => $state['is_public'],
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\UserHobby;
use Illuminate\Http\Request;
use App\Hobby;
use App\User;

class HobbyController extends Controller
{
    public function hobby(){

        $hobbies=Hobby::get(['hobby_name']);

        return $hobbies;

    }
    public function updateHobby(Request $request, $id)
    {
        try {

            $request->validate([
                'data' => 'string|max:30'
            ]);
            $user = User::findOrFail($id);

            $hobbyName = $request->data;
            $capitalizeHobby = ucfirst($hobbyName);
            $hobby = Hobby::where('hobby_name', $capitalizeHobby)->first();

            if ($user->hobbies()->get()->contains($hobby)) {
                return response('duplicate entry', 409)
                    ->header('Content-Type', 'application/json');
            }

            if($hobby === NULL) {
                $hobby = Hobby::create(['hobby_name' => $capitalizeHobby]);
            }

            $userHobbyId = UserHobby::create([
                'user_id' => $user->id,
                'hobby_id' => $hobby->id
            ])->id;

            return response()->json([
                'user_hobby_id' => $userHobbyId,
                'hobby_name' => $capitalizeHobby
            ]);
        }
        catch(\Exception $e) {

        }
        return response('Error updating user', 400)
            ->header('Content-Type', 'application/json');

    }
    public function deleteUserHobby(Request $request, $id)
    {
        try {

            $request->validate([
                'userhobbyid' => 'integer'
            ]);

            User::findOrFail($id);

            $userHobbyId = $request->userhobbyid;

            $userHobby = UserHobby::findOrFail($userHobbyId);

            $userHobby->delete();

            return response('success', 200)
                ->header('Content-Type', 'application/json');
        }
        catch(\Exception $e) {

        }
        return response('Error Deleting Hobby', 400)
            ->header('Content-Type', 'application/json');

    }

}

<?php

namespace App\Http\Controllers;

use App\UserHobby;
use Illuminate\Http\Request;
use App\Hobby;
use App\User;

class HobbyController extends Controller
{
    public function hobby(){

        $hobbies = Hobby::get(['name']);

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
            $capitalizeHobby = ucfirst(strtolower($hobbyName));
            $hobby = Hobby::where('name', $capitalizeHobby)->first();

            if($hobby === NULL) {
                $hobby = Hobby::create(['name' => $capitalizeHobby]);
            }
            $userHobby = UserHobby::where('user_id', $id)->where('hobby_id', $hobby->id)->first();

            if ($userHobby === NULL){
                UserHobby::create(['user_id' => $user->id, 'hobby_id' => $hobby->id]);

                $data = array([
                    'name' => $hobby->name,
                    'id' => $hobby->id,
                ]);

               $jsonData = json_encode($data);
                return response($jsonData,200)
                    ->header('Content-Type', 'application/json');
            }

        }
        catch(\Exception $e) {}

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

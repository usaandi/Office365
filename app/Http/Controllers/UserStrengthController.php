<?php

namespace App\Http\Controllers;

use App\User;
use App\UserStrength;
use Validator;
use Illuminate\Http\Request;

class UserStrengthController extends Controller
{
    public function userStrength(Request $request, $id)
    {
        try {
            $strengths = $request->all();

            $rules = [
                '*.strength_id' => 'required|integer',
                '*.strength_name' => 'required|string',
                '*.strength_index' => 'required|integer',
            ];


            $validator = Validator::make($strengths, $rules);
            $user = User::find($id);


            if ($validator->passes()) {
                $userStrengths = $user->strengths()->get();


                foreach ($userStrengths as $userStrength) {
                    $userStrength->delete();
                }


                foreach ($strengths as $strength) {

                    $createStrengths = UserStrength::updateOrCreate(
                        ['user_id' => $id, 'strength_id' => $strength['strength_id']],
                        ['rank' => $strength['strength_index']]
                    );

                }


                return response($user->name . ' updated', 200);


            }


        } catch (\Exception $exception) {

        }


    }

    public
    function fetchUserStrength($id)
    {
        try {

            $userId = $id;
            $array = [];
            $user = User::find($userId);
            $userStrengths = $user->userStrengths()->with('categories')->get();
            foreach ($userStrengths as $i => $strength) {

                $categoryColour = null;

                $category = $strength->categories()->get();
                if ($category->isNotEmpty()) {
                    $categoryColour = $category[0]->category_colour;

                }

                $array[$i] = [
                    'strength_name' => $strength->strength_name,
                    'strength_description' => $strength->strength_description,
                    'category_colour' => $categoryColour,
                    'strength_rank' => $strength->pivot->rank,
                ];


            }
            return $array;


        } catch (\Exception $e) {
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\User;
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

            if ($validator->passes()) {

                $user = User::findOrFail($id);

                $userStrength = $user->userStrength()->get();

                if ($userStrength->isEmpty()) {
                    foreach ($strengths as $strength) {
                        $user->userStrength()->create([
                            'user_id' => $id,
                            'strength_id' => $strength['strength_id'],
                            'rank' => $strength['strength_index'],
                        ]);
                    }

                } else {

                    $userStrengths = $user->userStrength()->get();
                    for ($i = 0; $i < count($userStrengths); $i++) {

                        $userStrengths[$i]->update([
                            'strength_id' => $strengths[$i]['strength_id'],
                            'user_id' => $id,
                            'rank' => $strengths[$i]['strength_index'],
                        ]);

                    }
                    return redirect()->back();

                }


            }

        } catch (\Exception $e) {
        }
    }

    public function fetchUserStrength($id)
    {
        try {

            $userId = $id;
            $array = [];
            $user = User::find($userId);
            $userStrengths = $user->with('strengths.strength.strengthCategory.category')->where('id', $userId)->get();
            foreach ($userStrengths[0]->strengths as $i => $strength) {

                $array[$i] = [
                    'strength_name' => $strength->strength->strength_name,
                    'strength_description'=> $strength->strength->strength_description,
                    'category_colour'=>$strength->strength->strengthCategory[0]->category->category_colour,
                    'strength_rank'=> $strength->rank,
                ];


            }
            return $array;

        } catch (\Exception $e) {
            var_dump($e);
        }

    }
}

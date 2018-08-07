<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hobby;
use App\User;


class UserHobbyController extends Controller
{
    public function userHobbies(Request $request, $id)
    {
        $userid=User::findOrFail($id);

        $data=$userid->hobbies()->get(['users_hobbies.id', 'hobby_name'])->toArray();

        if (!empty($data)) {

            foreach ($data as $key => $val) {

                if (array_key_exists('pivot', $data[$key])) {
                    unset($data[$key]['pivot']);
                }

            }

        }

        return $data;
    }
}

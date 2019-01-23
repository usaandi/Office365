<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PeopleSearchController extends Controller
{
    public function search(Request $request)
    {
        try {

            $validate = $this->validate($request, [
                'q' => 'required|string'
            ]);
            $query = strtolower($validate['q']);
            $users = User::query()->where('name', 'Like', "%{$query}%")->get(['id', 'name']);

            return response(json_encode($users), 200);

        } catch (\Exception $e) {
        }
    }
}

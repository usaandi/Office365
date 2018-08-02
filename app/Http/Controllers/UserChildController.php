<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class UserChildController extends Controller
{
    public function userChild(Request $request, $id)
    {
        $userid=User::findOrFail($id);

        $data=$userid->children()->get(['name','year_born']);

        return $data;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Validator;
use Illuminate\Http\Request;

class UserStrengthController extends Controller
{
    public function userStrength(Request $request, $id)
    {
        try {
            $data = $request->all();

            $rules = [];

            $validator=Validator::make($data,$rules);

            if($validator->passes()){


            }

        } catch (\Exception $e) {
        }
    }
}

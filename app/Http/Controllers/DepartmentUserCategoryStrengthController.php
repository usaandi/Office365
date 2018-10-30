<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentUserCategoryStrengthController extends Controller
{
    public function view()
    {
        try {

            return view('ViewListOfStrengths');


        } catch (\Exception $e) {
            var_dump($e);
        }


    }

    public function fetch()
    {
        try {


        } catch (\Exception $e) {
            var_dump($e);
        }
    }
}


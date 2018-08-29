<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CareerRole;
use Validator;

class CareerController extends Controller
{
    public function show(){

        return view('user.addcareer');
    }
    public function create(Request $request){


        try {

            $data=json_decode(key($request->all()), true);

            $rules = [
                'title' => 'required|string|max:30',
                'description' => 'required|'
            ];
            $validator = Validator::make($data, $rules);


            if ($validator->passes()){

                $title = $data['title'];
                $description = $data['description'];
                $titlecapitalized=ucfirst($title);

                $career=CareerRole::where([
                    'title' => $titlecapitalized])->first();

                if ($career !== NULL){
                    return response('Duplicate Title', 409)
                        ->header('Content-Type', 'application/json');

                }

                if($career === NULL){
                    $career= CareerRole::create
                    (['title'=> $titlecapitalized,
                        'description' => $description]);


                    return response('success', 200)
                        ->header('Content-Type', 'application/json');


                }

            }
        }
        catch(\Exception $e) {

        }

    }
}

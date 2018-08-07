<?php

namespace App\Http\Controllers;

use App\UserChildren;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\View\View;


class UserChildController extends Controller
{
    public function userChild(Request $request, $id)
    {
        $request->validate([
            'data' => 'string|max:30'
        ]);
        $userid=User::findOrFail($id);

        $data=$userid->children()->get(['name','year_born','id']);

        return $data;
    }
    public function updateChild(Request $request, $id){

        try {

            $data=json_decode(key($request->all()), true);

            $rules = [
                'childname' => 'string|max:30',
                 'dateborn' => 'date'
            ];
            $validator = Validator::make($data, $rules);




            if ($validator->passes()){

                $userid = User::findOrFail($id)->id;
                $user = User::findOrFail($id);
                $childName = $data['childname'];
                $yearborn = $data['dateborn'];
                $childNameCapitalized= ucwords($childName);

                $child= UserChildren::create([
                    'user_id'=> $userid, 'name'=> $childNameCapitalized,'year_born'=>$yearborn]);


                $childid=UserChildren::findOrFail($child)->first()->id;
                $user->children()->save($child);


                return response()->json([

                    'year_born'=> $yearborn,
                    'child_name'=>$childNameCapitalized,
                    'child_id'=>$childid,
                ]);
            }




        }
        catch(\Exception $e) {

        }
    }

    public function deleteUserChild(Request $request, $id){
        try {

            $request->validate([
                'id' => 'integer'
            ]);

            User::findOrFail($id);

            $userChildrenId = $request->id ;

            $userChildren= UserChildren::findOrFail($userChildrenId);

            $userChildren->delete();

            return response('success', 200)
                ->header('Content-Type', 'application/json');
        }
        catch(\Exception $e) {

        }
        return response('Error Deleting Hobby', 400)
            ->header('Content-Type', 'application/json');

    }



}

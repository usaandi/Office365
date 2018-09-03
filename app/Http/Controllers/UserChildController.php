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

        $usr=User::find($id);

        $usrChild=$usr->children()->get(['year_born','id','name']);
        $today=date('Y-m-d');
        $children = array();

        if(!empty($usrChild)){
            foreach ($usrChild as $i =>$child){

                $childDateBorn=$child->year_born;
                $childId=$child->id;
                $childName=$child->name;

                $childAgeInYears = date_diff(date_create($childDateBorn),
                    date_create($today))->y;

                $children[$i]['id']=$childId;
                $children[$i]['age']=$childAgeInYears;
                $children[$i]['name']=$childName;
            }
                unset($child);
        }

        return $children;
    }
    public function updateChild(Request $request, $id){

        try {

            $data=json_decode(key($request->all()), true);

            $rules = [
                'childname' => 'required|string|max:30',
                 'dateborn' => 'required|date'
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
                $user->children()->save($child);
                $childid=UserChildren::findOrFail($child)->first()->id;
                $today=date('Y-m-d');
                $childAgeInYears = date_diff(date_create($yearborn),
                    date_create($today))->y;
                return response()->json([
                    'age'=> $childAgeInYears,
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

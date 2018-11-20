<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use App\Department;

class DepartmentUserCategoryStrengthController extends Controller
{
    public function view()
    {
        try {

            return view('ViewListOfStrengths');

        } catch (\Exception $e) {
        }

    }

    public function departmentUserStrength()
    {
        try {

            $departmentArray = [];
            $departmentsUsers = Department::with('users')->get();
            foreach ($departmentsUsers as $i => $department) {

                $departmentArray[$i] = [

                    'department_id' => $department->id,
                    'department_name' => $department->department_name,

                ];

                foreach ($department->users as $user) {

                    $userStrengths = $user->strengths()->get(['strength_id', 'rank as strength_rank']);

                    $departmentArray[$i]['users'][] = [
                        'user_name' => $user->name,
                        'user_id' => $user->id,
                        'strengths' => $userStrengths
                    ];
                    unset($userStrengths);
                }
            }
            return $departmentArray;

        } catch (\Exception $e) {
        }
    }

    public function categoryStrength()
    {
        try {
            $strengthCategoryArray = [];
            $categories = Category::with('strengthCategory.strength')->get()->toArray();
            foreach ($categories as $i => $category) {

                $strengthCategoryArray[$i] = [
                    'category_name' => $category['category_name'],
                    'category_id' => $category['id'],
                    'category_colour' => $category['category_colour']

                ];
                if (!empty($category['strength_category'])) {

                    foreach ($category['strength_category'] as $strength) {
                        $strengthCategoryArray[$i]['strengths'][] = [
                            'category_id' => $strength['category_id'],
                            'strength_id' => $strength['strength']['id'],
                            'strength_name' => $strength['strength']['strength_name'],
                        ];
                    }
                }
                else {
                    $strengthCategoryArray[$i]['strengths']=[];
                }
            }

            return $strengthCategoryArray;
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }

    }
}


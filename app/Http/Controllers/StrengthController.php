<?php

namespace App\Http\Controllers;

use App\Category;
use App\StrengthCategory;
use Illuminate\Http\Request;
use Validator;
use App\Strength;

class StrengthController extends Controller
{
    public function view()
    {
        $categories = Category::get();

        return view('strength.strength')->with(['categories' => $categories]);
    }

    public function createStrength(Request $request)
    {

        try {

            $data = $request->all();
            $rules = [
                'category_id' => 'required|string',
                'strength_name' => 'required|string',
                'strength_description' => 'required|string',
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $categoryId = $data['category_id'];

                $strengthName = ucfirst(strtolower($data['strength_name']));

                $strength = Strength::where('strength_name', $strengthName)->get();

                if ($strength->isEmpty()) {

                    $strengthId = Strength::create([
                        'strength_name' => $strengthName,
                        'strength_description' => $data['strength_description'],
                    ])->id;

                    $this->findOrCreateStrengthCategory($strengthId, $categoryId);
                }

                return redirect()->back();
            }

        } catch (\Exception $e) {

        }


    }

    protected function findOrCreateStrengthCategory($strengthId, $categoryId)
    {
        try {

            $strengthCategory = StrengthCategory::where('category_id', $categoryId)
                ->where('strength_id', $strengthId)->get();

            if ($strengthCategory->isEmpty()) {

                $strengthCategoryCreate = StrengthCategory::create([
                    'strength_id' => $strengthId,
                    'category_id' => $categoryId,
                ]);

            }

        } catch (\Exception $e) {
        }

    }
}

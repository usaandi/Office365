<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StrengthCategory;
use App\Category;
use Validator;
use App\Strength;

class CategoryStrengthController extends Controller
{
    public function view()
    {
        try {

            $user = \Auth::user();
            $this->authorize('admin', $user);
            return view('strength.categoryStrength');

        } catch (\Exception $e) {
            return redirect('/unauthorized');
        }
    }

    public function updateStrength(Request $request)
    {
        try {
            $data = $request->all();

            $rules = [
                'strength_id' => 'required|integer',
                'strength_name' => 'required|string',
                'strength_description' => 'required|string',
                'category_id' => 'required|integer',
                'category_name' => 'required|string',
            ];
            $strengthName = ucfirst(strtolower($data['strength_name']));
            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $strengthId = $data['strength_id'];
                $categoryId = $data['category_id'];
                $strength = Strength::findOrFail($data['strength_id']);

                $strength->update([
                    'strength_name' => $strengthName,
                    'strength_description' => $data['strength_description'],
                ]);

                $this->updateOrCreateStrengthCategory($strengthId, $categoryId);

                $strengthInfo = Strength::where('id',$strengthId)
                    ->get(['id as strength_id', 'strength_name', 'strength_description'])->toArray();

                $categoryInfo = Category::where('id',$categoryId)
                    ->get(['id as category_id', 'category_name'])->toArray();
                $array = array_merge($strengthInfo[0],$categoryInfo[0]);
                $jsonData = json_encode($array);

                return response($jsonData, 200);

            }

        } catch (\Exception $e) {
        }
    }

    public function updateOrCreateStrengthCategory($strengthId, $categoryId)
    {
        try {
            $strengthCategory = StrengthCategory::where('strength_id', $strengthId)->get();
            if ($strengthCategory->isEmpty()) {
                StrengthCategory::create([
                    'strength_id' => $strengthId,
                    'category_id' => $categoryId,
                ]);
            } else {
                StrengthCategory::where('strength_id', $strengthId)->update([
                    'category_id' => $categoryId,
                ]);

            }

        } catch (\Exception $e) {
        }
    }

    public function deleteStrength(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                'strengthId' => 'required|integer'

            ];
            $validator = Validator::make($data,$rules);

            if($validator->passes()){
                $strength = Strength::findOrFail($data['strengthId']);
                $strength->delete();

                return response('Deleted', 200);
            }

        } catch (\Exception $e) {
        }
    }

    public function strengthCategoryInfo()
    {

        $strengths = Strength::with('strengthCategory.category')->get();
        $array = [];
        foreach ($strengths as $i => $strength) {
            $array[$i]['strength_id'] = $strength->id;
            $array[$i]['strength_name'] = $strength->strength_name;
            $array[$i]['strength_description'] = $strength->strength_description;
            if ($strength->strengthCategory->isNotEmpty()) {
                $array[$i]['category_id'] = $strength->strengthCategory[0]['category']->id;
                $array[$i]['category_name'] = $strength->strengthCategory[0]['category']->category_name;
            } else {
                $array[$i]['category_id'] = NULL;
                $array[$i]['category_name'] = NULL;
            }

        }
        unset($strength);
        $category = Category::get(['id as category_id', 'category_name']);
        return [$array, $category];
    }

    public function categoryInfo()
    {
        $categories = Category::get(['id', 'category_name',
            'category_description', 'category_colour']);

        return $categories;
    }
}

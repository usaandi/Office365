<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StrengthCategory;
use App\Category;
use App\Strength;

class CategoryStrengthController extends Controller
{
    public function view()
    {

        return view('strength.categoryStrength');
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
        return $array;
    }

    public function categoryInfo()
    {
        $categories = Category::get(['id', 'category_name',
            'category_description', 'category_colour']);

        return $categories;
    }
}

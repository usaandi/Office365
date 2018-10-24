<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Category;

class CategoryController extends Controller
{
    public function createCategory(Request $request)
    {

        try {
            $data = $request->all();

            $rules = [
                'category_name' => 'required|alpha_num',
                'category_description' => 'required|string',
                'category_colour' => 'required|string',
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $categoryName = ucfirst(strtolower($data['category_name']));
                $categoryColour = strtolower($data['category_colour']);

                $category = Category::where('category_name', $categoryName)
                    ->get();

                if (!$category->isEmpty()) {
                    return 'duplicate';
                } else {
                    $category = Category::create([
                        'category_name' => $categoryName,
                        'category_description' => $data['category_description'],
                        'category_colour' => $categoryColour,
                    ]);
                    return redirect()->back();

                }
            }

        } catch (\Exception $e) {

        }
        return redirect()->back();
    }

    public function deleteCategory(Request $request)
    {

        try {
            $data = $request->all();

            $rules = [
                'categoryId' => 'required|integer'
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $category = Category::findOrFail($data['categoryId']);
                $category->delete();

                return response('Deleted', 200);

            }


        } catch (\Exception $e) {
        }

    }

    public function updateCategory(Request $request)
    {
        try {
            $data = $request->all();

            $rules = [
                'id' => 'required|integer',
                'category_name' => 'required|string',
                'category_description' => 'required|string',
                'category_colour' => 'required|string',
            ];

            $validator = Validator::make($data,$rules);

            if($validator->passes()){
                $category = Category::findOrFail($data['id']);
                 $category->update([
                   'category_name' => $data['category_name'],
                   'category_description'=> $data['category_description'],
                   'category_colour'=> $data['category_colour'],
                ]);

                $jsonCategory = json_encode($category);

                return response($jsonCategory,200);
            }

        } catch (\Exception $e) {
        }
    }
}

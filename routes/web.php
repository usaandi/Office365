<?php
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

route::get('/', function (){

});

//Route::get('/register', 'HomeController@index');
//Route::get('/signin', 'AuthController@signin');
Route::get('/', 'AuthController@signin');
Route::get('/authorize', 'AuthController@gettoken');


Route::post('/aaaupload', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'image' => 'required|image64:jpeg,jpg,png'
    ]);
    if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()]);
    } else {
        $imageData = $request->get('image');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/').$fileName);
        return response()->json(['error'=>false]);
    }
});
Route::get('/upload', 'ImageController@show');
Route::post('/upload/{id}', 'ImageController@upload')->name('upload');



Auth::routes();



Route::get('/user/{id}/update', 'UserController@showedit');
Route::post('/user/{id}/update', 'UserController@update')->name('update');

Route::post('/user/{id}/update/team', 'UserController@updateTeam')->name('updateTeam');
Route::post('/user/{id}/update/phone', 'UserController@updatePhone')->name('updatePhone');
Route::post('/user/{id}/update/email', 'UserController@updateEmail')->name('updateEmail');
Route::post('/user/{id}/update/skype', 'UserController@updateSkype')->name('updateSkype');

Route::get('/user/{id}', 'UserController@show');


Route::get('/admin/users/add', 'AddController@add');
Route::post('/admin/users/add', 'AddController@store')->name('store');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('teams/add', 'DepartmentController@department');
Route::post('teams/add','DepartmentController@department')->name('adddepartment');
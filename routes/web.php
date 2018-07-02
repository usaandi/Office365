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

route::get('/template', function (){
    return view('template');
});

//Route::get('/register', 'HomeController@index');
//Route::get('/signin', 'AuthController@signin');
Route::get('/', 'AuthController@signin');
Route::get('/authorize', 'AuthController@gettoken');

Auth::routes();



Route::get('/user/{id}/update', 'UserController@showedit');
Route::post('/user/{id}/update', 'UserController@update')->name('update');

Route::get('/user/{id}', 'UserController@show');

Route::get('/admin/users/add', 'AddController@add');
Route::post('/admin/users/add', 'AddController@store')->name('store');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('teams/add', 'DepartmentController@department');
Route::post('teams/add','DepartmentController@department')->name('adddepartment');
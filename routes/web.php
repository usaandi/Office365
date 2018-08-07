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


Route::get('/upload', 'ImageController@show');
Route::post('/upload/{id}', 'ImageController@upload')->name('upload');


Auth::routes();
Route::get('/user/{id}/update', 'UserController@showedit');
Route::post('/user/{id}/update', 'UserController@update')->name('update');
Route::get('/user/{id}/hobby', 'UserHobbyController@userHobbies');
Route::get('/user/{id}/child', 'UserChildController@userChild');
Route::get('/hobbies', 'HobbyController@hobby');
Route::post('/user/{id}/update/team', 'UserController@updateTeam')->name('updateTeam');
Route::post('/user/{id}/update/phone', 'UserController@updatePhone')->name('updatePhone');
Route::post('/user/{id}/update/email', 'UserController@updateEmail')->name('updateEmail');
Route::post('/user/{id}/update/skype', 'UserController@updateSkype')->name('updateSkype');
Route::post('/user/{id}/update/hobby', 'HobbyController@updateHobby')->name('updateHobby');
Route::post('/user/{id}/update/child', 'UserChildController@updateChild')->name('updateChild');
Route::delete('user/{id}/delete/child', 'UserChildController@deleteUserChild')->name('deleteUserChild');

Route::get('/user/{id}', 'UserController@show')->name('profile');
Route::get('/user/{id}/development', 'PersonalDevelopmentController@userDevelopment')->name('development');
Route::delete('user/{id}/delete/hobby', 'HobbyController@deleteUserHobby')->name('deleteUserHobby');

Route::get('/admin/users/add', 'AddController@add')->name('useradd');
Route::post('/admin/users/add', 'AddController@store')->name('store');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('department/add','DepartmentController@view')->name('departmentadd');
Route::post('department/add','DepartmentController@store')->name('store');
Route::get('department/{id}', 'DepartmentController@show')->name('team');
Route::get('department', 'DepartmentController@department')->name('department');
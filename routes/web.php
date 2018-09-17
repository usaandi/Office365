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



//Route::get('/register', 'HomeController@index');
//Route::get('/signin', 'AuthController@signin');
Route::get('/', 'AuthController@signin');
Route::get('/authorize', 'AuthController@gettoken');


route::get('/test','CareerController@careerRoleMilestonesData');



Route::group(['middleware'=> 'auth'], function (){



Route::get('/upload', 'ImageController@show');
Route::post('/upload/{id}', 'ImageController@upload')->name('upload');
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
Route::post('/user/{id}/update/info', 'UserController@updateInfo')->name('updateInfo');
Route::post('/user/{id}/update/child', 'UserChildController@updateChild')->name('updateChild');
Route::delete('user/{id}/delete/child', 'UserChildController@deleteUserChild')->name('deleteUserChild');
Route::post('/user/{id}/department', 'TeamsController@updateDepartment')->name('updateDepartment');
Route::post('/user/{id}/team', 'TeamsController@updateUserTeam')->name('updateUserTeam');
Route::get('/user/{id}/career', 'PersonalDevelopmentController@userDevelopment')->name('career');
Route::get('/career/add', 'CareerController@show')->name('addCareer');
Route::post('/career/add', 'CareerController@create')->name('addCareer');
Route::delete('user/{id}/delete/hobby', 'HobbyController@deleteUserHobby')->name('deleteUserHobby');
Route::get('/user/{id}', 'UserController@show')->name('profile');
Route::get('user/{id}/career/info','CareerController@returnUserData')->name('careerInfo');
Route::get('/admin/users/add', 'AddController@add')->name('useradd');
Route::post('/admin/users/add', 'AddController@store')->name('store');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/usersDepartment','HomeController@userNoDepartment')->name('users');
Route::get('department/add','DepartmentController@view')->name('departmentadd');
Route::post('department/add','DepartmentController@store')->name('store');
Route::get('department/{id}', 'DepartmentController@show')->name('team');
Route::get('department/{id}/user', 'DepartmentController@userDepartment')->name('user');
Route::get('departmentInfo', 'DepartmentController@departmentInfo')->name('departmentInfo');
Route::get('teamInfo', 'TeamsController@teamInfo')->name('teamInfo');
Route::get('department', 'DepartmentController@department')->name('department');
Route::get('/admin/team/moderator/add', 'TeamsController@returnView')->name('returnView');
Route::post('/admin/team/moderator/add', 'TeamsController@addModerator')->name('moderatorAdd');
});

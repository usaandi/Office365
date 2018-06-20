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

Route::get('/', 'AuthController@signin');

route::get('/template', function (){
    return view('template');


});

//Route::get('/signin', 'AuthController@signin');
Route::get('/authorize', 'AuthController@gettoken',function (){
    $value = session('key');
    echo $value;
});

Route::get('/register', 'HomeController@index');

Auth::routes();
Route::get('/user/{id}', 'UserController@show');
Route::get('/admin/users/add', 'AddController@add');
Route::post('/admin/users/add', 'AddController@store')->name('store');
Route::get('/home', 'HomeController@index')->name('home');

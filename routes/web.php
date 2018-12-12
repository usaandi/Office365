<?php


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
/*TODO Kõiki route mis sa siin näed oleks saanud ka lihtsamini luua ning nii nagu vaja.
käsuga

php artisan make:controller StrengthController --resource
loob StrengthControlleri ja kõgi vaja minevate päringuteha (index,create,stroe,show,edit,update,destroy)
Näiteks, typical CRUD kohta oleks saanud kasutada
Route::resource('strengths', 'StrengthController')
ning oleks palju vähem messi ja kood oleks arusaadavam. ning lihtsam grupeerida neid.
*/


Route::get('/', 'AuthController@signin');
Route::get('/authorize', 'AuthController@gettoken');
Route::get('/unauthorized', function () {
    return view('unauthorized.unauthorized');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'App\Http\Middleware\Admin'], function () {

        Route::post('/admin/team/moderator/add/{id}', 'TeamsController@addModerator')->name('moderatorAdd');
        Route::post('/admin/strength/create/strength', 'StrengthController@createStrength')->name('strengthAdd');
        Route::post('/admin/strength/create/category', 'CategoryController@createCategory')->name('categoryAdd');
        Route::delete('/admin/strength/delete', 'CategoryStrengthController@deleteStrength')->name('deleteStrength');
        Route::post('/admin/strength/update', 'CategoryStrengthController@updateStrength')->name('updateStrength');
        Route::delete('/admin/category/delete', 'CategoryController@deleteCategory')->name('deleteCategory');
        Route::delete('/admin/user/delete', 'UserController@deleteUser')->name('deleteUser');
        Route::post('/admin/category/update', 'CategoryController@updateCategory')->name('updateCategory');
        Route::post('/admin/department/update/{id}', 'DepartmentController@update')->name('updateDepartment');
        Route::delete('/admin/department/delete', 'DepartmentController@delete')->name('deleteDepartment');

    });
    Route::post('/user/{id}/update/strength', 'UserStrengthController@userStrength')->name('updateUserStrength');
    Route::get('/users', 'UserController@userIdName')->name('usersIdName');
    Route::post('/user/{id}/update', 'UserController@update')->name('update');
    Route::get('/strength/list', 'StrengthController@returnStrengthName')->name('strengthsName');
    Route::get('/admin/strength', 'StrengthController@view')->name('strengthsView');
    Route::get('/admin/users/add', 'AddController@add')->name('userAddView');
    Route::post('/admin/users/add', 'AddController@store')->name('userAdd');
    Route::get('/admin/category/info', 'CategoryStrengthController@categoryInfo')->name('categoryInfo');
    Route::get('/admin/category/list/', 'CategoryStrengthController@view')->name('returnCategoryStrengthView');
    Route::get('/admin/strength/info', 'CategoryStrengthController@strengthCategoryInfo')->name('strengthInfo');
    Route::get('/user/career/info/{id}', 'PersonalDevelopmentController@userInfo');
    Route::get('/career/roles', 'CareerController@careerRoleMilestonesData');
    Route::get('/upload', 'ImageController@show');
    Route::get('/user/{id}/update', 'UserController@showedit');

    Route::post('/upload/{id}', 'ImageController@upload')->name('upload');
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
    Route::get('admin/career/add', 'CareerController@show')->name('addCareer');

    Route::post('admin/career/add', 'CareerController@create')->name('addCareer');
    Route::post('/user/{id}/career/milestone/create', 'CareerController@createMilestone')->name('createMilestone');
    Route::post('/user/{id}/career/milestone/update', 'CareerController@updateMilestone')->name('updateMilestone');
    Route::post('/user/{id}/career/milestone/delete', 'CareerController@deleteMilestone')->name('deleteMilestone');
    Route::patch('/user/{id}/career/update', 'CareerController@updateCareer')->name('updateCareer');
    Route::delete('/user/{id}/career/delete', 'CareerController@deleteCareer')->name('deleteCareer');

    Route::post('/user/{id}/career/role/create', 'CareerController@createCareer')->name('createCareer');
    Route::post('/user/{id}/career/role/select', 'CareerController@selectCareer')->name('selectCareer');
    Route::post('/user/{id}/career/role/save', 'CareerController@saveCareer')->name('saveCareer');

    Route::delete('user/{id}/delete/hobby', 'HobbyController@deleteUserHobby')->name('deleteUserHobby');
    Route::get('/user/{id}', 'UserController@show')->name('profile');
    Route::get('user/{id}/career/info', 'CareerController@returnUserData')->name('careerInfo');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/usersDepartment', 'HomeController@userNoDepartment')->name('users');
    Route::get('department/add', 'DepartmentController@view')->name('departmentadd');
    Route::post('department/store', 'DepartmentController@store')->name('store');
    Route::post('update/milestone/{id}', 'CareerController@completeMilestone')->name('updateMilestone');

    Route::get('/admin/department/list', 'DepartmentController@viewAdminDepartment')->name('adminDepartmentView');
    Route::get('/admin/team/list', 'TeamsController@viewAdminTeam')->name('viewAdminTeam');

    Route::get('department/{id}', 'DepartmentController@show')->name('team');
    Route::get('department/{id}/user', 'DepartmentController@userDepartment')->name('user');
    Route::get('departmentInfo', 'DepartmentController@departmentInfo')->name('departmentInfo');
    Route::get('teamInfo', 'TeamsController@teamInfo')->name('teamInfo');
    Route::get('department', 'DepartmentController@department')->name('department');
    Route::get('/admin/team/moderator/add/{id}', 'TeamsController@returnView')->name('returnView');
    Route::get('/admin/users/list/', 'UserController@AdminUsersListView')->name('returnAdminUserList');
    Route::get('admin/team/create', 'TeamsController@teamView')->name('returnTeam');
    Route::post('admin/team/create', 'TeamsController@createTeam')->name('createTeam');
    Route::get('/users', 'UserController@users')->name('usersInfo');

    Route::put('/admin/team/{id}/update', 'TeamsController@update')->name('updateTeam');
    Route::delete('/admin/team/{id}/delete', 'TeamsController@delete')->name('deleteTeam');


    Route::get('/view/department', 'DepartmentUserCategoryStrengthController@view')->name('departmentStrengths');

    Route::get('/departments', 'DepartmentUserCategoryStrengthController@departmentUserStrength')->name('departmentUserStrength');
    Route::get('/categories', 'DepartmentUserCategoryStrengthController@categoryStrength')->name('categoryStrength');
    Route::get('/user/{id}/strengths', 'UserStrengthController@fetchUserStrength')->name('userStrengths');
    Route::get('/admin/team/list/{id}', 'AdminTeamController@index')->name('adminTeamView');
    Route::get('admin/career/template/list', 'AdminCareerTemplateManager@index')->name('adminCareerTemplateManagerView');
    Route::patch('admin/career/template/list/{id}', 'AdminCareerTemplateManager@careerUpdate')->name('adminCareerTemplateManagerUpdate');
    Route::patch('admin/career/template/list/milestone/{id}', 'AdminCareerTemplateManager@updateCareerMilestone')->name('adminCareerTemplateManagerUpdateMilestone');
    Route::post('admin/career/template/list/milestone/{id}', 'AdminCareerTemplateManager@createMilestone')->name('adminCareerTemplateManagerCreateMilestone');
    Route::delete('admin/career/template/list/', 'AdminCareerTemplateManager@deleteCareer')->name('adminCareerTemplateManagerDeleteCareer');
    Route::delete('admin/career/template/list/milestone', 'AdminCareerTemplateManager@deleteCareerMilestone')->name('adminCareerTemplateManagerDeleteCareerMilestone');
    Route::patch('/admin/team/list/{id}', 'AdminTeamController@updateTeamUser')->name('adminTeamView');


});

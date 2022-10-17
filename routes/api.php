<?php

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');

});

Route::group([
    'middleware' => 'auth:api',
    'namespace' => 'App\Http\Controllers',
], function ($router) {

    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    //Roles and Permission
    Route::post('/role/create', 'RolesController@createRole');
    Route::get('/role/get/all', 'RolesController@getRoles');
    Route::post('/role/getRolePermissions', 'RolesController@getRolePermissions');
    Route::post('/role/editRole', 'RolesController@editRole');
    Route::post('/role/assignRole', 'RolesController@assignRole');
    Route::post('/role/removeRole', 'RolesController@removeRole');
    Route::post('/role/addSinglePermissiontoRole', 'RolesController@addSinglePermissiontoRole');
    Route::post('/role/addMultiplePermissiontoRole', 'RolesController@addMultiplePermissiontoRole');
    Route::post('/role/revokeRolePermission', 'RolesController@revokeRolePermission');

    Route::post('/permission/create', 'PermissionsController@createPermission');
    Route::get('/permission/get/all', 'PermissionsController@getPermissions');

    //Managers
    Route::post('/manager/create', 'ManagerController@create');
    Route::get('/manager/get/all', 'ManagerController@getAllManagers');
    Route::post('/manager/get', 'ManagerController@getManager');
    Route::post('/manager/update', 'ManagerController@update');
    Route::post('/manager/change/status', 'ManagerController@changeStatus');

});
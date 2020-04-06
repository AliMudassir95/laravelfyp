<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// auth
Route::auth();
Route::get('/home', 'HomeController@index');
//auth


Route::get('/admin',["middleware"=>"admin", function () {
    return view('admin.index');
}]);

Route::group(['middleware'=>'admin'], function (){
    Route::resource('admin/users','AdminUsersController');
});
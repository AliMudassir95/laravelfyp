<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
//     Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

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

Route::get('/post/{id}', ['as'=>'home.post','uses'=>'AdminPostsController@post']);
//Route::post('/post/comment', 'AdminPostsController@publicComment');  //custom


Route::get('/admin',["middleware"=>"admin", function () {   // custom
    return view('admin.index');
}]);

Route::group(['middleware'=>'admin'], function (){
    Route::resource('admin/users','AdminUsersController');
    Route::resource('admin/posts','AdminPostsController');
    Route::resource('admin/categories','AdminCategoriesController');
    Route::resource('admin/media','AdminMediaController');
//    Route::get('admin/media/upload',['as'=>'admin.media.upload' , 'uses'=>'AdminMediaController@store']);
//    Route::get('admin/media/index',['as'=>'admin.media.index' , 'uses'=>'AdminMediaController@index']);
});

Route::resource('admin/comments','PostCommentsController');
Route::resource('admin/comment/replies','CommentRepliesController');

Route::group(['middleware'=>'auth'], function (){
    Route::post('comment/replies','CommentRepliesController@publicReplies');      //custom
});
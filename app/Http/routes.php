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

Route::get('/','PostController@index');
// Halaman Statik Tentang
Route::get('/tentang', function(){
    return view('tentang');
});
// Halaman Event
Route::get('/event', 'EventController@index');
Route::get('/event/create', 'EventController@create');
Route::get('/event/{slug}', 'EventController@show');
Route::post('/event/create', 'EventController@store');

// Halaman Statik Kontak
Route::get('/kontak', function(){
    return view('kontak');
});
// Tampilkan Blog Post
Route::get('/blog', 'PostController@index');


//Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);


//authentication
Route::controllers([
 'auth' => 'Auth\AuthController',
 'password' => 'Auth\PasswordController',
]);
// check for logged in user
Route::group(['middleware' => ['auth']], function()
{
  Route::get('/dashboard',['as' => 'dashboard', 'uses' => 'DashboardController@index']);


 // show new post form
 Route::get('new-post','PostController@create');
 // save new post
 Route::post('new-post','PostController@store');
 // edit post form
 Route::get('edit/{slug}','PostController@edit');
 // update post
 Route::post('update/post','PostController@update');
 // delete post
 Route::get('delete/post/{id}','PostController@destroy');
 // display user's all posts
 Route::get('my-all-posts','UserController@user_posts_all');

// ------------------------------------------------------//


 // Add user
 Route::get('user/add-user', 'UserController@create');
 // Store Add user
 Route::post('user/add-user','UserController@store');

 // Delete User
 Route::get('user/delete/{id}','UserController@destroy');

// display ALl user
 Route::get('user/all','UserController@index');
// edit detail user
  Route::get('user/edit/{id}','UserController@edit');
  // update detail user
  Route::post('update/user','UserController@update');

  // settings user masing-masing
  Route::get('user/settings/','UserController@settings');

// --------------------------------------------------------//

 // display user's drafts
 Route::get('my-drafts','UserController@user_posts_draft');
 // add comment
 Route::post('comment/add','CommentController@store');
 // delete comment
 Route::post('comment/delete/{id}','CommentController@distroy');
});
//users profile
//Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');

//users profile with username
Route::get('user/{username}','UserController@profile')->where('username', '[A-Za-z-_]+');

// display list of posts
//Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');

// display list of posts with username
Route::get('user/{username}/posts','UserController@user_posts')->where('username', '[A-Za-z-_]+');
// display single post
Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');




// Login dan Logut
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Daftar
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

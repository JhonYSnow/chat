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

use Illuminate\Http\Request;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('time', function () {
    if(Auth::check()) {
        return date('Y-m-d H:i:s');
    }else{
        return view('/auth/login');
    }
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    Route::get('/', 'HomeController@index');

    Route::get('/chat', 'HomeController@chat');

    Route::get('/firstPage', 'HomeController@firstPage');
});

Route::resource('user', 'UserController');
Route::resource('friend', 'FriendController');
Route::resource('group', 'GroupController');
Route::resource('message', 'MessageController');

Route::get('/deleteFriend', 'FriendController@delete');
Route::get('/undoneFriend', 'FriendController@undone');
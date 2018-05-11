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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Routes for our manage pages
Route::prefix('manage')->middleware('role:superadministrator|administrator|editor|author|contributor')->group(function(){
    //here we will create a route group.  Everything will be prefixed with 'manage'...manage/users, manage/posts, manage/dashboard, etc..
    //we only want the editor, contributor, author, administrator, and super administrator roles have access to the dashboard. 
    //To do this, we can add the middleware to this entire group and restrict it by role.  Someone who has these roles gets access to the backend.

    Route::get('/', 'ManageController@index');
    Route::get('/dashboard', 'ManageController@dashboard')->name('manage.dashboard');
        //we are giving the dashboard url a name...manage.dashboard.
        //we are using the manage controller with the "dashboard" action.
        //we create the controller using php artisan make:controller ManageController
    Route::resource('/users','UserController');
});

Route::get('/home', 'HomeController@index')->name('home');

<?php

use Illuminate\Http\Request;

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

//this file is similar to web.php, but for api routes.

//we will use the api route that is created by default and modify it a bit:
Route::middleware('auth:api')->group(function () {
    //the group just makes it so that everything inside of this route will be wrapped wit hthe api token authentication we set up.

    Route::get('/posts/unique', 'PostController@apiCheckUnique')->name('api.posts.unique');
        //I like to keep my api requests in the same controller that they are manipulating
});

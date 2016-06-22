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

Route::get('/', 'Controller@index');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');

Route::post('info/secret', 'InfoController@secret');

Route::group(['middleware' => 'auth'], function () {
    Route::get('auth/logout', 'Auth\AuthController@logout');

    Route::post('info/image', 'InfoController@image');
    Route::get('info/destroyimage', 'InfoController@destroyImage');
    Route::post('info/store', 'InfoController@store');
    Route::post('info/update', 'InfoController@update');
    Route::get('info/destroy/{id}', 'InfoController@destroy');

    Route::post('skillgroup/store', 'SkillGroupController@store');
    Route::get('skillgroup/destroy/{id}', 'SkillGroupController@destroy');
    Route::post('skillgroup/update', 'SkillGroupController@update');

    Route::post('skill/store', 'SkillController@store');
    Route::get('skill/destroy/{id}', 'SkillController@destroy');
    Route::post('skill/update', 'SkillController@update');

    Route::post('work/store', 'WorkController@store');
    Route::post('work/update', 'WorkController@update');
    Route::get('work/destroy/{id}', 'WorkController@destroy');
});


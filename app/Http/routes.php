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

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    'profile' => 'User\ProfileController',
]);
Route::group(['prefix' => 'api' ], function () {
    Route::resource('cv', 'Cv\CvController',
        ['except' => ['edit', 'create']]);
    Route::resource('cvheader', 'Cv\CvHeaderController',
        ['except' => ['index', 'edit', 'create']]);
    Route::resource('section', 'Cv\SectionController',
        ['except' => ['index', 'edit', 'create']]);
    Route::resource('item', 'Cv\ItemController',
        ['except' => ['index', 'edit', 'create']]);
    Route::resource('entry', 'Cv\EntryController',
        ['except' => ['index', 'edit', 'create']]);
    Route::resource('itemheader', 'Cv\ItemHeaderController',
        ['except' => ['index', 'edit', 'create']]);
    Route::resource('image', 'Cv\ImageController',
        ['except' => ['index', 'edit', 'create']]);
});

Route::get('/', ['middleware'=>'redirectAdmin', 'uses'=>'HomeController@index']);
Route::get('/pdf', ['middleware'=>'auth', 'uses'=>'HomeController@pdf']);
Route::get('/home', [ 'uses'=>'HomeController@home']);


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::resource('template', 'Admin\TemplateController');
    Route::resource('user', 'Admin\UserController');
});

Route::get('/{name}', ['uses' => 'HomeController@getCv'])
    ->where('name', '[-A-Za-z0-9_-]+');

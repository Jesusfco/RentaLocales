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

Route::get('/', 'UtilController@login');
Route::post('/', 'UtilController@signIn');

Route::prefix('app')->group(function () {  

    Route::get('/', 'UtilController@dashboard');

    Route::prefix('usuarios')->group(function () { 
        Route::get('', 'UsersController@list');
        Route::get('ver/{id}', 'UsersController@show');
        Route::get('edit/{id}', 'UsersController@edit');
        Route::post('edit/{id}', 'UsersController@update');
        Route::get('create', 'UsersController@create');
        Route::post('create', 'UsersController@store');            
        Route::get('delete/{id}', 'UsersController@delete');   
    });

    Route::prefix('perfil')->group(function () { 
        Route::get('/', 'PerfilController@index');
        Route::get('edit', 'PerfilController@edit');
        Route::post('edit', 'PerfilController@update');
        Route::get('password', 'PerfilController@password');
        Route::post('password', 'PerfilController@passwordUpdate');
    });

});

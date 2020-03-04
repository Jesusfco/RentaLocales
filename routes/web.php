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

    Route::get('/sugest/business', 'UtilController@getBusinessSugest');
    Route::get('/sugest/lessee', 'UtilController@getUsersLesseeSugest');

    

    Route::prefix('usuarios')->group(function () { 
        Route::get('', 'UsersController@list');
        Route::get('ver/{id}', 'UsersController@show');
        Route::get('edit/{id}', 'UsersController@edit');
        Route::post('edit/{id}', 'UsersController@update');
        Route::get('create', 'UsersController@create');
        Route::post('create', 'UsersController@store');            
        Route::get('delete/{id}', 'UsersController@delete');   

        Route::get('ver/{id}/negocios', 'UsersController@businessList');
        Route::get('ver/{id}/enlazar-negocio', 'UsersController@createBusinessEnrollment');
        Route::post('ver/{id}/enlazar-negocio', 'UsersController@storeBusinessEnrollment');

        
    });

    Route::prefix('locales')->group(function () { 
        Route::get('', 'LocalController@list');
        Route::get('ver/{id}', 'LocalController@show');
        Route::get('edit/{id}', 'LocalController@edit');
        Route::post('edit/{id}', 'LocalController@update');
        Route::get('create', 'LocalController@create');
        Route::post('create', 'LocalController@store');            
        Route::get('delete/{id}', 'LocalController@delete');   
    });

    Route::prefix('negocios')->group(function () { 
        Route::get('', 'BusinessController@list');
        Route::get('ver/{id}', 'BusinessController@show');
        Route::get('ver/{id}/mensualidades', 'BusinessController@monthlyHistory');
        Route::get('ver/{id}/nueva-mensualidad', 'BusinessController@newMonthly');
        Route::post('ver/{id}/nueva-mensualidad', 'BusinessController@storeMonthly');
        Route::get('edit/{id}', 'BusinessController@edit');
        Route::post('edit/{id}', 'BusinessController@update');
        Route::get('create', 'BusinessController@create');
        Route::post('create', 'BusinessController@store');            
        Route::get('delete/{id}', 'BusinessController@delete');   
    });

    Route::prefix('perfil')->group(function () { 
        Route::get('/', 'PerfilController@index');
        Route::get('edit', 'PerfilController@edit');
        Route::post('edit', 'PerfilController@update');
        Route::get('password', 'PerfilController@password');
        Route::post('password', 'PerfilController@passwordUpdate');
    });

});

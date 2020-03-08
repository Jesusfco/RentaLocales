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

// Route::middleware('auth')->group(function () {
Route::prefix('app')->group(function () {  

    Route::get('/', 'UtilController@dashboard');

    Route::get('/sugest/business', 'UtilController@getBusinessSugest');
    Route::get('/sugest/lessee', 'UtilController@getUsersLesseeSugest');
    Route::get('/sugest/locals', 'UtilController@getLocalSugest');

    

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
        Route::get('ver/{user_id}/negocios/delete/{business_id}', 'UsersController@deleteBusinessEnrollment');       
        
    });

    Route::prefix('recibos')->group(function () { 

        Route::get('', 'ReceiptController@list');
        Route::get('ver/{id}', 'ReceiptController@show');
        // Route::get('edit/{id}', 'ReceiptController@edit');
        // Route::post('edit/{id}', 'ReceiptController@update');
        Route::get('create', 'ReceiptController@create');
        Route::post('create', 'ReceiptController@store');            
        Route::get('delete/{id}', 'ReceiptController@delete');   
                    
    });

    Route::prefix('locales')->group(function () { 
        Route::get('', 'LocalController@list');
        Route::get('ver/{id}', 'LocalController@show');
        Route::get('edit/{id}', 'LocalController@edit');
        Route::post('edit/{id}', 'LocalController@update');
        Route::get('create', 'LocalController@create');
        Route::post('create', 'LocalController@store');            
        Route::get('delete/{id}', 'LocalController@delete');   

        Route::get('ver/{id}/asignar-negocio', 'LocalController@enrollBusiness');   
        Route::post('ver/{id}/asignar-negocio', 'LocalController@storeEnrollBusiness');   
        Route::get('ver/{id}/historial-negocios', 'LocalController@business');   
        Route::get('ver/{number}/historial-negocios/delete/{business_id}', 'LocalController@deleteBusinessEnroll');   
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

        Route::get('ver/{id}/locales', 'BusinessController@localList');
        Route::get('ver/{id}/recibos', 'BusinessController@receipts');        
        Route::get('ver/{id}/usuarios', 'BusinessController@users');

        Route::get('ver/{id}/enlazar-local', 'BusinessController@enrollLocal');
        Route::post('ver/{id}/enlazar-local', 'BusinessController@storeEnrollLocal');
        Route::get('ver/{id}/enlazar-usuario', 'BusinessController@enrollUser');
        Route::post('ver/{id}/enlazar-usuario', 'BusinessController@storeEnrollUser');

        Route::get('ver/{business_id}/recibos/delete/{receipt_id}', 'BusinessController@deleteReceipt');
        Route::get('ver/{business_id}/locales/delete/{local_id}', 'BusinessController@deleteEnrollmentLocal');
        Route::get('ver/{business_id}/usuarios/delete/{user_id}', 'BusinessController@deleteEnrollUser');
    });

    Route::prefix('perfil')->group(function () { 
        Route::get('/', 'PerfilController@index');
        Route::get('edit', 'PerfilController@edit');
        Route::post('edit', 'PerfilController@update');
        Route::get('password', 'PerfilController@password');
        Route::post('password', 'PerfilController@passwordUpdate');
    });

}); #PREFIX GROUP
// });//MIDDLEWARE 
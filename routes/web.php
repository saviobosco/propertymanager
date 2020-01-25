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

Route::middleware(['auth'])->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/properties', 'PropertiesController@index')->name('properties.index');
    Route::get('/properties/create', 'PropertiesController@create')->name('properties.create');
    Route::post('/properties/create', 'PropertiesController@store')->name('properties.create');
    Route::get('/properties/edit/{property}', 'PropertiesController@edit')->name('properties.edit');
    Route::post('/properties/edit/{property}', 'PropertiesController@update')->name('properties.edit');
    Route::delete('/properties/edit/{property}', 'PropertiesController@destroy')->name('properties.delete');


    Route::get('/tenants', 'TenantsController@index')->name('tenants.index');
    Route::get('/tenants/create', 'TenantsController@create')->name('tenants.create');
    Route::post('/tenants/create', 'TenantsController@store')->name('tenants.create');
    Route::get('/tenants/edit/{tenant}', 'TenantsController@edit')->name('tenants.edit');
    Route::post('/tenants/edit/{tenant}', 'TenantsController@update')->name('tenants.edit');
    Route::delete('/tenants/delete/{tenant}', 'TenantsController@destroy')->name('tenants.delete');

    Route::post('/tenants/notify/{id}', 'TenantsController@notifyTenant')->name('tenants.notify');
});


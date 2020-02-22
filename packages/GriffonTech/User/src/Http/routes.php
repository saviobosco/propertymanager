<?php

Route::group(['middleware' => ['web']], function(){

    /*** User route declarations */
    Route::prefix('user')->group(function(){

        Route::group(['middleware' => ['auth']], function(){

            Route::get('dashboard/index', 'GriffonTech\User\Http\Controllers\DashboardController@index')->defaults('_config', [
                'view' => 'user::user.dashboard.index'
            ])->name('user.dashboard.index');

            /** User properties */
            Route::get('properties/index', 'GriffonTech\User\Http\Controllers\PropertiesController@index')->defaults('_config', [
                'view' => 'user::user.properties.index'
            ])->name('user.properties.index');

            Route::get('/properties/create', 'GriffonTech\User\Http\Controllers\PropertiesController@create')->defaults('_config', [
                'view' => 'user::user.properties.create'
            ])->name('user.properties.create');

            Route::post('/properties/create', 'GriffonTech\User\Http\Controllers\PropertiesController@store')->defaults('_config', [
                'redirect' => 'user.properties.index'
            ])->name('user.properties.create');

            Route::get('/properties/edit/{id}', 'GriffonTech\User\Http\Controllers\PropertiesController@edit')->defaults('_config', [
                'view' => 'user::user.properties.edit'
            ])->name('user.properties.edit');

            Route::post('/properties/edit/{id}', 'GriffonTech\User\Http\Controllers\PropertiesController@update')->defaults('_config', [
                'redirect' => 'user.properties.index'
            ])->name('user.properties.edit');

            Route::get('/properties/show/{id}', 'GriffonTech\User\Http\Controllers\PropertiesController@show')->defaults('_config', [
                'view' => 'user::user.properties.show'
            ])->name('user.properties.show');

            Route::delete('/properties/delete/{id}', 'GriffonTech\User\Http\Controllers\PropertiesController@destroy')->defaults('_config', [
                'redirect' => 'user.properties.index'
            ])->name('user.properties.delete');

            Route::get('properties/get_tenants/{id}', 'GriffonTech\User\Http\Controllers\PropertiesController@getTenants')->defaults('_config', [
                'view' => 'user::user.properties.tenants'
            ])->name('user.properties.tenants');


            /** User Units */
            Route::get('units/index', 'GriffonTech\User\Http\Controllers\UnitsController@index')->defaults('_config', [
                'view' => 'user::user.units.index'
            ])->name('user.units.index');

            Route::get('/units/create', 'GriffonTech\User\Http\Controllers\UnitsController@create')->defaults('_config', [
                'view' => 'user::user.units.create'
            ])->name('user.units.create');

            Route::post('/units/create', 'GriffonTech\User\Http\Controllers\UnitsController@store')->defaults('_config', [
                'redirect' => 'user.units.index'
            ])->name('user.units.create');

            Route::get('/units/edit/{id}', 'GriffonTech\User\Http\Controllers\UnitsController@edit')->defaults('_config', [
                'view' => 'user::user.units.edit'
            ])->name('user.units.edit');

            Route::post('/units/edit/{id}', 'GriffonTech\User\Http\Controllers\UnitsController@update')->defaults('_config', [
                'redirect' => 'user.units.index'
            ])->name('user.units.edit');

            Route::get('/units/show/{id}', 'GriffonTech\User\Http\Controllers\UnitsController@show')->defaults('_config', [
                'view' => 'user::user.units.show'
            ])->name('user.units.show');

            Route::delete('/units/delete/{id}', 'GriffonTech\User\Http\Controllers\UnitsController@destroy')->defaults('_config', [
                'redirect' => 'user.units.index'
            ])->name('user.units.delete');


            /** Unit Tenants */
            Route::get('/units/{unit_id}/tenants/index', 'GriffonTech\User\Http\Controllers\TenantsController@index')->defaults('_config', [
                'view' => 'user::user.tenants.index'
            ])->name('user.units.tenants.index');

            Route::get('/units/{id}/tenants/create', 'GriffonTech\User\Http\Controllers\TenantsController@create')->defaults('_config', [
                'view' => 'user::user.tenants.create'
            ])->name('user.units.tenants.create');

            Route::post('/units/{id}/tenants/create', 'GriffonTech\User\Http\Controllers\TenantsController@store')->defaults('_config', [
                'redirect' => 'user.units.tenants.index'
            ])->name('user.units.tenants.create');


            Route::get('/units/{id}/tenants/show/{tenant_id}', 'GriffonTech\User\Http\Controllers\TenantsController@show')->defaults('_config', [
                'view' => 'user::user.tenants.show'
            ])->name('user.tenants.show');


            /** Tenants  */

            Route::get('/tenants/index', 'GriffonTech\User\Http\Controllers\TenantsController@index')->defaults('_config', [
                'view' => 'user::user.tenants.index'
            ])->name('user.tenants.index');

            Route::get('/tenants/create', 'GriffonTech\User\Http\Controllers\TenantsController@create')->defaults('_config', [
                'view' => 'user::user.tenants.create'
            ])->name('user.tenants.create');

            Route::post('/tenants/create', 'GriffonTech\User\Http\Controllers\TenantsController@store')->defaults('_config', [
                'redirect' => 'user.tenants.index'
            ])->name('user.tenants.create');

            Route::get('/tenants/edit/{tenant_id}', 'GriffonTech\User\Http\Controllers\TenantsController@edit')->defaults('_config', [
                'view' => 'user::user.tenants.edit'
            ])->name('user.tenants.edit');

            Route::post('/tenants/edit/{tenant_id}', 'GriffonTech\User\Http\Controllers\TenantsController@update')->defaults('_config', [
                'redirect' => 'user.tenants.index'
            ])->name('user.tenants.edit');

            Route::get('/tenants/show/{tenant_id}', 'GriffonTech\User\Http\Controllers\TenantsController@show')->defaults('_config', [
                'view' => 'user::user.tenants.show'
            ])->name('user.tenants.show');

            Route::delete('/tenants/delete/{tenant_id}', 'GriffonTech\User\Http\Controllers\TenantsController@destroy')->defaults('_config', [
                'redirect' => 'user.tenants.index'
            ])->name('user.tenants.delete');

            /** SMS Center */

            Route::get('/sms-center/index', 'GriffonTech\User\Http\Controllers\SMSCenterController@index')->defaults('_config', [
                'view' => 'user::user.sms-center.index'
            ])->name('user.sms-center.index');

            Route::get('/sms-center/create', 'GriffonTech\User\Http\Controllers\SMSCenterController@create')->defaults('_config', [
                'view' => 'user::user.sms-center.create'
            ])->name('user.sms-center.create');

        });
    });
});

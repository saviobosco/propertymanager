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


            Route::get('/properties/get_property_unit_types/{id}', 'GriffonTech\User\Http\Controllers\PropertiesController@get_property_unit_types')->defaults('_config', [
                'view' => 'user::user.properties.property_unit_types'
            ])->name('user.properties.get_property_unit_types');



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


            /** Unit Rent Payments  */

            Route::get('/unit_rent_payments/create', 'GriffonTech\User\Http\Controllers\UnitRentPaymentsController@create')->defaults('_config', [
                'view' => 'user::user.unit_rent_payments.create'
            ])->name('user.unit_rent_payments.create');

            Route::post('/unit_rent_payments/create', 'GriffonTech\User\Http\Controllers\UnitRentPaymentsController@store')->defaults('_config', [
                'redirect' => 'user.unit_rent_payments'
            ])->name('user.unit_rent_payments.create');




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


            /**
             * Amenities
             */
            Route::get('/amenities/index', 'GriffonTech\User\Http\Controllers\AmenitiesController@index')->defaults('_config', [
                'view' => 'user::amenities.index'
            ])->name('amenities.index');

            Route::get('/amenities/create', 'GriffonTech\User\Http\Controllers\AmenitiesController@create')->defaults('_config', [
                'view' => 'user::amenities.create'
            ])->name('amenities.create');

            Route::post('/amenities/create', 'GriffonTech\User\Http\Controllers\AmenitiesController@store')->defaults('_config', [
                'redirect' => 'amenities.index'
            ])->name('amenities.store');

            Route::get('/amenities/edit/{id}', 'GriffonTech\User\Http\Controllers\AmenitiesController@edit')->defaults('_config', [
                'view' => 'user::amenities.edit'
            ])->name('amenities.edit');

            Route::post('/amenities/edit/{id}', 'GriffonTech\User\Http\Controllers\AmenitiesController@update')->defaults('_config', [
                'redirect' => 'amenities.index'
            ])->name('amenities.edit');

            Route::delete('/amenities/delete/{id}', 'GriffonTech\User\Http\Controllers\AmenitiesController@destroy')->defaults('_config', [
                'redirect' => 'amenities.index'
            ])->name('amenities.delete');


            /** Unit Types */
            Route::get('/unit-types/index', 'GriffonTech\User\Http\Controllers\UnitTypesController@index')->defaults('_config', [
                'view' => 'user::unit_types.index'
            ])->name('unit_types.index');

            Route::get('/unit-types/create', 'GriffonTech\User\Http\Controllers\UnitTypesController@create')->defaults('_config', [
                'view' => 'user::unit_types.create'
            ])->name('unit_types.create');

            Route::post('/unit-types/create', 'GriffonTech\User\Http\Controllers\UnitTypesController@store')->defaults('_config', [
                'redirect' => 'unit_types.index'
            ])->name('unit_types.create');

            Route::get('/unit-types/edit/{id}', 'GriffonTech\User\Http\Controllers\UnitTypesController@edit')->defaults('_config', [
                'view' => 'user::unit_types.edit'
            ])->name('unit_types.edit');


            Route::post('/unit-types/edit/{id}', 'GriffonTech\User\Http\Controllers\UnitTypesController@update')->defaults('_config', [
                'redirect' => 'unit_types.index'
            ])->name('unit_types.edit');


            Route::delete('/unit-types/delete/{id}', 'GriffonTech\User\Http\Controllers\UnitTypesController@destroy')->defaults('_config', [
                'redirect' => 'unit_types.index'
            ])->name('unit_types.delete');


            /**
             * Property Unit Type
             */
            Route::get('/properties/{property_id}/property-unit-types/index', 'GriffonTech\User\Http\Controllers\PropertyUnitTypesController@index')->defaults('_config', [
                'view' => 'user::user.property_unit_types.index'
            ])->name('user.property_unit_types.index');


            Route::get('/properties/{property_id}/property-unit-types/create', 'GriffonTech\User\Http\Controllers\PropertyUnitTypesController@create')->defaults('_config', [
                'view' => 'user::user.property_unit_types.create'
            ])->name('user.property_unit_types.create');


            Route::post('/properties/{property_id}/property-unit-types/create', 'GriffonTech\User\Http\Controllers\PropertyUnitTypesController@store')->defaults('_config', [
                'redirect' => 'user.property_unit_types.index'
            ])->name('user.property_unit_types.create');

            Route::get('/property-unit-types/show/{id}', 'GriffonTech\User\Http\Controllers\PropertyUnitTypesController@show')->defaults('_config', [
                'view' => 'user::user.property_unit_types.show'
            ])->name('user.property_unit_types.show');

            Route::get('/property-unit-types/edit/{id}', 'GriffonTech\User\Http\Controllers\PropertyUnitTypesController@edit')->defaults('_config', [
                'view' => 'user::user.property_unit_types.edit'
            ])->name('user.property_unit_types.edit');


            Route::post('/property-unit-types/edit/{id}', 'GriffonTech\User\Http\Controllers\PropertyUnitTypesController@update')->defaults('_config', [
                'redirect' => 'user.property_unit_types.index'
            ])->name('user.property_unit_types.edit');

            Route::delete('/property-unit-types/delete/{id}', 'GriffonTech\User\Http\Controllers\PropertyUnitTypesController@destroy')->defaults('_config', [
                'redirect' => 'user.property_unit_types.index'
            ])->name('user.property_unit_types.delete');
        });
    });
});

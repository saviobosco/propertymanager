<?php

Route::group(['middleware' => ['web']], function(){

    /*** User route declarations */
    Route::prefix('manager')->group(function(){

        Route::get('register', 'GriffonTech\User\Http\Controllers\RegisterController@index')->defaults('_config', [
            'view' => 'user::user.auth.register'
        ])->name('user.register.create');

        Route::post('dashboard/index', 'GriffonTech\User\Http\Controllers\RegisterController@index')->defaults('_config', [
            'redirect' => 'user.dashboard.index'
        ])->name('user.register.store');


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

            // url for task creation unit ajax call. Returns a JSON.
            Route::get('properties/get-units/{id}', 'GriffonTech\User\Http\Controllers\PropertiesController@getUnits')->defaults('_config', [
                'view' => 'user::user.properties.units'
            ])->name('user.properties.units');




            /** Property Owners */
            Route::get('properties/{property_id}/property-owners/index', 'GriffonTech\User\Http\Controllers\PropertyOwnersController@index')->defaults('_config', [
                'view' => 'user::user.property_owners.index'
            ])->name('user.property_owners.index');

            Route::get('properties/{property_id}/property-owners/create', 'GriffonTech\User\Http\Controllers\PropertyOwnersController@create')->defaults('_config', [
                'view' => 'user::user.property_owners.create'
            ])->name('user.property_owners.create');

            Route::post('/property-owners/create', 'GriffonTech\User\Http\Controllers\PropertyOwnersController@store')->defaults('_config', [
                'redirect' => 'user.property_owners.index'
            ])->name('user.property_owners.store');

            Route::get('/property-owners/edit/{propertyOwner}', 'GriffonTech\User\Http\Controllers\PropertyOwnersController@edit')->defaults('_config', [
                'view' => 'user::user.property_owners.edit'
            ])->name('user.property_owners.edit');

            Route::post('/property-owners/edit/{propertyOwner}', 'GriffonTech\User\Http\Controllers\PropertyOwnersController@update')->defaults('_config', [
                'view' => 'user::user.property_owners.create'
            ])->name('user.property_owners.update');

            Route::delete('/property-owners/delete/{propertyOwner}', 'GriffonTech\User\Http\Controllers\PropertyOwnersController@destroy')->defaults('_config', [
                'redirect' => 'user.property_owners.index'
            ])->name('user.property_owners.delete');

            /** Property Owner Properties */
            Route::delete('/property-owners-properties/delete/{rentalOwnerProperty}', 'GriffonTech\User\Http\Controllers\RentalOwnerPropertiesController@destroy')->defaults('_config', [
                'redirect' => 'user.property_owners.index'
            ])->name('user.property_owners.delete');


            /** Rental Owners */
            Route::get('rental/rental-owners/index', 'GriffonTech\User\Http\Controllers\RentalOwnersController@index')->defaults('_config', [
                'view' => 'user::user.rental_owners.index'
            ])->name('manager.rental_owners.index');

            Route::get('rental/rental-owners/create', 'GriffonTech\User\Http\Controllers\RentalOwnersController@create')->defaults('_config', [
                'view' => 'user::user.rental_owners.create'
            ])->name('manager.rental_owners.create');

            Route::post('rental/rental-owners/create', 'GriffonTech\User\Http\Controllers\RentalOwnersController@store')->defaults('_config', [
                'redirect' => 'user::user.rental_owners.index'
            ])->name('manager.rental_owners.store');

            // for the ajax call on task creation
            Route::get('rental/rental-owners/{propertyOwner}/properties', 'GriffonTech\User\Http\Controllers\RentalOwnersController@ownerProperties')->defaults('_config', [
                'view' => 'user::user.rental_owners.index'
            ])->name('manager.rental_owners.properties');




            /** Rent roll */
            Route::get('properties/rent-roll', 'GriffonTech\User\Http\Controllers\PropertyOwnersController@index')->defaults('_config', [
                'view' => 'user::user.rent_rolls.index'
            ])->name('manager.properties.rent_roll');


            /**
             *Property Units
             */
            Route::get('/properties/{property_id}/units/index', 'GriffonTech\User\Http\Controllers\UnitsController@index')->defaults('_config', [
                'view' => 'user::user.units.index'
            ])->name('manager.properties.units.index');

            Route::get('/properties/{property_id}/units/add', 'GriffonTech\User\Http\Controllers\UnitsController@create')->defaults('_config', [
                'view' => 'user::user.units.create'
            ])->name('manager.properties.units.create');

            Route::post('/properties/{property_id}/units/add', 'GriffonTech\User\Http\Controllers\UnitsController@index')->defaults('_config', [
                'redirect' => 'manager.properties.units.index'
            ])->name('manager.properties.units.store');

            Route::get('/properties/{property_id}/units/{id}/summary', 'GriffonTech\User\Http\Controllers\UnitsController@show')->defaults('_config', [
                'view' => 'user::user.units.show'
            ])->name('manager.properties.units.show');

            Route::get('/properties/units/edit/{id}', 'GriffonTech\User\Http\Controllers\UnitsController@edit')->defaults('_config', [
                'view' => 'user::user.units.edit'
            ])->name('manager.properties.units.edit');

            Route::post('/properties/units/edit/{id}', 'GriffonTech\User\Http\Controllers\UnitsController@update')->defaults('_config', [
                'redirect' => 'manager.properties.units.index'
            ])->name('manager.properties.units.update');

            Route::delete('/properties/units/delete/{id}', 'GriffonTech\User\Http\Controllers\UnitsController@destroy')->defaults('_config', [
                'redirect' => 'manager.properties.units.index'
            ])->name('manager.properties.units.delete');




            /** Property Unit Leases */
            Route::get('/properties/leasing/leases', 'GriffonTech\User\Http\Controllers\LeasesController@index')->defaults('_config', [
                'view' => 'user::user.leases.index'
            ])->name('manager.properties.leases.index');

            Route::get('/properties/leasing/add', 'GriffonTech\User\Http\Controllers\LeasesController@create')->defaults('_config', [
                'view' => 'user::user.leases.create'
            ])->name('manager.properties.leases.create');

            Route::post('/properties/leasing/add', 'GriffonTech\User\Http\Controllers\LeasesController@store')->defaults('_config', [
                'redirect' => 'manager.properties.leases.index'
            ])->name('manager.properties.leases.store');

            Route::get('/properties/leasing/edit/{lease}', 'GriffonTech\User\Http\Controllers\LeasesController@edit')->defaults('_config', [
                'view' => 'user::user.leases.edit'
            ])->name('manager.properties.leases.edit');

            Route::post('/properties/leasing/edit/{lease}', 'GriffonTech\User\Http\Controllers\LeasesController@update')->defaults('_config', [
                'redirect' => 'manager.properties.leases.index'
            ])->name('manager.properties.leases.update');

            Route::delete('/properties/leasing/delete/{lease}', 'GriffonTech\User\Http\Controllers\LeasesController@destroy')->defaults('_config', [
                'redirect' => 'manager.properties.leases.index'
            ])->name('manager.properties.leases.delete');

            Route::get('/properties/leasing/{lease}/tenants', 'GriffonTech\User\Http\Controllers\LeasesController@tenants')->defaults('_config', [
                'view' => 'user::user.leases.tenants'
            ])->name('manager.properties.leases.tenants');

            Route::post('/properties/leasing/{lease}/tenants/add', 'GriffonTech\User\Http\Controllers\LeasesController@addTenants')->defaults('_config', [
                'view' => 'user::user.leases.add_tenant'
            ])->name('manager.properties.leases.tenants.add');

            Route::delete('/properties/leasing/detach-tenant/{leaseTenant}', 'GriffonTech\User\Http\Controllers\LeasesController@detachTenant')->defaults('_config', [
                'view' => 'user::user.leases.add_tenant'
            ])->name('manager.properties.leases.tenants.detach');


            /**
             * Listings
             */
            Route::get('/leasing/units/listed', 'GriffonTech\User\Http\Controllers\LeasesController@index')->defaults('_config', [
                'view' => 'user::user.leases.index'
            ])->name('manager.properties.units_listed.index');

            Route::get('/leasing/units/unlisted', 'GriffonTech\User\Http\Controllers\LeasesController@index')->defaults('_config', [
                'view' => 'user::user.leases.index'
            ])->name('manager.properties.units_unlisted.index');


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




            /** Unit Rent Payments @deprecated  */
            Route::get('/unit_rent_payments/create', 'GriffonTech\User\Http\Controllers\UnitRentPaymentsController@create')->defaults('_config', [
                'view' => 'user::user.unit_rent_payments.create'
            ])->name('user.unit_rent_payments.create');

            Route::post('/unit_rent_payments/create', 'GriffonTech\User\Http\Controllers\UnitRentPaymentsController@store')->defaults('_config', [
                'redirect' => 'user.unit_rent_payments'
            ])->name('user.unit_rent_payments.create');




            /** Tenants */
            Route::get('/rentals/tenants/index', 'GriffonTech\User\Http\Controllers\TenantsController@index')->defaults('_config', [
                'view' => 'user::user.tenants.index'
            ])->name('manager.tenants.index');

            Route::get('/rentals/tenants/create', 'GriffonTech\User\Http\Controllers\TenantsController@create')->defaults('_config', [
                'view' => 'user::user.tenants.create'
            ])->name('manager.tenants.create');

            Route::post('/rentals/tenants/create', 'GriffonTech\User\Http\Controllers\TenantsController@store')->defaults('_config', [
                'redirect' => 'manager.tenants.index'
            ])->name('manager.tenants.store');

            Route::get('/rentals/tenants/edit/{id}', 'GriffonTech\User\Http\Controllers\TenantsController@edit')->defaults('_config', [
                'view' => 'user::user.tenants.edit'
            ])->name('manager.tenants.edit');

            Route::post('/rentals/tenants/edit/{id}', 'GriffonTech\User\Http\Controllers\TenantsController@update')->defaults('_config', [
                'redirect' => 'manager.tenants.index'
            ])->name('manager.tenants.update');

            Route::delete('/rentals/tenants/delete/{id}', 'GriffonTech\User\Http\Controllers\TenantsController@destroy')->defaults('_config', [
                'redirect' => 'manager.tenants.index'
            ])->name('manager.tenants.delete');




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


            /**
             * Task categories
             */

            Route::get('/task-categories/index', 'GriffonTech\User\Http\Controllers\TaskCategoriesController@index')->defaults('_config', [
                'view' => 'user::user.task_categories.index'
            ])->name('user.task_categories.index');

            Route::get('/task-categories/create', 'GriffonTech\User\Http\Controllers\TaskCategoriesController@create')->defaults('_config', [
                'view' => 'user::user.task_categories.create'
            ])->name('user.task_categories.create');

            Route::post('/task-categories/create', 'GriffonTech\User\Http\Controllers\TaskCategoriesController@store')->defaults('_config', [
                'redirect' => 'user.task_categories.index'
            ])->name('user.task_categories.store');

            Route::get('/task-categories/edit/{taskCategory}', 'GriffonTech\User\Http\Controllers\TaskCategoriesController@edit')->defaults('_config', [
                'view' => 'user::user.task_categories.edit'
            ])->name('user.task_categories.edit');

            Route::post('/task-categories/edit/{taskCategory}', 'GriffonTech\User\Http\Controllers\TaskCategoriesController@update')->defaults('_config', [
                'redirect' => 'user.task_categories.index'
            ])->name('user.task_categories.update');

            Route::delete('/task-categories/delete/{taskCategory}', 'GriffonTech\User\Http\Controllers\TaskCategoriesController@destroy')->defaults('_config', [
                'redirect' => 'user.task_categories.index'
            ])->name('user.task_categories.delete');



            /** Tasks */
            Route::get('/tasks/index', 'GriffonTech\User\Http\Controllers\TasksController@index')->defaults('_config', [
                'view' => 'user::user.tasks.index'
            ])->name('user.tasks.index');

            Route::get('/tasks/create', 'GriffonTech\User\Http\Controllers\TasksController@create')->defaults('_config', [
                'view' => 'user::user.tasks.create'
            ])->name('user.tasks.create');

            Route::post('/tasks/create', 'GriffonTech\User\Http\Controllers\TasksController@store')->defaults('_config', [
                'redirect' => 'user.tasks.index'
            ])->name('user.tasks.store');

            Route::get('/tasks/edit/{task}', 'GriffonTech\User\Http\Controllers\TasksController@edit')->defaults('_config', [
                'view' => 'user::user.tasks.edit'
            ])->name('user.tasks.edit');

            Route::post('/tasks/edit/{task}', 'GriffonTech\User\Http\Controllers\TasksController@update')->defaults('_config', [
                'redirect' => 'user.tasks.index'
            ])->name('user.tasks.update');

            Route::delete('/tasks/delete/{task}', 'GriffonTech\User\Http\Controllers\TasksController@destroy')->defaults('_config', [
                'redirect' => 'user.tasks.index'
            ])->name('user.tasks.delete');


            Route::get('/recurring-tasks/index', 'GriffonTech\User\Http\Controllers\RecurringTasksController@index')->defaults('_config', [
                'view' => 'user::user.recurring_tasks.index'
            ])->name('user.recurring_tasks.index');

            Route::get('/recurring-tasks/create', 'GriffonTech\User\Http\Controllers\RecurringTasksController@create')->defaults('_config', [
                'view' => 'user::user.recurring_tasks.create'
            ])->name('user.recurring_tasks.create');

            Route::post('/recurring-tasks/create', 'GriffonTech\User\Http\Controllers\RecurringTasksController@store')->defaults('_config', [
                'redirect' => 'user.recurring_tasks.index'
            ])->name('user.recurring_tasks.store');

            /** SMS Center */
            /*
            Route::get('/sms-center/index', 'GriffonTech\User\Http\Controllers\SMSCenterController@index')->defaults('_config', [
                'view' => 'user::user.sms-center.index'
            ])->name('user.sms-center.index');

            Route::get('/sms-center/create', 'GriffonTech\User\Http\Controllers\SMSCenterController@create')->defaults('_config', [
                'view' => 'user::user.sms-center.create'
            ])->name('user.sms-center.create');
            */



            /**
             * Amenities
             */
            /*
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
            */



            /*
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
            */


            /**
             * Property Unit Type
             */
            /*
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
            ])->name('user.property_unit_types.delete');*/


        });
    });
});

<?php

use Illuminate\Support\Facades\Route;


// Before Login Dashboard Routes
Route::group(['middleware' => 'guest:admin'], function () {
    $controller = 'AuthController@';
    // Route Login
    Route::get('login', $controller . 'view')->name('dashboard.login');
    Route::post('login', $controller . 'login');
});

// After Login Dashboard Routes
Route::group(['middleware' => ['auth:admin','BackHistory']], function () {
    // Route Logout
    Route::post('logout', 'AuthController@logout');

    // Route Home
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('home', 'HomeController@index')->name('dashboard/home');

    // Profile Route
    Route::group(['prefix' => 'profile/'], function () {
        $controller = 'ProfileController@';
        Route::get('/', $controller . 'index');
        Route::get('edit', $controller . 'edit');
        Route::post('update', $controller . 'update');
    });

    // Setting Route
    Route::group(['prefix' => 'setting'], function () {
        $controller = 'SettingController@';
        Route::get('/', $controller . 'index')->name('setting')->middleware('permission:read-settings');
        Route::post('/', $controller . 'update')->name('update-setting')->middleware('permission:update-settings');
    });

    // Icons Route
    Route::get('icons', 'IconsController@index')->name('icons');

    // Roles Route
    Route::group(['prefix' => 'roles'], function () {
        $controller = 'RolesController@';
        $route = 'dashboard.roles.';
        $permission = '-roles';
        Route::get('/', $controller . 'index')->name(substr($route, 0, -1))->middleware('permission:read' . $permission);
        Route::get('create', $controller . 'create')->name($route . 'create')->middleware('permission:create' . $permission);
        Route::post('store', $controller . 'store')->name($route . 'store')->middleware('permission:create' . $permission);
        Route::get('{id}/edit', $controller . 'edit')->name($route . 'edit')->middleware('permission:update' . $permission);
        Route::post('{id}/update', $controller . 'update')->name($route . 'update')->middleware('permission:update' . $permission);
        Route::post('{id}/delete', $controller . 'delete')->name($route . 'delete')->middleware('permission:delete' . $permission);
        Route::post('deletes', $controller . 'deletes')->name($route . 'deletes')->middleware('permission:delete' . $permission);
    });

    // Admins Route
    Route::group(['prefix' => 'admins'], function () {
        $controller = 'AdminsController@';
        $route = 'dashboard.admins.';
        $permission = '-admins';
        Route::get('/', $controller . 'index')->name(substr($route, 0, -1))->middleware('permission:read' . $permission);
        Route::get('create', $controller . 'create')->name($route . 'create')->middleware('permission:create' . $permission);
        Route::post('store', $controller . 'store')->name($route . 'store')->middleware('permission:create' . $permission);
        Route::get('{id}/edit', $controller . 'edit')->name($route . 'edit')->middleware('permission:update' . $permission);
        Route::post('{id}/update', $controller . 'update')->name($route . 'update')->middleware('permission:update' . $permission);
        Route::post('{id}/delete', $controller . 'delete')->name($route . 'delete')->middleware('permission:delete' . $permission);
        Route::post('deletes', $controller . 'deletes')->name($route . 'deletes')->middleware('permission:delete' . $permission);
    });

    // Admins Route
    Route::group(['prefix' => 'currency'], function () {
        $controller = 'CurrencyController@';
        $route = 'dashboard.currency.';
        $permission = '-currency';
        Route::get('/', $controller . 'index')->name(substr($route, 0, -1))->middleware('permission:read' . $permission);
        Route::get('create', $controller . 'create')->name($route . 'create')->middleware('permission:create' . $permission);
        Route::post('store', $controller . 'store')->name($route . 'store')->middleware('permission:create' . $permission);
        Route::get('{id}/edit', $controller . 'edit')->name($route . 'edit')->middleware('permission:update' . $permission);
        Route::post('{id}/update', $controller . 'update')->name($route . 'update')->middleware('permission:update' . $permission);
        Route::post('{id}/delete', $controller . 'delete')->name($route . 'delete')->middleware('permission:delete' . $permission);
        Route::post('deletes', $controller . 'deletes')->name($route . 'deletes')->middleware('permission:delete' . $permission);
    });

    // Admins Route
    Route::group(['prefix' => 'messages'], function () {
        $controller = 'MessagesController@';
        $route = 'dashboard.messages.';
        $permission = '-messages';
        Route::get('/', $controller . 'index')->name(substr($route, 0, -1))->middleware('permission:read' . $permission);
        Route::get('/{id}', $controller . 'show')->name($route . 'show')->middleware('permission:read' . $permission);
        Route::post('{id}/delete', $controller . 'delete')->name($route . 'delete')->middleware('permission:delete' . $permission);
        Route::post('deletes', $controller . 'deletes')->name($route . 'deletes')->middleware('permission:delete' . $permission);
    });

    // Admins Route
    Route::group(['prefix' => 'users'], function () {
        $controller = 'UsersController@';
        $route = 'dashboard.users.';
        $permission = '-users';
        Route::get('/', $controller . 'index')->name(substr($route, 0, -1))->middleware('permission:read' . $permission);
        Route::get('/{id}', $controller . 'show')->name($route . 'show')->middleware('permission:read' . $permission);
        Route::post('{id}/delete', $controller . 'delete')->name($route . 'delete')->middleware('permission:delete' . $permission);
        Route::post('deletes', $controller . 'deletes')->name($route . 'deletes')->middleware('permission:delete' . $permission);
    });

    // Packages
    Route::group(['prefix' => 'packages'],function () {
        $controller = 'PackagesController@';
        $route = 'dashboard.packages.';
        $permission = '-packages';
        Route::get('/', $controller . 'index')->name(substr($route, 0, -1))->middleware('permission:read' . $permission);
        Route::get('{id}', $controller . 'show')->name($route . 'show')->middleware('permission:read' . $permission);
        Route::post('{id}/status', $controller . 'status')->name($route . 'status')->middleware('permission:approve' . $permission);
        Route::post('{id}/delete', $controller . 'delete')->name($route . 'delete')->middleware('permission:delete' . $permission);
        Route::post('deletes', $controller . 'deletes')->name($route . 'deletes')->middleware('permission:delete' . $permission);
    });

    // Activities
    Route::group(['prefix' => 'packages/activities'],function () {
        $controller = 'ActivitiesController@';
        $route = 'dashboard.activities.';
        $permission = '-packages';
        Route::get('/{id}', $controller . 'index')->name(substr($route, 0, -1))->middleware('permission:read' . $permission);
        Route::get('show/{id}', $controller . 'show')->name($route . 'show')->middleware('permission:read' . $permission);
        Route::post('{id}/delete', $controller . 'delete')->name($route . 'delete')->middleware('permission:delete' . $permission);
        Route::post('deletes', $controller . 'deletes')->name($route . 'deletes')->middleware('permission:delete' . $permission);
    });

    // Links
    Route::group(['prefix' => 'packages/activities/links'],function () {
        $controller = 'LinksController@';
        $route = 'dashboard.links.';
        $permission = '-links';
        Route::get('/{id}', $controller . 'index')->name(substr($route, 0, -1))->middleware('permission:read' . $permission);
        Route::post('{id}/delete', $controller . 'delete')->name($route . 'delete')->middleware('permission:delete' . $permission);
        Route::post('deletes', $controller . 'deletes')->name($route . 'deletes')->middleware('permission:delete' . $permission);
    });

    // Ratings
    Route::group(['prefix' => 'ratings'],function () {
        $controller = 'RatingsController@';
        $route = 'dashboard.ratings.';
        $permission = '-rating';
        Route::get('/', $controller . 'index')->name(substr($route, 0, -1))->middleware('permission:read' . $permission);
        Route::get('show/{id}', $controller . 'show')->name($route . 'show')->middleware('permission:read' . $permission);
        Route::post('{id}/status', $controller . 'status')->name($route . 'status')->middleware('permission:approve' . $permission);
        Route::post('{id}/delete', $controller . 'delete')->name($route . 'delete')->middleware('permission:delete' . $permission);
        Route::post('deletes', $controller . 'deletes')->name($route . 'deletes')->middleware('permission:delete' . $permission);
    });

    // Country
    Route::group(['prefix' => 'country'],function () {
        $controller = 'CountryController@';
        $route = 'dashboard.country.';
        $permission = '-country';
        Route::get('/', $controller . 'index')->name(substr($route, 0, -1))->middleware('permission:read' . $permission);
        Route::get('create', $controller . 'create')->name($route . 'create')->middleware('permission:create' . $permission);
        Route::post('store', $controller . 'store')->name($route . 'store')->middleware('permission:create' . $permission);
        Route::get('{id}/edit', $controller . 'edit')->name($route . 'edit')->middleware('permission:update' . $permission);
        Route::post('{id}/update', $controller . 'update')->name($route . 'update')->middleware('permission:update' . $permission);
        Route::post('{id}/delete', $controller . 'delete')->name($route . 'delete')->middleware('permission:delete' . $permission);
        Route::post('deletes', $controller . 'deletes')->name($route . 'deletes')->middleware('permission:delete' . $permission);
        // Governorates
        Route::group(['prefix' => 'governorate'],function () {
            $controller = 'GovernorateController@';
            $route = 'dashboard.governorate.';
            $permission = '-country';
            Route::get('/{co}', $controller . 'index')->name(substr($route, 0, -1))->middleware('permission:read' . $permission);
            Route::get('create/{co}', $controller . 'create')->name($route . 'create')->middleware('permission:create' . $permission);
            Route::post('store/{co}', $controller . 'store')->name($route . 'store')->middleware('permission:create' . $permission);
            Route::get('{id}/edit', $controller . 'edit')->name($route . 'edit')->middleware('permission:update' . $permission);
            Route::post('{id}/update/{co}', $controller . 'update')->name($route . 'update')->middleware('permission:update' . $permission);
            Route::post('{id}/delete', $controller . 'delete')->name($route . 'delete')->middleware('permission:delete' . $permission);
            Route::post('deletes', $controller . 'deletes')->name($route . 'deletes')->middleware('permission:delete' . $permission);
        });
    });

    // Country
    Route::group(['prefix' => 'interests'],function () {
        $controller = 'InterestController@';
        $route = 'dashboard.interests.';
        $permission = '-interests';
        Route::get('/', $controller . 'index')->name(substr($route, 0, -1))->middleware('permission:read' . $permission);
        Route::get('create', $controller . 'create')->name($route . 'create')->middleware('permission:create' . $permission);
        Route::post('store', $controller . 'store')->name($route . 'store')->middleware('permission:create' . $permission);
        Route::get('{id}/edit', $controller . 'edit')->name($route . 'edit')->middleware('permission:update' . $permission);
        Route::post('{id}/update', $controller . 'update')->name($route . 'update')->middleware('permission:update' . $permission);
        Route::post('{id}/delete', $controller . 'delete')->name($route . 'delete')->middleware('permission:delete' . $permission);
        Route::post('deletes', $controller . 'deletes')->name($route . 'deletes')->middleware('permission:delete' . $permission);
    });
});

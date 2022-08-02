<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api','CheckPassword'],'namespace' => 'Api'],function(){
    $controller = 'AuthController@';
    Route::post('login',$controller . 'login');
    Route::post('register',$controller . 'register');
    Route::post('forgot-password',$controller . 'forgotPassword');
    Route::post('update-password',$controller . 'updatePassword');
    Route::post('logout',$controller . 'logout')->middleware(['CheckUserToken:user-api']);
    Route::post('delete_account',$controller . 'remove_account')->middleware(['CheckUserToken:user-api']);
    // Setting
    Route::group(['prefix' => 'setting'],function(){
        $controller = 'SettingController@';
        Route::post('/',$controller . 'index');
    });
    // Country
    Route::group(['prefix' => 'country'],function(){
        $controller = 'CountryController@';
        Route::post('/',$controller . 'index');
    });
    // Country
    Route::group(['prefix' => 'country'],function(){
        $controller = 'CountryController@';
        Route::post('/',$controller . 'index');
    });
    // Governorate
    Route::group(['prefix' => 'governorate'],function(){
        $controller = 'GovernorateController@';
        Route::post('/',$controller . 'index');
    });
    // Interest
    Route::group(['prefix' => 'interest'],function(){
        $controller = 'InterestController@';
        Route::post('/',$controller . 'index');
    });
});


Route::group(['middleware' => ['api','CheckPassword','CheckUserToken:user-api'],'namespace' => 'Api'],function(){
    // currency
    Route::group(['prefix' => 'currency'],function(){
        Route::post('/',CurrencyController::class);
    });
    // Profile
    Route::group(['prefix' => 'profile'],function(){
        $controller = 'ProfileController@';
        Route::post('/',$controller . 'index');
        Route::post('update',$controller . 'update');
    });
    // Contact Us
    Route::group(['prefix' => 'contact-us'],function(){
        Route::post('/',ContactUsController::class);
    });
    // Packages
    Route::group(['prefix' => 'packages'],function(){
        $controller = 'PackagesController@';
        Route::post('/',$controller . 'index');
        Route::post('search',$controller . 'search');
        Route::post('search/filter',$controller . 'searchFilter');
        Route::post('/show',$controller . 'show');
        Route::post('my-packages',$controller . 'my_packages');
        Route::post('store',$controller . 'store');
        Route::post('update',$controller . 'update');
        Route::post('delete/image',$controller . 'deletePackageImage');
        Route::post('interests',$controller . 'interest');
    });
    // Activity
    Route::group(['prefix' => 'activity'],function(){
        $controller = 'ActivitiesController@';
        Route::post('details',$controller . 'show');
        Route::post('store',$controller . 'store');
        Route::post('update',$controller . 'update');
        Route::post('delete',$controller . 'delete');
        Route::post('delete/image',$controller . 'deleteActivityImage');
    });
    // Links
    Route::group(['prefix' => 'links'],function(){
        $controller = 'LinksController@';
        Route::post('store',$controller . 'store');
        Route::post('update',$controller . 'update');
        Route::post('delete',$controller . 'delete');
    });
    // Links
    Route::group(['prefix' => 'interests'],function(){
        $controller = 'TagsPackagesController@';
        Route::post('delete',$controller . 'delete');
    });
    // Ratings
    Route::group(['prefix' => 'rating'],function(){
        $controller = 'RatingsController@';
        Route::post('store',$controller . 'store');
        Route::post('show',$controller . 'show');
    });
    // Favorite
    Route::group(['prefix' => 'favorite'],function(){
        $controller = 'FavoriteController@';
        Route::post('/',$controller . 'index');
        Route::post('store',$controller . 'store');
        Route::post('delete',$controller . 'delete');
    });
    // Favorite List
    Route::group(['prefix' => 'favorite-list'],function(){
        $controller = 'FavoriteListController@';
        Route::post('/',$controller . 'index');
        Route::post('store',$controller . 'store');
        Route::post('delete',$controller . 'delete');
    });
});

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => ['siravel-analytics']], function () {
    $s = 'public.';
    Route::get('/',         ['as' => $s . 'home',   'uses' => 'PagesController@getHome']);

});

$s = 'social.';
Route::get('/social/redirect/{provider}',   ['as' => $s . 'redirect',   'uses' => 'Auth\SocialController@getSocialRedirect']);
Route::get('/social/handle/{provider}',     ['as' => $s . 'handle',     'uses' => 'Auth\SocialController@getSocialHandle']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth:administrator'], function()
{
    $a = 'admin.';
    Route::get('/', ['as' => $a . 'home', 'uses' => 'Admin\AppController@dashboard']);
    
    Route::resource('users', 'Admin\UserController');
    Route::resource('permissions', 'Admin\PermissionController');
    Route::resource('roles', 'Admin\RoleController');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:user'], function()
{
    $a = 'user.';
    Route::get('/', ['as' => $a . 'home', 'uses' => 'UserController@getHome']);

    Route::group(['middleware' => 'activated'], function ()
    {
        $m = 'activated.';
        Route::get('protected', ['as' => $m . 'protected', 'uses' => 'UserController@getProtected']);
    });

});

Route::group(['middleware' => 'auth:all'], function()
{
    $a = 'authenticated.';
    Route::get('/logout', ['as' => $a . 'logout', 'uses' => 'Auth\LoginController@logout']);
    Route::get('/activate/{token}', ['as' => $a . 'activate', 'uses' => 'ActivateController@activate']);
    Route::get('/activate', ['as' => $a . 'activation-resend', 'uses' => 'ActivateController@resend']);
    Route::get('not-activated', ['as' => 'not-activated', 'uses' => function () {
        return view('errors.not-activated');
    }]);
});


Auth::routes(['login' => 'auth.login']);




/*
|--------------------------------------------------------------------------
| Set Language
|--------------------------------------------------------------------------
*/

Route::get('sitec/language/set/{language}', 'SiravelFeatureController@setLanguage');

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('public-preview/{encFileName}', 'AssetController@asPreview');
Route::get('public-asset/{encFileName}', 'AssetController@asPublic');
Route::get('public-download/{encFileName}/{encRealFileName}', 'AssetController@asDownload');

Route::group(['prefix' => 'sitec'], function () {
    Route::get('asset/{path}/{contentType}', 'AssetController@asset');
});



/*

=========================================================================================================
=========================================================================================================
=========================================================================================================
=========================================================================================================
=========================================================================================================
=========================================================================================================

                                   O QUE VEM ABAIXO JÀ ESTAVA NO MODULO

=========================================================================================================
=========================================================================================================
=========================================================================================================
=========================================================================================================
=========================================================================================================
=========================================================================================================
=========================================================================================================
=========================================================================================================
*/



Route::group(['middleware' => 'web'], function () {
    Route::get('siravel', 'SiravelFeatureController@sendHome');

    /*
    |--------------------------------------------------------------------------
    | Set Language
    |--------------------------------------------------------------------------
    */

    Route::get('siravel/language/set/{language}', 'SiravelFeatureController@setLanguage');

    /*
    |--------------------------------------------------------------------------
    | Public Routes
    |--------------------------------------------------------------------------
    */

    Route::get('public-preview/{encFileName}', 'AssetController@asPreview');
    Route::get('public-asset/{encFileName}', 'AssetController@asPublic');
    Route::get('public-download/{encFileName}/{encRealFileName}', 'AssetController@asDownload');

    /*
    |--------------------------------------------------------------------------
    | APIs
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'siravel/api'], function () {
        Route::get('images/list', 'ImagesController@apiList');
        Route::post('images/store', 'ImagesController@apiStore');
        Route::get('files/list', 'FilesController@apiList');

        Route::group(['middleware' => ['siravel-api']], function () {
            Route::get('blog', 'ApiController@all');
            Route::get('blog/{id}', 'ApiController@find');

            Route::get('events', 'ApiController@all');
            Route::get('events/{id}', 'ApiController@find');

            Route::get('faqs', 'ApiController@all');
            Route::get('faqs/{id}', 'ApiController@find');

            Route::get('files', 'ApiController@all');
            Route::get('files/{id}', 'ApiController@find');

            Route::get('images', 'ApiController@all');
            Route::get('images/{id}', 'ApiController@find');

            Route::get('pages', 'ApiController@all');
            Route::get('pages/{id}', 'ApiController@find');

            Route::get('widgets', 'ApiController@all');
            Route::get('widgets/{id}', 'ApiController@find');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Siravel
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'siravel'], function () {
        Route::get('asset/{path}/{contentType}', 'AssetController@asset');

        Route::group(['middleware' => ['auth', 'siravel']], function () {
            Route::get('dashboard', 'DashboardController@main');

            /*
            |--------------------------------------------------------------------------
            | Common Features
            |--------------------------------------------------------------------------
            */

            Route::get('preview/{entity}/{entityId}', 'SiravelFeatureController@preview');
            Route::get('rollback/{entity}/{entityId}', 'SiravelFeatureController@rollback');
            Route::get('revert/{id}', 'SiravelFeatureController@revert');


            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */

            Route::resource('images', 'ImagesController', ['as' => 'siravel', 'except' => ['show']]);
            Route::post('images/search', 'ImagesController@search');
            Route::post('images/upload', 'ImagesController@upload');

            /*
            |--------------------------------------------------------------------------
            | Blog
            |--------------------------------------------------------------------------
            */

            Route::resource('blog', 'BlogController', ['as' => 'siravel', 'except' => ['show']]);
            Route::post('blog/search', 'BlogController@search');
            Route::get('blog/{id}/history', 'BlogController@history');


            /*
            |--------------------------------------------------------------------------
            | Events
            |--------------------------------------------------------------------------
            */

            Route::resource('events', 'EventController', ['as' => 'siravel', 'except' => ['show']]);
            Route::post('events/search', 'EventController@search');
            Route::get('events/{id}/history', 'EventController@history');

            /*
            |--------------------------------------------------------------------------
            | Files
            |--------------------------------------------------------------------------
            */

            Route::get('files/remove/{id}', 'FilesController@remove');
            Route::post('files/upload', 'FilesController@upload');
            Route::post('files/search', 'FilesController@search');

            Route::resource('files', 'FilesController', ['as' => 'siravel', 'except' => ['show']]);
        });
    });
});

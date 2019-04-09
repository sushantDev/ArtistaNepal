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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Logging In/Out Routes
|--------------------------------------------------------------------------
*/
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');

/*
|--------------------------------------------------------------------------
| Password reset link request routes
|--------------------------------------------------------------------------
*/
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

/*
|--------------------------------------------------------------------------
| Password reset routes
|--------------------------------------------------------------------------
*/
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');

Route::get('under-construction', function () {
    return view('errors.under-construction');
});


Route::group([ 'middleware' => 'auth', 'prefix' => 'admin' ], function () {
    Route::get('/admin', function () {
        return redirect('/post');
    });

    Route::get('home', 'HomeController@index')->name('admin.home');

    /*
    |--------------------------------------------------------------------------
    | Settings Routes
    |--------------------------------------------------------------------------
    */
    Route::get('settings', 'SettingController@index')->name('setting.index');
    Route::put('settings/update', 'SettingController@update')->name('setting.update');

    /*
    |--------------------------------------------------------------------------
    | Event
    |--------------------------------------------------------------------------
    */
    Route::group([ 'middleware' => [ 'role:admin|artist|organiser' ], 'prefix' => 'event', 'as' => 'event.' ], function () {
        Route::get('', 'EventController@index')->name('index');
        Route::get('create', 'EventController@create')->name('create');
        Route::post('', 'EventController@store')->name('store');
        Route::get('{event}/edit', 'EventController@edit')->name('edit');
        Route::put('{event}', 'EventController@update')->name('update');
        Route::delete('{event}', 'EventController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */
    Route::group([ 'middleware' => [ 'role:admin|artist|organiser|user' ], 'prefix' => 'user', 'as' => 'user.' ], function () {
        Route::get('', 'UserController@index')->name('index');
        Route::get('create', 'UserController@create')->name('create');
        Route::get('{user}/follow', 'UserController@follow')->name('follow');
        Route::get('{user}/un-follow', 'UserController@unFollow')->name('un-follow');
        Route::get('notify', 'UserController@notify')->name('notify');
        Route::post('', 'UserController@store')->name('store');
        Route::get('{user}', 'UserController@show')->name('show');
        Route::get('{user}/contact', 'UserController@contact')->name('contact');
        Route::get('{user}/edit', 'UserController@edit')->name('edit');
        Route::put('{user}', 'UserController@update')->name('update');
        Route::delete('{user}', 'UserController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Post
    |--------------------------------------------------------------------------
    */
    Route::group([ 'middleware' => [ 'role:admin|artist|organiser' ] ], function () {
        Route::get('post', 'PostController@index')->name('post.index');
        Route::get('post/create', 'PostController@create')->name('post.create');
        Route::post('post', 'PostController@store')->name('post.store');
        Route::get('{post}', 'PostController@show')->name('post.show');
        Route::get('post/{post}/edit', 'PostController@edit')->name('post.edit');
        Route::put('post/{post}', 'PostController@update')->name('post.update');
        Route::delete('post/{post}', 'PostController@destroy')->name('post.destroy');
    });
});
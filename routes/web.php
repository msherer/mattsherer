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


/**
 *  Post Routes
 */
Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts/{post}', 'PostsController@show');


/**
 * Comment Routes
 */
Route::post('/posts/{post}/comments', 'CommentsController@store');


/**
 * Task Routes
 */
Route::get('/tasks', 'TasksController@index');
Route::get('/tasks/{task}', 'TasksController@show');


/**
 * Static Page Routes
 */
Route::get('/about', function () {
    return view('about');
});


/**
 * Contact Routes
 */
Route::get('/contact', 'ContactsController@create');
Route::post('/contact', 'ContactsController@store');

/**
 * Authentication Routes
 */
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');
Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

/**
 * Error Routes
 */
Route::get('/error', function() {
    return view('errors.401');
});


/**
 * Admin Routes
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

    /**
     * Home Dashboard Route
     */
    Route::get('/', 'DashboardController@index');

    /**
     * Users Routes
     */
    Route::resource('/users', 'UsersController');

    /**
     * Permissions Routes
     */
    Route::resource('/permissions', 'PermissionsController');

    /**
     * Roles Routes
     */
    Route::resource('/roles', 'RolesController');

    /**
     * Login Routes
     */
    Route::get('/login', [ 'as' => 'login', 'uses' => 'SessionsController@create']);
    Route::post('/login', [ 'as' => 'login', 'uses' => 'SessionsController@store']);
    Route::post('/logout', [ 'as' => 'logout', 'uses' => 'SessionsController@destroy']);

    /**
     * Post Routes
     */
    Route::resource('/posts', 'PostsController');

    /**
     * Invoice Routes
     */
    Route::get('/invoice/nes', 'InvoiceController@nes');
    Route::get('/invoice/test', 'InvoiceController@test');
    Route::resource('/invoice', 'InvoiceController');

    /**
     * Spotify Routes
     */
    Route::post('/spotify/callback', 'Spotify\ConfigController@callback');
    Route::resource('/spotify', 'Spotify\ConfigController');

    /**
     * Video Games / Collection Routes
     */
    Route::resource('/videogames', 'VideoGamesController');
});
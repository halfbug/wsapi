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
    return view('frontend.welcome');
});
Route::get('/about', function () {
    return view('frontend.about');
});
Route::get('/services', function () {
    return view('frontend.services');
});
Route::get('/pricing', function () {
    return view('frontend.pricetable');
});
Route::get('/contact', function () {
    return view('frontend.contact');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/file/list', 'FileController@index')->name('fileList');
Route::get('/file/create', 'FileController@create')->middleware('auth');
Route::post('/file/create', 'FileController@store')->middleware('auth');
Route::get('/file/format', 'FileController@format')->middleware('auth');
Route::get('/meta/create', 'FileController@meta')->middleware('auth');

Route::group(['prefix' => 'profile','middleware' => 'auth'], function () {
    Route::get('/', 'ProfileController@index');
    Route::post('/','ProfileController@store');
    Route::put('/update/{user_id}','ProfileController@update');
    Route::get('/edit/{user_id}','ProfileController@edit');
    Route::get('/{user_id}','ProfileController@show');
    Route::delete('{user_id}','ProfileController@destroy');
    Route::get('/linked_clients/{user_id}','ProfileController@showLinkedClients');
});

Route::group(['prefix' => 'users','middleware' => 'auth'], function () {
    Route::get('/', 'UserController@index')->name('users');
    Route::post('/create','UserController@store');
    Route::put('/update/{user_id}','UserController@update');
    //Route::get('/{user_id}','UserController@show');
    Route::get('/edit/{user_id}','UserController@edit');
    Route::delete('/{user_id}/{user_role}','UserController@destroy');
    Route::get('/filter/{user_role}','UserController@filtergrid');
    Route::get('/create/{role}','UserController@create');
});

Route::group(['prefix' => 'packages','middleware' => 'auth'], function () {
Route::get('/', 'PackageController@index')->name('packageslist');
Route::get('/add', 'PackageController@create')->middleware('auth');
Route::post('/add', 'PackageController@store')->middleware('auth');
});

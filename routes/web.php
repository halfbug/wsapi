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

Route::group(['prefix' => 'file','middleware' => 'auth'], function () {
    Route::get('/list/{status?}', 'FileController@index')->name('fileList');
    Route::get('/create', 'FileController@create');
    Route::post('/create', 'FileController@store');
    Route::get('/format', 'FileController@format');
    Route::get('/meta/create', 'FileController@meta');
    Route::get('/startprocessing/{file_id}', 'FileController@startprocessing');
    Route::get('/download/{file_id}', 'FileController@downloadfile');
    Route::post('/search', 'FileController@search');
});

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
Route::get('/add', 'PackageController@create');
Route::get('/edit/{package_id}', 'PackageController@edit');
Route::post('/edit/{package_id}', 'PackageController@update');
Route::post('/add', 'PackageController@store');
Route::get('/assign', 'PackageController@assign');
Route::post('/assign', 'PackageController@assignpackage');
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/', 'ApiController@index');
   
});

Route::group(['prefix' => 'analytics','middleware' => 'auth'], function () {
    Route::get('/', 'AnalyticController@index');
   
});
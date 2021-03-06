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
Route::get('/pricing', 'PackageController@pricetable');
Route::post('/pricing', 'PackageController@pricetablesignup');

Route::get('/contact', 'ContactController@create')->name('contact');
Route::post('/contact', 'ContactController@store');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware("auth");
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware("auth");

Route::get('/file/create', 'FileController@create');
Route::post('/file/create', 'FileController@store');
Route::delete('file/destroy/{id}','FileController@destroy');
Route::get('/file/startdownloading/{file_id}', 'FileController@startdownloading');
Route::get('/file/download/{file_id}', 'FileController@downloadfile');

Route::group(['prefix' => 'file','middleware' => 'auth'], function () {
    Route::get('/list/{status?}', 'FileController@index')->name('fileList');
    Route::get('/format', 'FileController@format');
    Route::get('/meta/create', 'FileController@meta');
    Route::post('/meta/create', 'FileController@storemeta');
    Route::post('/filemeta', 'FileController@storeFileMeta');
    Route::get('/startprocessing/{file_id}', 'FileController@startprocessing');
    Route::post('/search', 'FileController@search');
    Route::get('/{file_id}', 'FileController@show');
    Route::post('/{file_id}', 'FileController@uploadprocessed');
    Route::delete('/delete/{file_id}', 'FileController@delete');
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
Route::get('api-manager/', 'HomeController@apiManager');
Route::get('api-manager/clients', 'HomeController@clients')->middleware('auth');

Route::group(['prefix' => 'api', 'middleware' =>'auth:api'], function () {


    Route::get('/files/{user_id?}', 'ApiController@files');
    Route::post('/upload_file', 'ApiController@uploadFile');
    Route::get('/file_info/{file_id}', 'ApiController@fileInfo');
    Route::get('/download_file', 'ApiController@downloadFile');



});

Route::group(['prefix' => 'analysis','middleware' => 'auth'], function () {
    Route::get('/', 'AnalyticController@index');
    Route::get('/totalfiles/{action?}', 'AnalyticController@totalfiles');
    Route::get('/averagetime', 'AnalyticController@averagetime');
    Route::get('/last31upload', 'AnalyticController@last31upload');
    Route::get('/uploadfile', 'AnalyticController@uploadfile');
   
});
Route::get('setting/index_listing', 'SettingController@index_listing');
Route::resource('setting', 'SettingController');


Route::get('paywithpaypal/{package_id?}/{user_id?}', array('as' => 'subscribe.paywithpaypal','uses' => 'SubscribeController@payWithPaypal',))->middleware('auth');
Route::post('paypal', array('as' => 'subscribe.paypal','uses' => 'SubscribeController@postPaymentWithpaypal',))->middleware('auth');
Route::get('paypal', array('as' => 'payment.status','uses' => 'SubscribeController@getPaymentStatus',))->middleware('auth');

Route::get('/markAsRead', function(){
    Auth::user()->unreadNotifications->markAsRead();
});
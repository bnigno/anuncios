<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect(URL('/anuncios'));
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::controllers([
	'admin/city' => 'CityController',
	'admin/elements' => 'websiteElementsController',
	'admin/priority' => 'PriorityController',
	'admin/partner' => 'PartnerController',
	'admin/photo' => 'PhotoController',
	'upload' => 'ImageController',
	'admin/ads' => 'AdsController',
	'video' => 'VideoController',
	'anuncios' => 'VisitorController',
	]);
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('admin/home', 'HomeController@index');
});

Route::get('img/{path}', function (League\Glide\Server $server, $path){
	$server->outputImage($path, $_GET);
});

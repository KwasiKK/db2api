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
    return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'app'], function () {
	Route::get('home', 'HomeController@index')->name('home');
	//Route::get('template/{name}', 'TemplatesController@show_template');
	
	Route::get('create', 'KreeController@demo_new_project');
});


Route::group(['middleware' => 'auth'], function()
{
	Route::get('new_project/{demo?}', 'KreeController@new_project');
	Route::post('create_project', 'ProjectController@store');
	Route::post('create_project_in_db', 'ProjectController@create_project_in_db');
	Route::get('project/view/{id}', 'ProjectController@view_project');
	Route::get('export/laravel/{id}', 'KreeController@export_laravel');
	Route::post('export/laravel/{id}', 'KreeController@export_laravel_post');
	Route::get('download/project/{id}', 'KreeController@download_project');
	Route::resource('project', 'ProjectController');
	Route::resource('table', 'TableController');
});

// Route::post('specify_website_type', 'ProjectController@specify_website_type');
// Route::post('create_database', 'ProjectController@create_database');
// Route::post('create_registration_fields', 'ProjectController@create_registration_fields');
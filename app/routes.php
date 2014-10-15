<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'HomeController@index'), array('tag' => 'Laravel'));

Route::get('/angular', array('uses' => 'HomeController@home_angular'));

Route::get('/get_results', array('uses' => 'MashtagController@get_results'));

Route::get('/search', 'HomeController@index', array('tag' => 'Laravel'));
Route::get('/search/{tag}', 'HomeController@index');

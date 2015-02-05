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
$alphanum = '[a-zA-Z0-9]+';
$id = '[0-9]+';
Route::get('delete/annonce/{id}', 'AnnoncesController@getDelete')->where('id', $id);
Route::get('view/{id}', 'AnnoncesController@getView')->where('id', $id);
Route::resource('annonce', 'AnnoncesController');
Route::get('/', array('uses' => 'IndexController@showIndex'));
Route::post('search', array('uses' => 'IndexController@searchAds'));
Route::controller('users', 'UsersController');
Route::get('inscription', array('uses' => 'UsersController@getRegister', 'as' => 'inscription'));
Route::get('inscription/confirm/{confirmation_code}', array('uses' => 'UsersController@confirm', 'as' => 'confirm'))->where('confirmation_code', $alphanum);
Route::get('login', array('uses' => 'UsersController@getLogin', 'as' => 'login'));

Route::group(['before' => 'auth'], function(){
    $id = '[0-9]+';
    Route::get('edit/{id}', array('uses' => 'UsersController@getEdit', 'as' => 'edit'))->where('id', $id);
    Route::post('edit/{id}', 'UsersController@postEdit')->where('id', $id);
    Route::get('delete/{id}', 'UsersController@getDelete')->where('id', $id);
    Route::get('account', array('uses' => 'UsersController@showAccount'));
});
Route::resource('utilisateur', 'UsersController');
Route::resource('messages', 'MessagesController');
Route::get('ads', function(){
	$ads = Ads::all();
	return View::make('ads.index')->with('ads', $ads);
});
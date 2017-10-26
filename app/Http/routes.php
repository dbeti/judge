<?php

/* Homepage */
use GoodlerJudge\TestCase;

Route::get('/', 'HomePageController@index');

/* Solution queue */
Route::get('queue', 'QueueController@index');

/* Contact page */
Route::get('contact',
	['as' => 'contact', 'uses' => 'ContactController@index']);
Route::post('contact',
	['as' => 'contact_store', 'uses' => 'ContactController@store']);

/* FAQ */
Route::get('faq', 'FaqController@index');

/* About */
Route::get('about', 'AboutController@index');

/* User registration */
Route::controller('auth', 'Auth\AuthController');
Route::controller('password', 'Auth\PasswordController');

/* Problems */
Route::resource('problem','ProblemController');

/* Solutions */
Route::resource('problem.solution', 'ProblemSolutionController', [
	'except' => ['edit', 'update', 'destroy']
]);

/* User problem solutions */
Route::resource('problem.user.solution', 'ProblemUserSolutionController', [
	'only' => ['index']
]);

/* User profiles */
Route::resource('user', 'UserController', [
	'except' => ['create', 'store', 'destroy']
]);

/* Checker upload */
Route::get('checker','CheckerController@create');

Route::post('checker','CheckerController@store');

/* Groups */
Route::resource('group', 'GroupController');

/* Tests */
Route::resource('problem.test', 'ProblemTestController', [
	'except' => ['show','edit','update']
]);

/* Download tests */
Route::get('problem/{problem}/test/{test}/download/{id}',
	       'ProblemTestController@download');

<?php

Route::get('/', "TestController@index");
Route::get('/json_to', "TestController@json_sender");
Route::get('/income-api', "TestController@incomeApi");
Route::get('/slack-test', "TestController@slack_curl");



Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');
Route::get('/botman/chat', 'BotManController@chat');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

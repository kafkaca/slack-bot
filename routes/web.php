<?php

Route::get('/', function (Request $request) {
    return view('welcome');
});

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');
Route::get('/botman/chat', 'BotManController@chat');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

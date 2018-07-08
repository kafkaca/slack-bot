<?php

use Illuminate\Http\Request;


Route::get('/demo-import', function (Request $request) {
    echo config('database.default');
    if (config('database.default') == 'mysql' && DB::connection()->getDatabaseName() == 'demoimport2') {
       // echo "connected successfully to database " . DB::connection()->getDatabaseName();
        DB::unprepared(file_get_contents(database_path('database.sql')));
    }

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('employee', 'API\EmployeeController@carbon');
Route::post('login', 'API\PassportController@login');
Route::post('register', 'API\PassportController@register');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('get-details', 'API\PassportController@getDetails');
});

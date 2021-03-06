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

Route::get('/', function (Illuminate\Http\Request $request) {

	// dispatch(new App\Jobs\LogSomething);

    // return view('welcome');
    
    Mail::to($request->user())->queue(new App\Mail\UserRegistration);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/settings', 'UserSettingsController@edit');
Route::put('/user/settings', 'UserSettingsController@update');
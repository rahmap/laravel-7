<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->middleware('auth')->name('root');
Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');
Route::delete('/delete/{id}', 'HomeController@destroy')->middleware('auth');
Route::get('/edit/{id}', 'HomeController@edit')->middleware('auth');
Route::put('/update/{id}', 'HomeController@update')->middleware('auth');
Route::get('/users', 'HomeController@users')->middleware('auth');
Route::get('/users/vue', 'HomeController@users_vue')->middleware('auth');

Route::group(['prefix' => 'auth'], function () {
    Route::get('/', function () {
        return redirect()->route('sign-in');
    });
    Route::get('/sign-up', 'AuthController@register')->middleware('guest')->name('sign-up');
    Route::post('/sign-up', 'AuthController@registerPostAction')->middleware('guest')->name('sign-up-post');

    Route::get('/sign-in', 'AuthController@login')->middleware('guest')->name('login');
    Route::post('/sign-in', 'AuthController@loginPostAction')->middleware('guest')->name('sign-in-post');

    Route::get('/log-out', 'AuthController@logout')->middleware('auth')->name('log-out');
});

Route::resource('product','ProductController')->middleware('auth');

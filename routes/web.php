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

/**
 * USER
 */
Route::delete('/delete/{id}', 'HomeController@destroy')->middleware('admin');
Route::get('/edit/{id}', 'HomeController@edit')->middleware('admin');
Route::put('/update/{id}', 'HomeController@update')->middleware('admin');
Route::get('/users', 'HomeController@users')->middleware('admin')->name('user_list');
Route::get('/users/vue', 'HomeController@users_vue')->middleware('admin');
/**
 * END USER
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return redirect()->route('sign-in-admin');
    })->middleware('admin_guest');
    Route::get('/logout', 'AdminController@logout')->middleware('admin')->name('log-out-admin');

    Route::group(['middleware' => 'admin_guest'], function (){
        Route::get('/login', 'AdminController@login')->name('sign-in-admin');
        Route::post('/login', 'AdminController@loginPostAction')->name('sign-in-admin-post');
        Route::get('/register', 'AdminController@register')->name('sign-up-admin');
        Route::post('/register', 'AdminController@registerPostAction')->name('sign-up-admin-post');
    });

});

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

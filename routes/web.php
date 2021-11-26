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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('login.admin');
    Route::get('/login/organizer', 'Auth\LoginController@showOrganizerLoginForm')->name('login.organizer');
    Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('register.admin');
    Route::get('/register/organizer', 'Auth\RegisterController@showOrganizerRegisterForm')->name('register.organizer');

    Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('login.admin');
    Route::post('/login/organizer', 'Auth\LoginController@organizerLogin')->name('login.organizer');
    Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('register.admin');
    Route::post('/register/organizer', 'Auth\RegisterController@createOrganizer')->name('register.organizer');

    Route::view('/home', 'home')->middleware('auth:web');
    Route::view('/admin', 'admin')->middleware('auth:admin');
    Route::view('/organizer', 'organizer')->middleware('auth:organizer');

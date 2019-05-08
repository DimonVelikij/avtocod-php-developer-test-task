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

Route::get('/', 'Messenger\MessageController@listMessages')
    ->name('home');

Route::get('/home', 'Messenger\MessageController@listMessages')
    ->name('home');

Route::post('/add-message', 'Messenger\MessageController@addMessage')
    ->name('add-message');

Route::post('/delete-message/{id}', 'Messenger\MessageController@deleteMessage')
    ->name('delete-message')
    ->where('id', '[0-9]+');

Route::get('/login', 'Auth\LoginController@showLoginForm')
    ->name('login');

Route::post('/login-submit', 'Auth\LoginController@login')
    ->name('login-submit');

Route::post('/logout', 'Auth\LoginController@logout')
    ->name('logout');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')
    ->name('register');

Route::post('/register-submit', 'Auth\RegisterController@register')
    ->name('register-submit');

Route::get('/register-success', function () {
    return view('auth.register-success');
})->name('register-success');

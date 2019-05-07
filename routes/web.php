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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/auth', function () {
    return view('auth');
})->name('auth');

Route::get('/reg', function () {
    return view('reg');
})->name('reg');

Route::get('/reg_success', function () {
    return view('reg_success');
})->name('reg_success');

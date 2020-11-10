<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));
Route::get('/home', fn() => view('home'));
Route::get('/login', fn() => redirect('/home'));
Route::get('/register', fn() => redirect('/home'));
Route::post('/logout', fn() => redirect('/'));

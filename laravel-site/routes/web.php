<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::view('/catalog', 'pages.catalog');
Route::view('/about', 'pages.about');
Route::view('/contact', 'pages.contact');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteRequestController;

Route::get('/', function () {
    return view('pages.home');
});

Route::view('/catalog', 'pages.catalog');
Route::view('/about', 'pages.about');
Route::view('/contact', 'pages.contact');

Route::post('/quote-requests', [QuoteRequestController::class, 'store'])->name('quote-requests.store');

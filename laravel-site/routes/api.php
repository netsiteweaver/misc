<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SiteSettingsController;
use App\Http\Controllers\Api\QuoteRequestController;

Route::get('/categories', [CategoryController::class, 'index'])->name('api.categories.index');
Route::get('/site-settings', [SiteSettingsController::class, 'show'])->name('api.site-settings.show');
Route::post('/quote-requests', [QuoteRequestController::class, 'store'])->name('api.quote-requests.store');


<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Add this line!

// Static Pages
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::resource('features', \App\Http\Controllers\FeatureController::class);

// Auth Routes
Auth::routes();

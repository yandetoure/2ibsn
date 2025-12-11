<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/a-propos', function () {
    return view('about');
})->name('about');

Route::get('/programmes', function () {
    return view('programs');
})->name('programs');

Route::get('/admissions', function () {
    return view('admissions');
})->name('admissions');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

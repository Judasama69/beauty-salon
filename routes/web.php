<?php

use App\Http\Controllers\GreetingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GreetingController::class, 'index'])->name('home');

Route::get('/services', function () {
    // TODO: Create a view for services
    return 'Services page';
})->name('services.index');

use App\Http\Controllers\ServiceController;

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

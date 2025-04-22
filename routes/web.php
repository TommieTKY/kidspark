<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ConsoleController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    die('test');
    return Inertia::render('welcome');
})->name('home')->middleware('auth');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('/console/dashboard', [ConsoleController::class, 'dashboard'])->middleware('auth');
Route::get('/console/login', [ConsoleController::class, 'loginForm'])->middleware('guest');
Route::post('/console/login', [ConsoleController::class, 'login'])->middleware('guest');
Route::get('/console/logout', [ConsoleController::class, 'logout'])->middleware('auth');

Route::resource('/console/programs', ProgramController::class)->middleware('auth');
Route::resource('/console/instructors', InstructorController::class)->middleware('auth');

Route::get('/console/users', function () {
   die('hello!');
});

Route::resource('/console/users', RegisteredUserController::class)->middleware('auth');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

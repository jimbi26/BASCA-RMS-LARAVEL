<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeniorController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

//Senior Records
Route::get('/dashboard', [SeniorController::class, 'index'])
    ->name('dashboard');

// Senior Records & Search
Route::get('/seniors', [SeniorController::class, 'seniors'])
    ->name('seniors.senior-records');


// Authentication //Login
Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout']);


// CREATE AND ADD SENIOR
Route::get('/add-senior', function () {
    return view('components.add-senior');
})->name('seniors.create');

Route::post('/senior', [SeniorController::class, 'store'])
    ->name('seniors.store');

//SEARCH GLOBALLY
Route::get('/senior-records/search', [SeniorController::class, 'search'])
    ->name('seniors.search');

// VIEW SENIOR
Route::get('/senior/{senior_id}', [SeniorController::class, 'show'])
    ->name('seniors.show');

// EDIT SENIOR
Route::get('/senior/{senior_id}/edit', [SeniorController::class, 'edit'])
    ->name('seniors.edit');

// UPDATE SENIOR
Route::put('/senior/{senior_id}', [SeniorController::class, 'update'])
    ->name('seniors.update');

// DELETE SPECIFIC SENIOR
Route::delete('/senior/{id}', [SeniorController::class, 'destroy'])
    ->name('seniors.destroy');
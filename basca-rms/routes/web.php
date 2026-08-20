<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeniorController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [SeniorController::class, 'index'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Senior Records
|--------------------------------------------------------------------------
*/

Route::get('/seniors', [SeniorController::class, 'seniors'])
    ->name('seniors.senior-records');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);


/*
|--------------------------------------------------------------------------
| Create Senior
|--------------------------------------------------------------------------
*/

Route::get('/add-senior', function () {
    return view('components.add-senior');
})->name('seniors.create');

Route::post('/senior', [SeniorController::class, 'store'])
    ->name('seniors.store');


/*
|--------------------------------------------------------------------------
| Global Senior Search
|--------------------------------------------------------------------------
*/

Route::get('/senior-records/search', [SeniorController::class, 'search'])
    ->name('seniors.search');


/*
|--------------------------------------------------------------------------
| View Senior
|--------------------------------------------------------------------------
*/

Route::get('/senior/{senior_id}', [SeniorController::class, 'show'])
    ->name('seniors.show');



/*
|--------------------------------------------------------------------------
| Edit Senior
|--------------------------------------------------------------------------
*/

Route::get('/senior/{senior_id}/edit', [SeniorController::class, 'edit'])
    ->name('seniors.edit');


/*
|--------------------------------------------------------------------------
| Update Senior
|--------------------------------------------------------------------------
*/

Route::put('/senior/{senior_id}', [SeniorController::class, 'update'])
    ->name('seniors.update');


/*
|--------------------------------------------------------------------------
| Delete Senior
|--------------------------------------------------------------------------
*/

Route::delete('/senior/{senior_id}', [SeniorController::class, 'destroy'])
    ->name('seniors.destroy');


/*
|--------------------------------------------------------------------------
| Print Photo (A4)
|--------------------------------------------------------------------------
*/

Route::get('/print/photo', [SeniorController::class, 'printPhoto'])
    ->name('seniors.print-photo');


/*
|--------------------------------------------------------------------------
| Delete Document Attachment
|--------------------------------------------------------------------------
*/

Route::delete('/senior/{senior_id}/document/{field}', [SeniorController::class, 'destroyDocument'])
    ->whereIn('field', ['photo', 'senior_id_image', 'psa', 'ncsc_form'])
    ->name('seniors.document.destroy');
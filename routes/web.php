<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/about', function () {
    return view('about');
})->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register.index');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('login.index');

Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('login.destroy');

Route::controller(App\Http\Controllers\PersonalController::class)->group(function () {
    Route::get('/personal', 'index')->middleware('auth');
    Route::get('/personal/create', 'create')->middleware('auth');
    Route::post('/personalstore', 'store')->middleware('auth');
    Route::get('/personaledit/{personal}/edit', 'edit')->middleware('auth');
    Route::put('/personalupdate/{personal}', 'update')->middleware('auth');
    Route::delete('/personaldelete/{personal}/delete', 'destroy')->middleware('auth');
    Route::get('/cvats/{personal}/lihat', 'cvats')->middleware('auth');
    Route::get('/ats/{personal}/lihat', 'ats')->middleware('auth');
});
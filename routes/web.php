<?php

use App\Http\Controllers\AkunController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FilmController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'dashboard/admin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [HomeController::class, 'profile'])->name('profile');
        Route::post('update', [HomeController::class, 'updateprofile'])->name('profile.update');
    });

    Route::controller(AkunController::class)
        ->prefix('akun')
        ->as('akun.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('showdata', 'dataTable')->name('dataTable');
            Route::match(['get','post'],'tambah', 'tambahAkun')->name('add');
            Route::match(['get','post'],'{id}/ubah', 'ubahAkun')->name('edit');
            Route::delete('{id}/hapus', 'hapusAkun')->name('delete');
        });

    Route::controller(FilmController::class)
        ->prefix('tiket')
        ->as('tiket.')
        ->group(function () {
            Route::get('/films', [FilmController::class, 'index'])->name('films');
            Route::get('/formfilm', [FilmController::class, 'create'])->name('formfilm');
            Route::post('/store', [FilmController::class, 'store'])->name('store');
            Route::get('/show/{id}', [FilmController::class, 'show'])->name('show');
            Route::get('/film/{id}/edit', [FilmController::class, 'edit'])->name('edit');
            Route::post('/film/{id}', [FilmController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [FilmController::class, 'destroy'])->name('destroy');
        });
});

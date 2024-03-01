<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', static fn () => view('welcome'))->name('home');

Route::get('/_{slug}', \App\Http\Controllers\LinkVisit::class);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', static fn () => view('dashboard'))->name('dashboard');

    Route::post('/links/create', \App\Http\Controllers\LinkCreate::class);
    Route::post('/links/import', \App\Http\Controllers\LinkImport::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

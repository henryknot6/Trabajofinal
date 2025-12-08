<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpleoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EmpleoController::class, 'index'])->name('home');

Route::get('/empleos', [EmpleoController::class, 'index'])->name('empleos.index');

Route::middleware('auth')->group(function () {
    Route::post('/empleos/{empleo}/postular', [EmpleoController::class, 'postular'])->name('empleos.postular');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:cliente'])->group(function () {
        Route::get('/empleos/create', [EmpleoController::class, 'create'])->name('empleos.create');
        Route::post('/empleos', [EmpleoController::class, 'store'])->name('empleos.store');
        Route::get('/empleos/{empleo}/edit', [EmpleoController::class, 'edit'])->name('empleos.edit');
        Route::put('/empleos/{empleo}', [EmpleoController::class, 'update'])->name('empleos.update');
        Route::delete('/empleos/{empleo}', [EmpleoController::class, 'destroy'])->name('empleos.destroy');
    });
});
     Route::get('/empleos/{empleo}', [EmpleoController::class, 'show'])->name('empleos.show');
Route::get('/dashboard', function () {
    return redirect()->route('empleos.index');
})->middleware(['auth'])->name('dashboard');
Route::get('/freelancer/{id}', [ProfileController::class, 'show'])->name('profile.show');
require __DIR__.'/auth.php';
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonnelController;

Route::get('/', function () {
    return view('welcome');
});

// Personnel Management Routes
Route::prefix('personnel')->group(function () {
    Route::get('/', [PersonnelController::class, 'index'])->name('personnel.index');
    Route::post('/store', [PersonnelController::class, 'store'])->name('personnel.store');
    Route::put('/{personnel}', [PersonnelController::class, 'update'])->name('personnel.update');
    Route::delete('/{personnel}', [PersonnelController::class, 'destroy'])->name('personnel.destroy');
    Route::get('/search', [PersonnelController::class, 'search'])->name('personnel.search');
    Route::get('/statistics', [PersonnelController::class, 'statistics'])->name('personnel.statistics');
    Route::get('/export', [PersonnelController::class, 'export'])->name('personnel.export');
});

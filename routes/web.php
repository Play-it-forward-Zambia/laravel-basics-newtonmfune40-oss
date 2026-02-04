<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonnelController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/personnel', [PersonnelController::class, 'index'])->name('personnel.index');
Route::get('/api/personnel', [PersonnelController::class, 'index'])->name('personnel.api');
Route::post('/personnel', [PersonnelController::class, 'store'])->name('personnel.store');
Route::put('/personnel/{personnel}', [PersonnelController::class, 'update'])->name('personnel.update');
Route::delete('/personnel/{personnel}', [PersonnelController::class, 'destroy'])->name('personnel.destroy');
Route::get('/personnel/statistics', [PersonnelController::class, 'statistics'])->name('personnel.statistics');
Route::get('/personnel/search', [PersonnelController::class, 'search'])->name('personnel.search');
Route::get('/personnel/export', [PersonnelController::class, 'export'])->name('personnel.export');


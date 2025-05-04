<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeartureController;

Route::get('/', [FeartureController::class, 'display'])->name('features.features');
Route::get('/backend', [FeartureController::class, 'index'])->name('features.index');
Route::get('/backend/create', [FeartureController::class, 'create'])->name('features.create');
Route::post('/backend', [FeartureController::class, 'store'])->name('features.store');
Route::get('/backend/{feature}/edit', [FeartureController::class, 'edit'])->name('features.edit');
Route::put('/backend/{feature}/update', [FeartureController::class, 'update'])->name('features.update');
Route::delete('/backend/{feature}/destroy', [FeartureController::class, 'destroy'])->name('features.destroy');
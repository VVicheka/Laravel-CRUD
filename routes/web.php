<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeatureController;

Route::get('/feature', [FeatureController::class, 'display'])->name('features.features');
Route::get('/backend', [FeatureController::class, 'index'])->name('features.index');
Route::get('/backend/create', [FeatureController::class, 'create'])->name('features.create');
Route::post('/backend', [FeatureController::class, 'store'])->name('features.store');
Route::get('/backend/{feature}/edit', [FeatureController::class, 'edit'])->name('features.edit');
Route::put('/backend/{feature}/update', [FeatureController::class, 'update'])->name('features.update');
Route::delete('/backend/{feature}/destroy', [FeatureController::class, 'destroy'])->name('features.destroy');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
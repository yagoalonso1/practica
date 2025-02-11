<?php
use App\Http\Controllers\ApartmentController;
use Illuminate\Support\Facades\Route;

Route::get('/apartments', [ApartmentController::class, 'indexWeb'])->name('apartments.index');
Route::get('/apartments/create', [ApartmentController::class, 'createWeb'])->name('apartments.create');
Route::post('/apartments', [ApartmentController::class, 'storeWeb'])->name('apartments.store');
Route::get('/apartments/{id}', [ApartmentController::class, 'showWeb'])->name('apartments.show');
Route::get('/apartments/{id}/edit', [ApartmentController::class, 'editWeb'])->name('apartments.edit');
Route::put('/apartments/{id}', [ApartmentController::class, 'updateWeb'])->name('apartments.update');
Route::delete('/apartments/{id}', [ApartmentController::class, 'destroyWeb'])->name('apartments.destroy');
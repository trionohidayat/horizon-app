<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConsignmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ConsignmentController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/consignments/create', [ConsignmentController::class, 'create'])->name('consignments.create');
Route::post('/consignments', [ConsignmentController::class, 'store'])->name('consignments.store');
Route::get('/consignments/{id}', [ConsignmentController::class, 'show'])->name('consignments.show');
Route::get('/consignments/{id}/print', [ConsignmentController::class, 'print'])->name('consignments.print');
Route::get('/consignments/confirmation/{id}', [ConsignmentController::class, 'confirmation'])->name('consignments.confirmation');


Route::middleware(['auth'])->group(function () {
    Route::delete('/consignments/{id}', [ConsignmentController::class, 'destroy'])->name('consignments.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

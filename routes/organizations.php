<?php

use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::get('/', [OrganizationController::class, 'index'])->name('home');
    Route::post('organization/store', [OrganizationController::class, 'store'])->name('organization.store');
    Route::get('organization/{organization:slug}', [OrganizationController::class, 'show'])->name('organization.show');
});


Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
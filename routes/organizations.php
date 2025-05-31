<?php

use App\Http\Controllers\EventsController;
use App\Http\Controllers\OrganizationController;
use App\Http\Middleware\EnsureUserBelongsToOrganization;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::get('/', [OrganizationController::class, 'index'])->name('home');
    Route::post('organization/store', [OrganizationController::class, 'store'])->name('organization.store');
});

Route::middleware(['auth', EnsureUserBelongsToOrganization::class])->group(function () {
    Route::get('organization/{organization:slug}/events', [EventsController::class, 'index'])->name('organization.events.index');
    Route::post('organization/{organization:slug}/events', [EventsController::class, 'store'])->name('organization.events.store');
    Route::post('organization/{organization:slug}/events', [EventsController::class, 'store'])->name('organization.events.store');
    Route::get('organization/{organization:slug}/events/{event}', [EventsController::class, 'show'])->name('organization.events.show');
    Route::patch('organization/{organization:slug}/events/{event}', [EventsController::class, 'update'])->name('organization.events.update');
});

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
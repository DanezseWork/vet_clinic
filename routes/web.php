<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Models\Client;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Route::view('clients', view: 'livewire/clients/index')
//     ->middleware(['auth', 'verified'])
//     ->name('clients');

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clientss/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

require __DIR__.'/auth.php';

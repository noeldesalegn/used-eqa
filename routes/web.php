<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/listing/{listing}', \App\Livewire\ShowListing::class)->name('listing.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/sell', \App\Livewire\CreateListing::class)->name('listing.create');
    Route::get('/my-listings', \App\Livewire\MyListings::class)->name('listing.mine');
    Route::get('/listing/{listing}/edit', \App\Livewire\EditListing::class)->name('listing.edit');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', \App\Livewire\Admin\AdminDashboard::class)->name('admin.dashboard');
    Route::get('/listings', \App\Livewire\Admin\AdminListings::class)->name('admin.listings');
    Route::get('/users', \App\Livewire\Admin\AdminUsers::class)->name('admin.users');
});

require __DIR__.'/auth.php';

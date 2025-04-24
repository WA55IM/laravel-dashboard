<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\UserController;

use App\Http\Controllers\DashboardController;
Route::get('/',function(){
  return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index'])
    
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
  Route::redirect('settings', 'settings/profile');

  Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
  Volt::route('settings/password', 'settings.password')->name('settings.password');
});
Route::resource('users', UserController::class)->middleware('auth');

require __DIR__ . '/auth.php';

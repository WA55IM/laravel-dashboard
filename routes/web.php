<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\FileUploadController;


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
Route::resource('comptes', CompteController::class)->middleware('auth');
Route::get('/clients', [DashboardController::class, 'client'])->name('clients.index');


Route::get('/documents', [FileUploadController::class, 'showDocumentsPage'])
     ->name('documents');
Route::post('/documents/process-upload', [FileUploadController::class, 'processUpload'])
     ->name('documents.process-upload'); 


require __DIR__ . '/auth.php';

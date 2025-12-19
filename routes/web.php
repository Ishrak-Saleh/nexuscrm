<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

//Welcome page
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

require __DIR__.'/auth.php';

//Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    //Clients
    Route::resource('clients', ClientController::class);
    Route::get('/clients/today/followups', [ClientController::class, 'todayFollowUps'])
        ->name('clients.today-followups');
    
    //Notes
    Route::post('/clients/{client}/notes', [NoteController::class, 'store'])
        ->name('notes.store');
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])
        ->name('notes.destroy');
    
    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //PDF Reports
    Route::get('/dashboard/report/download', [DashboardController::class, 'downloadReport'])
        ->name('dashboard.report.download');
});
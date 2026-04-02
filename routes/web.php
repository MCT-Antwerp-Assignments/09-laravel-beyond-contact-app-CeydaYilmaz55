<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/contacts/create', [ContactController::class, 'create'])
    ->middleware('auth')
    ->name('contacts.create');

Route::post('/contacts', [ContactController::class, 'store'])
    ->middleware('auth')
    ->name('contacts.store');

Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])
    ->middleware('auth')
    ->name('contacts.edit');

Route::put('/contacts/{contact}', [ContactController::class, 'update'])
    ->middleware('auth')
    ->name('contacts.update');

Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])
    ->middleware('auth')
    ->name('contacts.destroy');

Route::post('/contacts/{id}/restore', [ContactController::class, 'restore'])
    ->middleware('auth')
    ->name('contacts.restore');
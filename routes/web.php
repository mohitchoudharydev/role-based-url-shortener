<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\CompanyController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/urls', [ShortUrlController::class, 'index'])>name('urls.index');

    Route::get('/urls/create', [ShortUrlController::class, 'create'])->name('urls.create');

    Route::post('/urls', [ShortUrlController::class, 'store'])->name('urls.store');

    Route::get('/invitations/create', [InvitationController::class, 'create'])->name('invitations.create');

    Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');


    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');



    });
    Route::get('/s/{code}', [ShortUrlController::class, 'redirect'])->name('urls.redirect');
require __DIR__.'/auth.php';
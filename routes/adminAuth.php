<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {

  Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

  Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminProfileController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['admin'])->group(function () {

        ##------------------------------------------------------- ADMIN INDEX PAGE
        Route::get('/', AdminHomeController::class)->name('index');

        // Route::get('/readNotification', function () {
        //     Auth::guard('admin')->user()->notifications->markAsRead();

        // })->name('read');
        // Route::get('/clearNotification', function () {
        //     $user =Auth::guard('admin')->user() ;
        //     $user->notifications()->delete();


        // })->name('clear');
        
    });

    require __DIR__ . '/adminAuth.php';
});

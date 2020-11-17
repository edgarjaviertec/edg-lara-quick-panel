<?php

use App\Http\Controllers\OtherBrowserSessionsController;
use App\Http\Controllers\ProfilePhotoController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.welcome');
})->name('homepage');


Route::middleware(['verified', 'auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('dashboard.home');

    Route::get('/profile', [UserProfileController::class, 'show'])->name('dashboard.profile');

    Route::get('/user/other-browser-sessions', [OtherBrowserSessionsController::class, 'index'])
        ->name('other-browser-sessions.index');

    Route::delete('/user/other-browser-sessions', [OtherBrowserSessionsController::class, 'destroy'])
        ->name('other-browser-sessions.destroy');

    Route::get('/user/profile-photo', [ProfilePhotoController::class, 'show'])
        ->name('current-user-photo.show');

    Route::delete('/user/profile-photo', [ProfilePhotoController::class, 'destroy'])
        ->name('current-user-photo.destroy');
});


Route::get('/test', [UserProfileController::class, 'test']);
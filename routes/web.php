<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ThresholdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BridgeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\TTNController;
use App\Http\Controllers\ManualController;

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
    return redirect()->route('login');
});

// Login
Route::get('login', [AuthController::class, 'index'])
    ->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])
    ->name('user.logout');

// Forgot password
Route::middleware('guest')->group( function () {
    Route::get('forgot-password', [PasswordResetController::class, 'index'])
        ->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'email'])
        ->name('password.email');
    Route::get('reset-password/{token}/{email?}', [PasswordResetController::class, 'reset'])
        ->name('password.reset');
    Route::post('reset-password', [PasswordResetController::class, 'update'])
        ->name('password.update');
});



Route::middleware('auth')->group( function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('dashboard/bridge/{id}', [DashboardController::class, 'show'])
        ->name('dashboard.show');

    // Profile
    Route::get('profile', [ProfileController::class, 'index'])
        ->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');
});

Route::middleware(['auth', 'is_admin'])->group( function () {
    // Admin Panel
    Route::resource('admin/user', UserController::class)
        ->names('admin.user');
    Route::resource('admin/bridge', BridgeController::class)
        ->names('admin.bridge');
    Route::get('admin', [AdminController::class, 'index'])
        ->name('admin.index');
    Route::post('admin/assign', [AdminController::class, 'assign'])
        ->name('admin.assign');
    Route::get('admin/help', [AdminController::class, 'help'])
        ->name('admin.help');
});

// AJAX requests
Route::post('threshold', [ThresholdController::class, 'threshold'])
    ->middleware('auth')
    ->name('threshold');
Route::post('fire', [TTNController::class, 'index']);
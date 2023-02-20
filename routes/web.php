<?php

use App\Http\Controllers\{LoggingController, SiteConfigController, UserSelfController};
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

Route::get('logs', [LoggingController::class, 'index']);
Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::prefix('myself')->group(function () {
        Route::get('profile', [UserSelfController::class, 'profile'])->name('profile');
        Route::get('account', [UserSelfController::class, 'account'])->name('account');
        Route::put('account', [UserSelfController::class, 'update'])->name('account.update');
        Route::post('deactivate', [UserSelfController::class, 'deactivate'])->name('deactivate');
    });
    Route::prefix('site-config')->group(function () {
        Route::get('/', [SiteConfigController::class, 'index'])->name('siteConfig');
        Route::post('site-settings', [SiteConfigController::class, 'siteSettingsUpdate'])->name('siteConfig.siteSettings');
        Route::post('mail-settings', [SiteConfigController::class, 'mailSettingsUpdate'])->name('siteConfig.mailSettings');
    });
});

require __DIR__ . '/auth.php';

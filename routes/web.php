<?php

use App\Http\Controllers\{AuditLogController,
    EmailTemplateController,
    LoggingController,
    ManageAccessController,
    SiteConfigController,
    UserController,
    UserSelfController
};
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
Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('audits', [AuditLogController::class, 'index'])->name('audits.index');
    Route::get('show-audit/{audit}', [AuditLogController::class, 'show'])->name('audits.show');

    Route::resource('users', UserController::class);

    Route::resource('email-template', EmailTemplateController::class,
        ['names' => 'emailTemplate'])->except(['store', 'show']);

    Route::prefix('access-management')->group(function () {
        Route::resource('roles', ManageAccessController::class);
        Route::get('permissions', [ManageAccessController::class, 'permissions'])->name('permissions.list');
    });

    Route::prefix('site-config')->group(function () {
        Route::get('/', [SiteConfigController::class, 'index'])->name('siteConfig');
        Route::post('site-settings', [SiteConfigController::class, 'siteSettingsUpdate'])->name('siteConfig.siteSettings');
        Route::post('mail-settings', [SiteConfigController::class, 'mailSettingsUpdate'])->name('siteConfig.mailSettings');
    });
    Route::prefix('myself')->group(function () {
        Route::get('profile', [UserSelfController::class, 'profile'])->name('profile');
        Route::get('account', [UserSelfController::class, 'account'])->name('account');
        Route::put('account', [UserSelfController::class, 'update'])->name('account.update');
        Route::put('change-password', [UserSelfController::class, 'changePassword'])->name('changePassword');
        Route::post('deactivate', [UserSelfController::class, 'deactivate'])->name('deactivate');
    });
});

require __DIR__ . '/auth.php';

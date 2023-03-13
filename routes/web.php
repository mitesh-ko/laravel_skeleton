<?php

use App\Http\Controllers\{AuditLogController,
    DashboardController,
    EmailTemplateController,
    LoggingController,
    ManageAccessController,
    SiteSettingsController,
    UserController,
    UserSelfController};
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
    return redirect()->route('profile');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('dashboards')->group(function () {
        Route::get('first-dashboard', [DashboardController::class, 'firstDashboard'])->name('firstDashboard');
    });

    Route::resource('users', UserController::class);

    Route::prefix('logs')->group(function () {
        Route::get('audits', [LoggingController::class, 'auditList'])->name('audits.index');
        Route::get('show-user-audit/{user_id}', [LoggingController::class, 'auditList'])->name('audits.show.user');
        Route::get('show-audit/{audit}', [LoggingController::class, 'showAudit'])->name('audits.show');
        Route::get('authentications-logs', [LoggingController::class, 'authenticationList'])->name('authenticationLogs.index');
        Route::get('show-user-authentication-logs/{authenticatable_id}', [LoggingController::class, 'authenticationList'])->name('authenticationLogs.show.user');
    });


    Route::prefix('access-management')->group(function () {
        Route::resource('roles', ManageAccessController::class);
        Route::get('permissions', [ManageAccessController::class, 'permissions'])->name('permissions.list');
    });

    Route::prefix('settings')->group(function () {
        Route::get('site-config', [SiteSettingsController::class, 'siteConfig'])->name('siteConfig');
        Route::get('mail-config', [SiteSettingsController::class, 'mailConfig'])->name('mailConfig');
        Route::get('email-template', [SiteSettingsController::class, 'emailTemplate'])->name('emailTemplate.index');

        Route::get('email-template/{emailTemplate}/edit', [SiteSettingsController::class, 'emailTemplateEdit'])->name('emailTemplate.edit');
        Route::get('email-template/{emailTemplate}/preview', [SiteSettingsController::class, 'emailPreview'])->name('emailTemplate.preview');
        Route::put('email-template/{emailTemplate}', [SiteSettingsController::class, 'emailTemplateUpdate'])->name('emailTemplate.update');
        Route::post('site-config', [SiteSettingsController::class, 'siteSettingsUpdate'])->name('siteConfig.siteSettings');
        Route::post('mail-settings', [SiteSettingsController::class, 'mailSettingsUpdate'])->name('siteConfig.mailSettings');
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

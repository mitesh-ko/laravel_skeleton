<?php

use App\Http\Controllers\{DashboardController,
    LoggingController,
    ManageAccessController,
    SiteSettingsController,
    TransactionController,
    UserController,
    UserSelfController};
use Illuminate\Support\Facades\Auth;
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
Route::any('/', function (Illuminate\Http\Request $request) {
    if ($request->method() == 'GET') {
        return view('welcome');
    }
    if (Auth::user() && Auth::user()->hasPermissionTo(config('permission-name.dashboard-first_dashboard')))
        return redirect()->route('firstDashboard')->withCookie(cookie('timezone', $request->timezone));
    else
        return redirect()->route('profile')->withCookie(cookie('timezone', $request->timezone));

});

Route::middleware(['auth:web', 'verified', 'timezone', 'verify.2fa'])->group(function () {
    Route::prefix('dashboards')->group(function () {
        Route::get('first-dashboard', [DashboardController::class, 'firstDashboard'])->name('firstDashboard');
    });

    Route::resource('transactions', TransactionController::class);
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
        Route::post('2fa', [UserSelfController::class, '_2fa'])->name('2fa');
        Route::post('disable-2fa', [UserSelfController::class, 'disable2fa'])->name('disable2fa');
        Route::post('request-support-pin', [UserSelfController::class, 'requestSupportPin'])->name('requestSupportPin');
    });
    Route::any('/2fa', [UserSelfController::class, 'verify2fa'])->name('verify.2fa')->withoutMiddleware(['verify.2fa']);
});

require __DIR__ . '/auth.php';

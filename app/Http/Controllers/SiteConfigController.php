<?php

namespace App\Http\Controllers;

use App\Models\SiteConfig;
use Crypt;
use Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use OwenIt\Auditing\Events\AuditCustom;

class SiteConfigController extends Controller
{

    public function index()
    {
        return view('site-config.index-site-config', ['data' => SiteConfig::pluck('value', 'key')]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function siteSettingsUpdate(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            $siteConfig = SiteConfig::where('key', $key)->first();
            if ($siteConfig && $siteConfig->value != $value) {
                SiteConfig::where('key', $key)->update(['value' => $value]);

                $siteConfig->auditEvent = 'updated';
                $siteConfig->isCustomEvent = true;
                $siteConfig->auditCustomOld = ['key' => $siteConfig->key, 'value' => $siteConfig->value];
                $siteConfig->auditCustomNew = ['key' => $key, 'value' => $value];
                Event::dispatch(AuditCustom::class, [$siteConfig]);
            }
        }
        return Redirect::back()->with('success', 'Site config updated successfully.');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function mailSettingsUpdate(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if ($key == 'mail_password') {
                $value = Crypt::encryptString($value);
            }
            $siteConfig = SiteConfig::where('key', $key)->first();
            if ($siteConfig && $siteConfig->value != $value) {
                SiteConfig::where('key', $key)->update(['value' => $value]);

                $siteConfig->auditEvent = 'updated';
                $siteConfig->isCustomEvent = true;
                $siteConfig->auditCustomOld = ['key' => $siteConfig->key, 'value' => $siteConfig->value];
                $siteConfig->auditCustomNew = ['key' => $key, 'value' => $value];
                Event::dispatch(AuditCustom::class, [$siteConfig]);
            }
        }
        return Redirect::back()->with('success', 'mail setting updated successfully.');
    }
}

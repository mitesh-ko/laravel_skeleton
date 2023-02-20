<?php

namespace App\Http\Controllers;

use App\Models\SiteConfig;
use Crypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
            SiteConfig::where('key', $key)->update(['value' => $value]);
        }
        return Redirect::back();
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
            SiteConfig::where('key', $key)->update(['value' => $value]);
        }
        return Redirect::back();
    }
}

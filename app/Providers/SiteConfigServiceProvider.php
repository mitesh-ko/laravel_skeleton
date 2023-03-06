<?php

namespace App\Providers;

use App\Models\SiteConfig;
use Config;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;

class SiteConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(\Schema::hasTable('site_config')) {
            $value = Cache::remember('siteConfig', 36000, function () {
                $siteConfig = SiteConfig::pluck('value', 'key')->all();
                if ($siteConfig) {
                    try {
                        $siteConfig['mail_password'] = Crypt::decryptString($siteConfig['mail_password']);
                    } catch (DecryptException $e) {
                        info($e);
                    }
                }
                return $siteConfig;
            });
            config('mail.mailers.smtp.port', $value['mail_port']);
            config('mail.mailers.smtp.host', $value['mail_port']);
            config('mail.mailers.smtp.username', $value['mail_username']);
            config('mail.mailers.smtp.password', $value['mail_password']);
            config('mail.from.address', $value['mail_from_address']);
            config('mail.from.name', $value['mail_from_name']);
            Config::set('site', $value);
        }
    }
}

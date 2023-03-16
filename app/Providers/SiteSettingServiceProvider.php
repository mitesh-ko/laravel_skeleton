<?php

namespace App\Providers;

use App\Models\EmailTemplate;
use App\Models\SiteConfig;
use Config;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;
use Schema;

class SiteSettingServiceProvider extends ServiceProvider
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
        $value = Cache::remember('siteConfig', 36000, function () {
            if (Schema::hasTable('site_configs'))
                return SiteConfig::pluck('value', 'key')->all();
            else
                return [];
        });
        Config::set('mail.mailers.smtp.port', $value['mail_port'] ?? '');
        Config::set('mail.mailers.smtp.host', $value['mail_host'] ?? '');
        Config::set('mail.mailers.smtp.username', $value['mail_username'] ?? '');
        Config::set('mail.mailers.smtp.password', $value['mail_password'] ?? '');
        Config::set('mail.from.address', $value['mail_from_address'] ?? '');
        Config::set('mail.from.name', $value['mail_from_name'] ?? '');
        Config::set('app.name', $value['name'] ?? '');
        // ================================= email template
        $emailTemplates = Cache::remember('emailTemplates', 36000, function () {
            if (Schema::hasTable('email_templates')) {
                $emailTemplates = [];
                foreach (EmailTemplate::get() as $value) {
                    $emailTemplates['emailTemplate'][$value->key] = $value;
                }
                return $emailTemplates;
            }
            return [];
        });

        $newArray = array_merge($value, $emailTemplates);

        Config::set('site', $newArray);

    }
}

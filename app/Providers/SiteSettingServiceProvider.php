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
        config('mail.mailers.smtp.port', $value['mail_port'] ?? '');
        config('mail.mailers.smtp.host', $value['mail_port'] ?? '');
        config('mail.mailers.smtp.username', $value['mail_username'] ?? '');
        config('mail.mailers.smtp.password', $value['mail_password'] ?? '');
        config('mail.from.address', $value['mail_from_address'] ?? '');
        config('mail.from.name', $value['mail_from_name'] ?? '');
        config('app.name', $value['name'] ?? '');
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

<?php

namespace Database\Seeders;

use App\Models\SiteConfig;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SiteConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insertData = [
            [
                'key'   => 'name',
                'value' => null
            ],
            [
                'key'   => 'short_name',
                'value' => null
            ],
            [
                'key'   => 'timezone',
                'value' => null
            ],
            [
                'key'   => 'logo',
                'value' => null
            ],
            [
                'key'   => 'concurrent_session',
                'value' => null
            ],
            [
                'key'   => 'mail_enabled',
                'value' => null
            ],
            [
                'key'   => 'mail_verification',
                'value' => null
            ],
            [
                'key'   => 'mail_username',
                'value' => null
            ],
            [
                'key'   => 'mail_password',
                'value' => null
            ],
            [
                'key'   => 'mail_port',
                'value' => null
            ],
            [
                'key'   => 'mail_host',
                'value' => null
            ],
            [
                'key'   => 'mail_from_address',
                'value' => null
            ],
            [
                'key'   => 'mail_from_name',
                'value' => null
            ],
        ];
        foreach ($insertData as $i => $value) {
            if (!SiteConfig::where('key', $value['key'])->first()) {
                SiteConfig::create($value);
            }
        }
        Cache::delete('siteConfig');
    }
}

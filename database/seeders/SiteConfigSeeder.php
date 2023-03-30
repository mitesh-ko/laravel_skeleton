<?php

namespace Database\Seeders;

use App\Models\SiteConfig;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'key'   => 'mail_username',
                'value' => ''
            ],
            [
                'key'   => 'mail_password',
                'value' => ''
            ],
            [
                'key'   => 'mail_port',
                'value' => ''
            ],
            [
                'key'   => 'mail_host',
                'value' => ''
            ],
            [
                'key'   => 'mail_from_address',
                'value' => ''
            ],
            [
                'key'   => 'mail_from_name',
                'value' => ''
            ],
        ];
        foreach ($insertData as $i => $value) {
            if(!SiteConfig::where('key', $value['key'])->first()) {
                SiteConfig::create($value);
            }
        }
    }
}

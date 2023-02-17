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
            $insertData[$i]['created_at'] = now();
            $insertData[$i]['updated_at'] = now();
        }
        SiteConfig::insert($insertData);
    }
}
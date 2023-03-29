<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class MakePermissionNameConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-permission-name-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command update permission-name.php config file with new permissions.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->comment('This command update your permission-name.php file of config folder, run this command in development environment only.');
        if($this->confirm('Are you running this command in development environment.')) {
            $this->info('Updating...');
            $permissionName = '<?php' . PHP_EOL;
            $permissionName .= '/* Do not change, this file is auto generated. ' . PHP_EOL .  'use this command: php artisan app:make-permission-name-config */' . PHP_EOL . 'return [' . PHP_EOL;
            foreach (config('constants.permissions') as $key => $value) {
                $key = str_replace(' ', '_', $key);
                foreach ($value as $key2 => $value2) {
                    $key2 = str_replace(' ', '_', $key2);
                    $permissionName .= '"' . strtolower($key . '-' . $key2) . '"=>"' . $value2['name'] . '",' . PHP_EOL;
                }
            }
            $permissionName .= '];';
            $pathFile = config_path('permission-name.php');
            if (File::exists($pathFile)) {
                file_put_contents($pathFile, $permissionName);
            }
            $this->info('Updated successfully.');
        }
    }
}

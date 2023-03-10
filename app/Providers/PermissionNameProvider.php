<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class PermissionNameProvider extends ServiceProvider
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
        Cache::remember('permissionName', 36000*30, function () {
            $permissionName = '<?php' . PHP_EOL;;
            $permissionName .= '//Do not change, this file is auto generated' . PHP_EOL . 'return ['. PHP_EOL;
            foreach (config('constants.permissions') as $key => $value) {
                $key = str_replace(' ', '_', $key);
                foreach ($value as $key2 => $value2) {
                    $key2 = str_replace(' ', '_', $key2);
                    $permissionName .= '"' . strtolower($key . '-' . $key2) . '"=>"' . $value2['name'] . '",' . PHP_EOL;
                }
            }
            $permissionName .= '];';
            $pathFile = str_replace('app\Providers', 'config\permission-name.php', __DIR__);
            if (File::exists($pathFile)) {
                file_put_contents($pathFile, $permissionName);
            }
            return $permissionName;
        });
    }
}

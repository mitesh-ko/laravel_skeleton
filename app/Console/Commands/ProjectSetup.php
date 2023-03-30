<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Process\Pool;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;

class ProjectSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:project-setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Process::run('npm i', function (string $type, string $output) {
            $this->info($output);
        });

        Process::run('composer run-script post-root-package-install', function (string $type, string $output) {
            $this->info($output);
        });

        Process::run('composer run-script post-create-project-cmd', function (string $type, string $output) {
            $this->info($output);
        });

        $this->info('Press enter to skip optional question.');

        $setupEnv = [];
        $dbConnection = $this->choice('Choose your database connection', ['mysql', 'pgsql']);
        $setupEnv['DB_CONNECTION'] = 'DB_CONNECTION=' . $dbConnection;
        $setupEnv['DB_HOST'] = 'DB_HOST=' . $this->ask('Enter database host (optional)', '127.0.0.1');
        $setupEnv['DB_PORT'] = 'DB_PORT=' . $this->ask('Enter database port (optional)', $setupEnv['DB_CONNECTION'] == 'DB_CONNECTION=mysql' ? '3306' : '5432');
        $dbName = $this->ask('Enter database name');
        $setupEnv['DB_DATABASE'] = 'DB_DATABASE=' . $dbName;
        $setupEnv['DB_USERNAME'] = 'DB_USERNAME=' . $this->ask('Enter database username');
        $setupEnv['DB_PASSWORD'] = 'DB_PASSWORD=' . $this->ask('Enter database password');

        $envKey = [
            "/DB_CONNECTION.*/",
            "/DB_HOST.*/",
            "/DB_PORT.*/",
            "/DB_DATABASE.*/",
            "/DB_USERNAME.*/",
            "/DB_PASSWORD.*/",
        ];

        if (File::exists('.env')) {
            $envFile = File::get('.env');
            $updatedEnv = preg_replace($envKey, $setupEnv, $envFile);
            File::put('.env', $updatedEnv);
        }

        Process::run('npm run build', function (string $type, string $output) {
            $this->info($output);
        });

        $this->info(Process::run('php artisan storage:link')->output());

        if($this->confirm("Create {$dbName} database on {$dbConnection} and enter yes.")) {
            Process::run('php artisan migrate --seed', function (string $type, string $output) {
                $this->info($output);
            });

            Process::run('php artisan serve', function (string $type, string $output) {
                $this->info($output);
            });
        }
    }
}

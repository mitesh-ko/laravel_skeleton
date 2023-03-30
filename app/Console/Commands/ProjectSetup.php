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
        $this->info('Please wait composer and npm install running in background...');
        $this->info('This may take long time to complete!');
        [$first, $second] = Process::timeout(1800)->concurrently(function (Pool $pool) {
            $pool->command('composer i');
            $pool->command('npm i');
        });
        echo $first->output();
        echo $second->output();

        Process::run('composer run-script post-root-package-install', function (string $type, string $output) {
            $this->info($output);
        });

                Process::run('composer run-script post-create-project-cmd', function (string $type, string $output) {
            $this->info($output);
        });

        $this->info('Press enter to skip optional question.');

        $setupEnv = [];
        $setupEnv['DB_CONNECTION'] = 'DB_CONNECTION=' . $this->choice('Choose your database connection', ['mysql', 'pgsql']);
        $setupEnv['DB_HOST'] = 'DB_HOST=' . $this->ask('Enter database host (optional)', '127.0.0.1');
        $setupEnv['DB_PORT'] = 'DB_PORT=' . $this->ask('Enter database port (optional)', $setupEnv['DB_CONNECTION'] == 'DB_CONNECTION=mysql' ? '3306' : '5432');
        $setupEnv['DB_DATABASE'] = 'DB_DATABASE=' . $this->ask('Enter database name');
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

        Process::run('php artisan migrate --seed', function (string $type, string $output) {
            $this->info($output);
        });
    }
}

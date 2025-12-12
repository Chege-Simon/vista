<?php

namespace Vista\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 * Class VistaCommand
 *
 * This command acts as the Vista scheduler supervisor. It wraps Laravel's
 * built-in `schedule:run` command and executes it at a configurable interval.
 *
 * Example:
 *   php artisan vista
 *
 * Configuration:
 *   The run interval is defined in `config/vista.php` under the `interval` key.
 */
class VistaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vista';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vista scheduler supervisor';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $interval = config('vista.interval', 60);

        $this->info("Vista scheduler started. Checking tasks every {$interval} seconds...");

        while (true) {
            // Run Laravel's scheduler engine
            Artisan::call('schedule:run');

            // Sleep until the next interval
            sleep($interval);
        }
    }
}

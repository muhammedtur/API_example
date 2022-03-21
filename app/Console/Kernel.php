<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Events\SyncCapsulesDataEvent;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\SyncCapsulesDataCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('capsules:sync')
                  ->everyThreeMinutes()
                  ->withoutOverlapping()
                  ->runInBackground()
                  ->before(function () {
                    event(new SyncCapsulesDataEvent(__('email.capsules_sync_start_title'), __('email.capsules_sync_start_msg')));
                })
                  ->after(function () {
                    event(new SyncCapsulesDataEvent(__('email.capsules_sync_completed_title'), __('email.capsules_sync_completed_msg')));
                });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

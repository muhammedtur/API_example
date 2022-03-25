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
        // Runs 'capsules:sync' command to start sync every 3 minutes
        $schedule->command('capsules:sync')
                  ->everyThreeMinutes()
                  ->withoutOverlapping()
                  ->runInBackground()
                  ->before(function () {
                    // Sends email notification before sync starts
                    event(new SyncCapsulesDataEvent(__('emails.capsules_sync_start_title'), __('emails.capsules_sync_start_msg')));
                })
                  ->after(function () {
                    // Sends email notification after sync is finished
                    event(new SyncCapsulesDataEvent(__('emails.capsules_sync_completed_title'), __('emails.capsules_sync_completed_msg')));
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

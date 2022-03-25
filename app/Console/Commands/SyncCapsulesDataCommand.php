<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\SyncCapsulesDataJob;

class SyncCapsulesDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'capsules:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Capsules Data to Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Queue and run the sync process - App\Jobs\SyncCapsulesDataJob
        SyncCapsulesDataJob::dispatch();
    }
}

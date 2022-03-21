<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Jobs\SyncCapsulesDataJob;

class CapsuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sync first data to database
        SyncCapsulesDataJob::dispatch();
    }
}

<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

use App\Events\SyncCapsulesDataEvent;
use App\Models\Capsule;

use Log;

class SyncCapsulesDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::acceptJson()->get(env('CAPSULES_API_URL'));
        $datas = json_decode($response->body(), true);

        foreach ($datas as $data) {
            Capsule::updateOrCreate([
                'capsule_serial' => $data['capsule_serial'],
            ],
            [
                'capsule_id' => $data['capsule_id'],
                'status' => $data['status'],
                'original_launch' => $data['original_launch'],
                'original_launch_unix' => $data['original_launch_unix'],
                'missions' => $data['missions'],
                'landings' => $data['landings'],
                'type' => $data['type'],
                'details' => $data['details'],
                'reuse_count' => $data['reuse_count'],
            ]);
        }
        Log::info($datas);
    }
}

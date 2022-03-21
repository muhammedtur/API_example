<?php

namespace App\Listeners;

use App\Events\SyncCapsulesDataEvent;
use App\Mail\SyncNotificationMail;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Mail;

class SyncCapsulesDataListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SyncCapsulesDataEvent  $event
     * @return void
     */
    public function handle(SyncCapsulesDataEvent $event)
    {
        Mail::to($event->email_address)->send(new SyncNotificationMail($event->email_address));
    }
}

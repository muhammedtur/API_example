<?php

namespace App\Listeners;

use App\Events\SyncCapsulesDataEvent;
use App\Mail\SyncNotificationMail;
use App\Models\User;

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
        $this->event = $event;
        User::OfAdminUsers()->chunk(10,function($users){
            foreach($users as $user){
                Mail::to($user->email)->send(new SyncNotificationMail($this->event->subject, $this->event->msg));
            }
        });
    }
}

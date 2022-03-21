<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SyncNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $msg)
    {
        $this->subject = $subject;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'noreply@'.env('APP_DOMAIN_EXT');
        $name = __('site.application');

        return $this->view('emails.sync_capsules_data', ['title' => $this->subject, 'msg' => $this->msg])
        ->from($address, $name)
        ->replyTo($address, $name)
        ->subject($this->subject);
    }
}

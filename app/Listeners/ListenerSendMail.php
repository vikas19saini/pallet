<?php

namespace App\Listeners;

use App\Events\EventSendMail;
use App\Jobs\JobSendMail;
use App\Mail\SendMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ListenerSendMail
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
     * @param  $eventSendMail object
     * @param $data array
     * @return void
     */
    public function handle(EventSendMail $eventSendMail)
    {
        Mail::queue(new SendMail($eventSendMail));
    }
}

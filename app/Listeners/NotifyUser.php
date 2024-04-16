<?php

namespace App\Listeners;

use App\Events\NewUserCreated;
use App\Mail\UserNotifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewUserCreated $event): void
    {
        Mail::to($event->user->email)->send( new UserNotifyEmail($event->user));
    }
}

<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Mail\WelcomeMail;

use Mail;

class SendWelcomeEmail
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
     * @param  NewUserRegistered  $event
     * @return void
     */
    public function handle(NewUserRegistered $event)
    {
        $user = $event->user;
        $data = [];
        $data['email'] = $user->email;
        $data['type'] = $user->type;
        $data['message'] = 'Welcome ' . $user->name . '!';
        Mail::to($user->email)->send(new WelcomeMail($data));
    }
}

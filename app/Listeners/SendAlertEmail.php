<?php

namespace App\Listeners;

use App\Events\SensorThresholdExceeded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Mail\Message;
use Mail;

use App\Models\Bridge;

class SendAlertEmail
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
     * @param  SensorThresholdExceeded  $event
     * @return void
     */
    public function handle(SensorThresholdExceeded $event)
    {
        $sensor = $event->sensor;
        $bridge = Bridge::find($sensor->bridge_id);
        $user = Auth()->user();

        Mail::send('emails.sensor', ['sensor' => $sensor, 'bridge' => $bridge], function (Message $message) use ($user) {
            $message->subject(config('app.name') . ' - Bridge alert');
            $message->to($user->email);
        });
    }
}

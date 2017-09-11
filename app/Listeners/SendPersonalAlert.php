<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Events\PersonalAlertCreated;

class SendPersonalAlert implements ShouldQueue
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
     * @param  PersonalAlertCreated  $event
     * @return void
     */
    public function handle(PersonalAlertCreated $event)
    {
        $post = $event->post;
        $triggered_user = $event->triggered_user;
        $data = $event->data;

        // 個人的なアラート
        // Mail::to($post->user)
        //         ->send(new SendMail($post, $triggered_user, $data));

        Mail::to($post->user)
                ->queue(new SendMail($post, $triggered_user, $data));
    }
}

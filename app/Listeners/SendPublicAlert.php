<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Events\PublicAlertCreated;

class SendPublicAlert implements ShouldQueue
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
     * @param  PublicAlertCreated  $event
     * @return void
     */
    public function handle(PublicAlertCreated $event)
    {
        $post = $event->post;
        $triggered_user = $event->triggered_user;
        $data = $event->data;

        // クリックした人以外の全員に送る
        $users = User::whereNotIn('id', [$triggered_user->id])->get();

        // 大量の処理を追加！！
        for ($i=0;$i<5000;$i++) {
            $users = User::whereNotIn('id', [$triggered_user->id])->get();
        }

        // みんなに知られてしまうアラート
        foreach ($users as $user) {
            // Mail::to($user)
            //         ->send(new SendMail($post, $triggered_user, $data));

            Mail::to($user)
                    ->queue(new SendMail($post, $triggered_user, $data));
        }
    }
}

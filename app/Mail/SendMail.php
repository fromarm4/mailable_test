<?php

namespace App\Mail;

use App\Post;
use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

     public $post;
     public $triggered_user;
     public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $triggered_user, $data)
    {
        $this->post = $post;
        $this->triggered_user = $triggered_user;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.alert')
                    ->subject(env('APP_NAME').'からの通知')
                    ->with([
                            'to_user' => $this->to[0],
                        ]);
    }
}

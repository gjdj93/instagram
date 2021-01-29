<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewFollowerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $auth_user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $auth_user)
    {
        $this->user = $user;
        $this->auth_user = $auth_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.follow-email')->with('user', 'auth_user');
    }
}

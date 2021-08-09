<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('fahridhanny@gmail.com', 'no-reply')
            ->subject('Hi'.' '.$this->user->name)
            ->view('email.resetPassword')
            ->with([
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email
            ]);
    }
}

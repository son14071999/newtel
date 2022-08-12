<?php

namespace App\Listeners;

use App\Events\ResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
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
     * @param  \App\Events\ResetPassword  $event
     * @return void
     */
    public function handle(ResetPassword $event)
    {
        Mail::send('email.resetPassword', ['user' => $event->user], function($email) use($event){
            $email->subject('Reset password');
            $email->to($event->user->email, 'Nguyen Xuan Son');
        });
    }
}

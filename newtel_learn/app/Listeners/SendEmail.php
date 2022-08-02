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
        Mail::send('email.resetPassword', [], function($email){
            $email->subject('Reset password');
            $email->to('son1999tmgl3@gmail.com', 'Nguyen Xuan Son');
        });
    }
}

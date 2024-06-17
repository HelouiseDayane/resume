<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserNotificationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $resume;

    public function __construct($resume)
    {
        $this->resume = $resume;
    }

    public function build()
    {
        return $this->subject('Sua inscrição foi recebida')
                    ->view('emails.user_notification');
    }
}

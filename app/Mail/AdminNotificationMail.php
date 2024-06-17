<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNotificationMail extends Mailable
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
        return $this->subject('Nova inscrição recebida')
                    ->view('emails.admin_notification');
    }
}

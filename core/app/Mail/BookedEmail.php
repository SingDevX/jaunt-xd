<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $name = 'Sing';
        $address = 'no-reply@jauntbook.online';
        $subject = 'Scam to';
        info('email sent');

        return $this->view('emails.test')
                    ->from($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'test_message' => $this->data['message'] ]);
    }

    // /**
    //  * Build the message.
    //  *
    //  * @return $this
    //  */
    // public function build()
    // {
    //     return $this->view('view.name');
    // }
}

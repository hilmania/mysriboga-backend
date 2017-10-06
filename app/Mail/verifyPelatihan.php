<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class verifyPelatihan extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $thisUser ;
    public $body = "Approval Registration";

    public function __construct($thisUser)
    {
          $this->thisUser = $thisUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->subject('Verifikasi Pelatihan')->view('email.sendEmailPelatihan');
    }
}

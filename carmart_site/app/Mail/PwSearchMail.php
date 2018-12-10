<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PwSearchMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $data;
     public function __construct($data){
        $this->data = $data;
     }

     public function build()
     {
       return $this->from('edicu12@gmail.com', 'Car Market')
       ->subject('Car Market Password Search Service!')
       ->view('email.pwSearch')->with(['data', $this->data]);
     }
}

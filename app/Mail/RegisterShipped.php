<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;

class RegisterShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job)
    {
      $user = Auth::user();
      $this->sendData = ['title'=>$job->title,
                        'email'=>$user->email,
                        'name'=>$user->name];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('hoge@gmail.com')
                 ->subject('イベント応募のご連絡')
                 ->with($this->sendData)
                 ->text('emails.templates.registers_mail');
    }
}

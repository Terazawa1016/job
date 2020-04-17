<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;

class ContactSent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job)
    {
      $today = date("Y-m-d H:i:s");
      $user = Auth::user();
      $this->sendData = ['title'=>$job->title,
                        'email'=>$job->User->email,
                        'name'=>$user->name,
                        'date'=>$today];


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
                 ->text('emails.templates.user_mail');
    }
}

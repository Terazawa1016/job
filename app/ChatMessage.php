<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
  protected $fillable = [
    'user_id','job_id','client_id','message',
  ];

  public function User()
  {
    return $this->belongsTo('App\User');
  }

  public function Job()
  {
    return $this->belongsTo('App\Job');
  }
}

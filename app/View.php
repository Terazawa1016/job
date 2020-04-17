<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
  protected $fillable = [
  'user_id', 'job_id', 'count'
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

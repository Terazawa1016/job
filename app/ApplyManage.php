<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplyManage extends Model
{
  protected $fillable = [
    'user_id','job_id',
  ];

  public function User()
  {
    return $this->belongsTo('App\User');
  }

  public function Job()
  {
    return $this->belongsToMany('App\Job');
  }

}

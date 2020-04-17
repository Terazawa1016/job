<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobManage extends Model
{
  protected $fillable = [
    'capacity', 'job_id'
  ];

  public function job()
  {
    return $this->belongsTo('App\Job');
  }
}

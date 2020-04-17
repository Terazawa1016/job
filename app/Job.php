<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  protected $fillable = [
    'user_id','title','price','img','status','category','date','time','pref','place','town','detail'
  ];

  public function Like() {
    return $this->hasMany('App\Like');
  }

  public function JobManage() {
    return $this->hasOne('App\JobManage');
  }

  public function User() {
    return $this->belongsTo('App\User');
  }

  public function Views()
  {
    return $this->hasMany('App\View');
  }
}

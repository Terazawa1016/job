<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
  protected $fillable = [
    'city_id','pref','city','rubi'
  ];

  public function Job() {
    return $this->belongs('App\Job');
  }

}

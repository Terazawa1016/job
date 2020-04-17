<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\User;
use Auth;


class ContentController extends Controller
{
  public function home() {

    $hash = Job::orderBy('id','DESC')->take(12)->get();

    return view('home', compact('hash'));
  }
}

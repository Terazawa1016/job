<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobManage;
use App\ApplyManage;
use App\Like;
use App\Job;
use App\User;
use Auth;
use App\Mail\ContactSent;
use App\Mail\RegisterShipped;
use Mail;

class FinishController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function finish($job_id)
  {
    $count_like = User::find(
      Auth::id()
    )->like()->sum('count');

    $item = Job::where(
      'id',$job_id
      )->first();

// dd($item);
    $apply_manage = ApplyManage::where([
      'user_id'=>Auth::id(),
      'job_id'=>$job_id
      ])->count();

   if ($apply_manage) {
     return redirect()->route('detail',[
       'job_id' => $job_id])->with('flash_message', '既に応募が完了しております');
   } else {
// どのユーザがどのイベントを応募したかを保存
    $apply_manage = new ApplyManage;
    $apply_manage->job_id = $job_id;
    $apply_manage->user_id = Auth::id();
    $apply_manage->save();

// 送り先（イベントの主催者）
    $job = Job::where('id',$job_id)->with('User')->first();

// dd($job->User->email);

    Mail::to($job->User->email)->send(new RegisterShipped($job));


    $user = Auth::user();
    Mail::to($user->email)->send(new ContactSent($job));

// 定員数を一人分減らす
     $job_manage = JobManage::where(['job_id'=>$job_id])->first();
     $job_manage->capacity -= 1;
     $job_manage->save();
   }

// dd($items[0]);
    return view('top.finish', compact('item','count_like'));
  }

}

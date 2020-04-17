<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChatRequest;
use App\ChatRoomUser;
use App\ChatMessage;
use Carbon\Carbon;
use App\User;
use App\Job;
use App\View;
use Auth;

class DetailController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function click($job_id)
  {
// ユーザのお気に入り数取得
    $count_like = User::find(
      Auth::id()
    )->like()->sum('count');

    $item = Job::where([
      'id'=>$job_id
    ])->first();

// 現在ページのjob_idから主催者のidデータを取得
    $chat = ChatMessage::whereHas('job', function($query) use ($job_id) {
      $query->where('id', $job_id);
    })->orderBy('id', 'desc')->get();

    $time = Carbon::now()->timestamp;
    // dd($time);

    $session = session('visited') ? session('visited'):[];
    if(array_search($job_id,$session) === false) {

      $view = new View;
      $view_stamp = $view->where([
        'job_id'=>$job_id,
        'user_id'=>Auth::id()
      ])->first();
      if(empty($view_stamp)){
        $view->job_id = $job_id;
        $view->user_id = Auth::id();
        $view->today = Carbon::now();
        $view->count=1;
        $view->save();
      } else {
        $view_stamp->count += 1;
        $view_stamp->today = Carbon::now();
        $view_stamp->save();
      }

    if(!session()->has('visited')) {
      session(['visited'=>[$job_id]]);
    } else {
      $visited = session('visited');
      $visited[] = $job_id;
      session(['visited' => $visited] );
    }
  }
    return view('top.detail',compact('item','chat','time','count_like'));
  }

  public function chat(ChatRequest $request, $job_id)
  {
    $input = $request->all();
    $input['job_id'] = $job_id;
    $input['user_id'] = Auth::id();
    unset($input['_token']);

// ユーザーのメッセージを登録
    $chat_message['user_id'] = Auth::id();
    $chat_message = new ChatMessage;
    $chat_message->fill($input);
    $chat_message->save();

    return redirect()->route('detail',[
      'job_id' => $job_id]);
  }
}

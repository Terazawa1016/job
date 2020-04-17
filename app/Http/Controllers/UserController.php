<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobManage;
use Auth;
use Carbon\Carbon;
use App\ApplyManage;
use App\City;
use App\Job;
use App\User;

class UserController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(Request $request)
  {
    $count_like = User::find(
      Auth::id()
    )->like()->sum('count');

    $user_data = Job::where('jobs.user_id',Auth::id())->leftJoin('apply_manages','apply_manages.job_id','=','jobs.id')
    ->leftJoin('users','users.id','=','apply_manages.user_id')
    ->select('users.name AS user_name','jobs.title AS job_title','users.email','apply_manages.created_at');

    if($request->has('s')) {
      $user_data = $user_data->where(function($query) use ($request){
        $query->where('title', 'lIKE', "%{$request->s}%")
        ->orWhere('name', 'lIKE', "%{$request->s}%");
      });
    }

    $users = $user_data->get();
    // dd($users);

    // 取得したデータをviewに送る
    return view('user.index', compact('users', 'count_like'));
  }

  public function attend()
  {
    $count_like = User::find(
      Auth::id()
    )->like()->sum('count');

// ジョブテーブルからログインユーザにひもづいたID取得
// ジョブテーブルのidとapplyManageのjob_idで連結
    $users = ApplyManage::where('apply_manages.user_id',Auth::id())->leftJoin('jobs','jobs.id','=','apply_manages.job_id')
    ->leftJoin('users','users.id','=','jobs.user_id')
    ->select('users.name AS user_name','jobs.title AS job_title','users.email','apply_manages.created_at','jobs.id AS job_id', 'jobs.date AS job_date')->get();
    // dd($users);


    $time = Carbon::now()->addDays(7)->timestamp;

    return view('user.attend', compact('users', 'count_like', 'time'));
  }

  public function delete (Request $request)
  {
    $input = $request->all();
    unset($input['_token']);

    // dd($input);

    ApplyManage::where([
      'user_id'=>Auth::id(),
      'job_id'=>$input['job_id']
    ])->delete();

    return redirect('/user/attend');
  }
}

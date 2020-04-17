<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Job;
use App\User;
use App\View;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $jobs = Job::with(['Like'=>function($q) {
          $q->where('user_id',Auth::id());
        }])->where('status', 1)->with('Views');

  // カテゴリー検索
        if($request->has('category')) {

          $jobs = $jobs->where([
            'category'=>$request->category
          ]);
        }

        if($request->has('s')) {
          $jobs = $jobs->where(function($query) use ($request){
            $query->where('title', 'lIKE', "%{$request->s}%")
            ->orWhere('pref', 'lIKE', "%{$request->s}%")
            ->orWhere('place', 'lIKE', "%{$request->s}%");
          });
        }

        if($request->has('price')) {
          $jobs = $jobs->where(
            'price','<=',$request->price);
        }

// ユーザのお気に入り数取得
        $count_like = User::find(
          Auth::id()
        )->like()->sum('count');
        // \DB::enableQueryLog();


        $hash = $jobs->orderBy('date','asc')->paginate(10);
        // dd(\DB::getQueryLog());

        return view('top.index', compact('hash','count_like'));
    }

    public function like(Request $request)
    {

// 商品のお気に入り追加処理
      $input = $request->all();
      $input['user_id'] = Auth::id();
      unset($input['_token']);

      $like =  Like::where([
        'user_id'=>$input['user_id'],
        'job_id'=>$input['id']
        ])->first();
// dd($input);

      if($like) {

        $like->delete();
      } else {
        $like = new Like;
        $input['job_id'] = $input['id'];
        $like->fill($input);
        $like->count = 1;
        $like->save();
      }

      return redirect('/top');
    }

    public function favorite(Request $request)
    {
      // ユーザのお気に入り追加合計値
      $count_like = User::find(
        Auth::id()
      )->like()->sum('count');

       // ユーザのお気に入り一覧
        $like = new Job;

  // 検索した名前に部分一致する商品情報を取得する
        $like = $like->whereHas('Like', function($query){
          $query->where('user_id', Auth::id());
        });

        $hash = $like->paginate(10);

      return view('top.favorite', compact('hash', 'count_like'));
    }

}

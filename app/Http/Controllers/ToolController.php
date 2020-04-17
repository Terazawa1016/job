<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Services\CheckExtensionServices;
use App\Services\FileUploadServices;
use App\Http\Requests\CityRequest;
use App\JobManage;
use Auth;
use App\City;
use App\Job;
use App\User;

class ToolController extends Controller
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

    $job_data = Job::where(
      'user_id',Auth::id()
    );

    $prefs = config('pref');
    $city = City::all();

    if($request->has('s')) {
      $job_data = $job_data->where(function($query) use ($request){
        $query->where('title', 'lIKE', "%{$request->s}%");
      });
    }

    $jobs = $job_data->get();

  // 取得したデータをviewに送る
    return view('tool.tool', compact('jobs','city','count_like'))->with(['prefs' => $prefs]);
  }


  //新規登録画面
  public function create()
  {
    $count_like = User::find(
      Auth::id()
    )->like()->sum('count');

    $prefs = config('pref');

    $city = City::all();

    return view('tool.create', compact('city','count_like'))->with(['prefs' => $prefs]);
  }

//新規登録完了画面
  public function store(CityRequest $request)
  {
    $input = $request->all();
    $job_data = ['capacity'=>$input['capacity']];
    $input['user_id'] = Auth::id();
    unset($input['_token']);

  $job = new Job;
//ファイル保存処理
    if(!is_null($request['img'])){
        $imageFile = $request['img'];

        $list = FileUploadServices::fileUpload($imageFile);
        list($extension, $fileNameToStore, $fileData) = $list;
// dd($fileNameToStore);
        $data_url = CheckExtensionServices::checkExtension($fileData, $extension);
        $image = Image::make($data_url);
        $image->resize(125,125)->save(storage_path() . '/app/public/images/' . $fileNameToStore );
        $input['img'] = $fileNameToStore;
    }

    // データベースに登録
    $job->fill($input);

    $job->save();

    $client_data['job_id'] = $job->id;
    $client_data['user_id'] = Auth::id();

    $job_data['job_id'] = $job->id;

    $job_manage = new JobManage;
    $job_manage->fill($job_data);
    $job_manage->save();

    return redirect('/tool');
  }

  public function update (Request $request, $job_id)
  {
    $input = $request->all();
    unset($input['_token']);

    $jobs = Job::where('id', $job_id)
    //カラム全体を更新。渡されたものを全て更新
    ->update($input);

    return redirect('/tool');
  }

  public function date (Request $request, $job_id)
  {
    $input = $request->all();
    unset($input['_token']);

    $jobs = Job::where('id', $job_id)
    //カラム全体を更新。渡されたものを全て更新
    ->update($input);

    return redirect('/tool');
  }

  //ステータス変更処理
  public function status (Request $request, $job_id)
  {
    $input = $request->all();
    unset($input['_token']);

    $jobs = Job::where('id', $job_id)->first();
    //値を部分的に更新
    $jobs->fill($input);
    $jobs->save();

    return redirect('/tool');
  }

//削除処理
  public function delete (Request $request, $job_id)
  {
    Job::where('id', $job_id)
    ->delete();

    return redirect('/tool');
  }

  public function city(Request $request)
  {
    $pref = $request->get('pref');
    $city = City::where(
      'pref',$pref
    )->get();

    $city_place = $request->get('city');

    return view('tool.city', compact('city','city_place'));
  }
}

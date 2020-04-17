<?php use Carbon\Carbon; ?>
@extends('layouts.user_manage')

@section('content')

  {{--エラー表示--}}
  @if ($errors->any())
    <p>
      @foreach ($errors->all() as $err)
      {{$err}}<br>
      @endforeach
    </p>
  @endif

  <h2  class="event_msg">応募イベント情報</h2>
    <table class="kakomi-maru1">
        <tr>
            <th>イベント名</th>
            <th>主催者</th>
            <th>Eメール</th>
            <th>日時</th>
            <th>取消</th>
        </tr>

        @foreach ($users as $user)
        <tr>
            <td class="name_width">{{$user->job_title}}</td>
            <td>{{$user->user_name}}</td>
            <td>{{$user->email}}
            <td>{{$user->created_at}}</td>
            <td>

            @if($time < Carbon::createFromFormat('Y-m-d',$user->job_date)->timestamp)
{{--<?php echo $time; echo "\t" . Carbon::createFromFormat('Y-m-d',$user->job_date)->timestamp; ?>--}}
              <form method = "post" action="{{route('delete.user')}}">
                @csrf
                  <input class="btn3-square-little-rich" type = "submit" value = "削除">
                  <input type="hidden" name="job_id" value="{{$user->job_id}}">
              </form>
            @endif

            </td>
        </tr>
        @endforeach
    </table>

@endsection

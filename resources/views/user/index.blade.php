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

  <h2  class="event_msg">応募ユーザ情報</h2>
    <table class="kakomi-maru1">
        <tr>
            <th>応募者名</th>
            <th>イベント</th>
            <th>Eメール</th>
            <th>申込日</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td class="name_width">{{$user->user_name}}</td>
            <td>{{$user->job_title}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
        </tr>
        @endforeach
    </table>

@endsection

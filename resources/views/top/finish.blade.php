<?php use Carbon\Carbon; ?>
@extends('layouts.top')

@section('content')

<div class="content">
  {{--エラー表示--}}
  @if ($errors->any())
    <p>
      @foreach ($errors->all() as $err)
      {{$err}}<br>
      @endforeach
    </p>
  @endif

    <div class="job">
        <div class="album">
          <a href=""><img class="detail-img" src = "/storage/images/{{$item->img}}"></a>
        </div>
        <div class="finish-msg">ご応募ありがとうございました！</div>
        <h1 class="detail-name">{{$item->title}}</h1><br>

        <div class="detail-info">

          <span class="detail-price">¥{{$item->price}}</span>
          <span class="detail-capacity">定員数: {{$item->JobManage->capacity}}名</span><br>
          <span class="detail-date">開催日: {{Carbon::createFromFormat('Y-m-d',$item->date)->format('Y年n月j日')}}</span><br>
          <span class="detail-date">所要時間: {{Carbon::createFromFormat('H:i:s',$item->time)->format('G時間')}}</span><br>
          <span class="detail-place">開催地: {{$item->pref}}</span>
          <span class="detail-place">{{$item->place}}</span><br>
          <span class="detail-content">詳細: {{$item->detail}}</span><br>
        </div>
    </div>
  </div>

  @endsection

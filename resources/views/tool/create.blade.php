@extends('layouts.manage')

@section('content')
<body>
    <section class="create_event">

{{--エラー表示--}}
@if ($errors->any())
  <p>
    @foreach ($errors->all() as $err)
    {{$err}}<br>
    @endforeach
  </p>
@endif
        <h2>新規イベント追加</h2>
        <form method="post" enctype="multipart/form-data" action="{{route('tool.store')}}">
          @csrf
            <div class="create create_title"><label>タイトル名: <input type="text" name="title" value="{{old('title')}}"></label></div>
            <div class="create create_price"><label>値段: <input type="text" name="price" value="{{old('price')}}"></label></div>
            <div class="create create_img"><label>商品画像: <input type="file" name="img"></div></label>
            <div class="create create_status">
                ステータス:
                <select name="status">
                    <option value="0">非公開</option>
                    <option value="1">公開</option>
                </select>
            </div>
            <div class="create create_category">
              カテゴリー:
              <select name="category">
                <option title="0" value="0">----</option>
                <option value="help" @if('help' === old('category')) selected @endif>お手伝い</option>
                <option value="care" @if('care' === old('category')) selected @endif>介護</option>
                <option value="home_stay" @if('home_stay' === old('category')) selected @endif>ホームステイ</option>
                <option value="photo" @if('photo' === old('category')) selected @endif>撮影</option>
                <option value="lesson" @if('lesson' === old('category')) selected @endif>教育</option>
                <option value="sale" @if('sale' === old('category')) selected @endif>販売</option>
                <option value="consultation" @if('consultation' === old('category')) selected @endif>悩み相談</option>
                <option value="event" @if('event' === old('category')) selected @endif>イベント</option>
                <option value="power work" @if('power work' === old('category')) selected @endif>力仕事</option>
                <option value="sport" @if('sport' === old('category')) selected @endif>スポーツ</option>
                <option value="other" @if('other' === old('category')) selected @endif>その他</option>
              </select>
            </div>
              <div class="create create_date"><label>日時: <input type="date" name="date"></label></div>
              <div class="create create_time"><label>所要時間: <input type="time" name="time"></label></div>
              <div class="create create_place">
                <label>場所:
                <select name="pref" id="pref">
                  <option title="0" value="0">----</option>
                  @foreach($prefs as $name)
                    <option value="{{$name}}" @if($name === old('pref')) selected @endif>{{$name}}</option>
                  @endforeach
                </select>
                <select name="place" id="city" data-selected="{{old('place')}}">
                  <option value="0">----</option>
                </select>
                <input type="text" name="town" value="{{old('town')}}">
              </label>
            </div>
            <div class="create create_detail"><label>詳細: <textarea name="detail">{{old('detail')}}</textarea></label></div>
            <div class="create create_capacity"><label>定員数: <input type="text" name="capacity" value="{{old('capacity')}}"></label></div>
          <div class="create"><input class="btn2-square-little-rich" type="submit" value="登録する"></div>
          @csrf
        </form>
    </section>
  @endsection

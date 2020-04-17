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
    <ul class="item-list">
      @foreach ($hash as $item)
      <li>
        <div class="item">

          {{--いいねボタン--------------------------------------------------------------}}
                        <form class="like" method="post" action="{{route('like')}}">
                          @csrf

                          @if (!empty($item->Like[0]->count))
                          <i class="like_btn fas fa-heart"></i>
                          <input type="hidden" name="id" value="{{$item['id']}}" />

                          @else
                          <i class="like_btn far fa-heart"></i>
                          <input type="hidden" name="id" value="{{$item['id']}}" />
                          @endif
                        </form>
          {{--ここまで「いいね」--------------------------------------------------------}}

            <a href="{{route('detail', ['job_id'=>$item->id])}}"><img class="item-img" src = "/storage/images/{{$item->img}}"></a>

            <div class="item-info">

              <span class="item-name">{{$item->title}}</span><br>
              <span class="item-price">¥{{$item->price}}</span><br>
              <span class="item-date">{{Carbon::createFromFormat('Y-m-d',$item->date)->format('Y年n月j日')}}</span><br>
              <span class="item-place">{{$item->pref}}</span><br>
              <span class="item-capacity">定員数: {{$item->JobManage->capacity}}名</span><br>

          @if ($item->JobManage->capacity === 0)
            <p class="sold-out">満員</p>
          @else
          </div>
          <a class="cart-btn btn-flat-double-border" href="{{route('detail', ['job_id'=>$item->id])}}">詳細を見る</a>

          @endif
        </div>
      </li>
      @endforeach
     </ul>
     <ul class="page">{{ $hash->links() }}</ul>

   </div>

@endsection

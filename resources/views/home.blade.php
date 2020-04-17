@extends('layouts.homeapp')

@section('content')
<div class="home_content">
  <div class="home_img">
      <div class="home slider">
          <div class="home_box" style="position: relative;">
            <a href="{{route('top')}}">
              <img src="/storage/images/home_img4.jpeg" alt=""  >
            <p style="position: absolute top; color:#fff">イベントに参加</p>
            </a>
          </div>
          <div class="home_box" style="position: relative;">
            <a href="{{route('tool.create')}}">

            <img src="/storage/images/home_img1.jpeg" alt="">
            <p style="position: absolute top; color:#fff">自分でイベントを開催</p>
          </a>
          </div>
          <div class="home_box" style="position: relative;">
            <a href="{{route('attend.user')}}">
            <img src="/storage/images/home_img3.jpeg" alt="">
            <p style="position: absolute top; color:#fff">イベントで仲間作り</p>
          </a>
          </div>

      </div>

  </div>

{{--------------------------------------------------------------------------}}
{{--<div class="home_img">
  <a href="{{route('top')}}">
    <img class="home_img" src="/storage/images/home_img.jpeg" alt="Event LIST">
  </a>
</div>--}}
<ul class="home item-list">
  @foreach ($hash as $item)
  <li>
    <div class="home_item">

        <a href="{{route('detail', ['job_id'=>$item->id])}}"><img class="item-img" src = "/storage/images/{{$item->img}}"></a>

        <div class="home_item item-info">

          <span class="item-name">{{$item->title}}</span><br>
        </div>
    </div>
  </li>
  @endforeach
 </ul>
</div>
@endsection

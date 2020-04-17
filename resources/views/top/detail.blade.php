<?php use Carbon\Carbon; ?>
@extends('layouts.top')

@section('content')

<div class="content">

  @if (session('flash_message'))
      <div class="detail_flash_message">
          <p>{{ session('flash_message') }}</p>
      </div>
  @endif
  <div class="job">
      <div class="album">
        <a href=""><img class="detail-img" src = "/storage/images/{{$item->img}}"></a>
      </div>
      <h1 class="detail-name">{{$item->title}}</h1><br>

      <div class="detail-info">

        <span class="detail-price">¥{{number_format($item->price)}}</span>
        <span class="detail-capacity">定員数: {{$item->JobManage->capacity}}名</span><br>
        <span class="detail-date">開催日: {{Carbon::createFromFormat('Y-m-d',$item->date)->format('Y年n月j日')}}</span><br>
        <span class="detail-date">所要時間: {{Carbon::createFromFormat('H:i:s',$item->time)->format('G時間')}}</span><br>
        <span class="detail-place">開催地: {{$item->pref}}</span>
        <span class="detail-place">{{$item->place}}{{$item->town}}</span><br>
        <span class="detail-content">詳細: {{$item->detail}}</span><br>



    @if ($item->JobManage->capacity === 0 || $time >= Carbon::createFromFormat('Y-m-d',$item->date)->timestamp)
    {{--<?php echo $time; echo "\t" . Carbon::createFromFormat('Y-m-d',$item->date)->timestamp; ?>--}}

      <p class="detail-sold-out">受け付け終了</p>
    @else

        <a href="{{route('finish', ['job_id' => $item->id])}}" class="apply-btn apply-flat-double-border">応募する</a>
    </div>
    @endif
  </div>


  {{--チャット画面作成--------------------------------------------------------}}

  <div id="chat">
      <div id="your_container">
        {{--エラー表示--}}
        @if ($errors->any())
          <p>
            @foreach ($errors->all() as $err)
            {{$err}}<br>
            @endforeach
          </p>
        @endif


          <!-- チャットの外側部分① -->
          <div id="bms_messages_container">
              <!-- ヘッダー部分② -->
              <div id="bms_chat_header">
                  <!--ステータス-->
                  <div id="bms_chat_user_status">
                      <!--ステータスアイコン-->
                      <div id="bms_status_icon"><i class="fas fa-user-circle"></i></div>
                      <!--ユーザー名-->
                      <div id="bms_chat_user_name">{{Auth::user()->name}}</div>
                  </div>
              </div>

              <!-- テキストボックス、送信ボタン④ -->
              <div id="bms_send">
                <form method="post" action="{{route('chat', ['job_id' => $item->id])}}">
                  @csrf
                  <textarea id="bms_send_message" name="message"></textarea>
                    <input id="bms_send_btn" type="submit" value="送信" >
                </form>
              </div>

              <!-- タイムライン部分③ -->
              <div id="bms_messages">

              <!--メッセージ１（左側）-->
              @foreach($chat as $message)
              @if ($message->User->id !== $item->user_id)
              <div class="bms_message bms_left">

                  <div class="bms_message_box">
                      <div class="bms_message_content">
                          <div class="bms_message_text">{{$message->User->name}}:&#010;
                            {{$message->message}}</div>
                      </div>
                  </div>
                  <div class="bms_time1">{{$message->created_at}}</div>
              </div>
              <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->
              @else
              <!--メッセージ２（右側）-->
              <div class="bms_message bms_right">

                  <div class="bms_message_box">
                      <div class="bms_message_content">
                          <div class="bms_message_text">{{$message->message}}</div>
                      </div>
                  </div>
                  <div class="bms_time2">{{$message->created_at}}</div>

              </div>
              @endif
              <div class="bms_clear"></div>
              <!-- 回り込みを解除（スタイルはcssで充てる） -->
              @endforeach

              </div>

          </div>
      </div>
    </div>

  {{--ここまで----------------------------------------------------------------}}

</div>

@endsection

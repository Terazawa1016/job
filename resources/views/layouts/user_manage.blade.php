<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Make A Event</title>
  <link rel="stylesheet" href="{{ asset('css/top.css') }}">
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bmesse.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/tool.css') }}"/>




  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">


</head>
<body>
  <header>
    <div class="header-box">
      <a href="{{route('top')}}">
        <img class="logo" src="/storage/images/logo.png" alt="Event LIST">
      </a>
      <div class="header-shop">
      <form method="post" class="header-logout" action="{{route('logout')}}">
        @csrf
        <input class="nemu btn btn-flat-border" type="submit" value="logout">
      </form>


        <div class="text-right mb-2">good:
             <span class="badge badge-pill badge-success">{{ $count_like }}</span>
        </div>

        <p class="nemu user_name"><i class="fas fa-user-circle"></i> {{Auth::user()->name}}</p>


        <form id="form4" action="{{route('event.user')}}" method="get">
          <input id="sbox4"  id="s" name="s" type="text" placeholder="イベントの参加者を探す" />
          <button id="sbtn4" type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>
    </div>

      <nav class="header-menu">
        <ul class="header-list" id="menu">
          <li>
           <a href="{{route('tool.create')}}"><i class="jobs fas fa-plus-circle"></i></a>
           <ul>
             <li><a href="{{route('tool')}}">管理画面</a></li>
             <li><a href="{{route('attend.user')}}">参加するイベント</a></li>
             <li><a href="{{route('event.user')}}">イベントの参加者</a></li>
             <li><a href="{{route('tool.create')}}">イベントを開催する</a></li>
           </ul>
         </li>
          <li><a href="{{route('top')}}"><i class="jobs fas fa-list-alt"></i></a>
               <ul>
                 <li><a href="/top?category=help">お手伝い</a></li>
                 <li><a href="/top?category=care">介護</a></li>
                 <li><a href="/top?category=home_stay">ホームステイ</a></li>
                 <li><a href="/top?category=photo">撮影</a></li>
                 <li><a href="/top?category=lesson">教育</a></li>
                 <li><a href="/top?category=sale">販売</a></li>
                 <li><a href="/top?category=consultation">悩み相談</a></li>
                 <li><a href="/top?category=event">イベント</a></li>
                 <li><a href="/top?category=power work">力仕事</a></li>
                 <li><a href="/top?category=sport">スポーツ</a></li>
                 <li><a href="/top?category=other">その他</a></li>
               </ul>
             </li>
            <li>
             <a href=""><i class="jobs fas fa-search-dollar"></i></a>
             <ul>
               <li><a href="/top?price=1000">~¥1,000</a></li>
               <li><a href="/top?price=3000">~¥3,000</a></li>
               <li><a href="/top?price=5000">~¥5,000</a></li>
               <li><a href="/top?price=10000">~¥10,000</a></li>
             </ul>
           </li>
           <li>
             <a href="{{route('favorite')}}" class="favorite_id"><i class="jobs fas fa-heartbeat"></i></a>
           </li>
        </ul>
       </nav>
  </header>
  @yield('content')
  <footer>
    <nav>
    {{--<ul class="flex-bottom">
        <li><a href="#" target="_blank">sitemap</a></li>
        <li><a href="#" target="_blank">privacy</a></li>
        <li><a href="#" target="_blank">form</a></li>
        <li><a href="#" target="_blank">guide</a></li>
    </ul>--}}
    </nav>
    <p><small> &#169; TestUser All Rights Reserved.</small></p>
</footer>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
    $('.like_btn').click(function() {
        $(this).parent().submit();
    });
});

$(document).ready(function() {
    $('.favorite_id').click(function() {
      //自分自身の親要素(フォーム)を参照する
      //サブミットを実行
        $(this).parent().submit();
    });
});

// 都道府県プルダウン----------------------------------------------------------
$(window).load(function (){
  if($('#pref').val()!== '0'){
    $.ajax({
        url: '{{route('tool.city')}}', //データベースを繋げるファイル
        type:"POST",
        data:{
            pref: $('#pref').val(),
            table: 'cities', //繋げるDBのテーブル名
            _token: $('input[name="_token"]').val()
        }
    }).done(function(html){
        $("#city").html(html);
    }).fail(function(html) {
        alert("error"); //通信失敗時
    });
  }
})

$('#pref').on('change', function(){
    $.ajax({
        url: '{{route('tool.city')}}', //データベースを繋げるファイル
        type:"POST",
        data:{
            pref: $('#pref').val(),
            table: 'cities', //繋げるDBのテーブル名
            _token: $('input[name="_token"]').val()
        }
    }).done(function(html){
        $("#city").html(html);
    }).fail(function(html) {
        alert("error"); //通信失敗時
    });
});

</script>
</body>
</html>

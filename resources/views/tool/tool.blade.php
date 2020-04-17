@extends('layouts.manage')

@section('content')
  <section>

{{--エラー表示--}}
@if ($errors->any())
  <p>
    @foreach ($errors->all() as $err)
    {{$err}}<br>
    @endforeach
  </p>
@endif

        <h2 class="event_msg">イベント情報の一覧・変更</h2>
        <table class="kakomi-maru1">
            <tr>
                <th>画像</th>
                <th>内容</th>
                <th>場所/日時</th>
                <th>操作</th>
            </tr>
            @if (!empty($jobs))
            @foreach ($jobs->all() as $item)
            <tr class="status_false">
            <!--テーブル内表示-->
            <!--三項演算子『？』で条件分岐、指定の文字が入っているか空か-->
            <tr class = "{{(!$item->status) ? 'status_false':''}}">
                <td><img class="img_size" src = "/storage/images/{{$item->img}}"></td>
                <td class="tool name_width">
                  {{$item->title}}<br>¥{{$item->price}}<br>

                    <!--ステータス変更-->
                    <form method = "post" action="{{route('tool.status', ['job_id' => $item->id])}}">

                      @csrf
                        @if ($item->status === 0)
                            <input class="btn4-square-little-rich" type = "submit" name ="status_button" value = "非公開→公開">
                            <!--非公開『0』を選択で背景色グレーに変更-->
                            <input type = "hidden" name = "status" value = '1' >
                        @else
                            <input class="btn-square-little-rich" type = "submit" name ="status_button" value = "公開→非公開">
                            <input type = "hidden" name = "status" value = '0' >
                        @endif
                    </form>
                </td>
                <td>
                    <!--開催場所変更-->
                    <div class="tool_place">
                    <form method = "post" action="{{route('tool.update',['job_id' => $item->id])}}">
                      @csrf
                          {{$item->pref}}/{{$item->place}}<br>
                        <select name="pref" class="pref">
                          <option title="0" value="0" selected>----</option>
                          @foreach($prefs as $name)
                            <option value="{{$name}}">{{$name}}</option>
                          @endforeach
                        </select>
                        <select name="place" class="city">
                          <option value="0" selected>----</option>
                        </select>
                        <input type="text" name="town" value="{{old('town')}}">
                        <input class="btn-square-little-rich" type = "submit" value = "変更">
                    </form>

                    <!--日時変更-->
                    <form method = "post" action="{{route('tool.date',['job_id' => $item->id])}}">
                      @csrf
                        <input type = "date" class="input_text_width2 text_align_right" name = "date" value = "{{$item->date}}">
                        <input class="btn-square-little-rich" type = "submit" value = "変更">
                    </form>
                  </div>
                </td>
                <td class="tool_delete">
                    <!--削除-->
                    <form method = "post" action="{{route('tool.delete',['job_id' => $item->id])}}">
                      @csrf
                        <input class="btn3-square-little-rich" type = "submit" value = "削除">
                    </form>
                </td>
            </tr>
            </tr>
            @endforeach
            @endif
        </table>
    </section>
    @endsection

<option value="0">----</option>
@foreach($city as $name)
  <option value="{{$name['city']}}" @if ($name['city'] === $city_place) selected @endif>{{$name['city']}}</option>
@endforeach

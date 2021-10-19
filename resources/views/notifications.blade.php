@foreach ($not as $no)
  <a href="{{route('notification.read',[$no->id])}}">  {{$no->data['message']}}</a>
    {{$no->created_at->diffForHumans()}}
    {{$no->read_at}}
    <br>
@endforeach

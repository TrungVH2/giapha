@foreach($allUsers as $item)
    @if($item->wife_husband == $index)
        <div><img src="{{'/uploads/'.$item->images}}" style="width: 100px; height: 125px"><br><p>{{$item->name}}</p></div>
    @endif
@endforeach
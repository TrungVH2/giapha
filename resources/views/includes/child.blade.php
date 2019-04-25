<ul>
    <li>
        <a href="/home/12/detail">
            <div><img src="{{'/img/'.$itmeCon->images}}" style="width: 100px; height: 125px"><br><p>{{$itmeCon->name}}</p></div>
            @include('includes.wife-husband', ['index' => $itmeCon->id, 'allUsers' => $allUsers])
        </a>
    </li>
</ul>

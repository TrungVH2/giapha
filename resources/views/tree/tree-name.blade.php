@extends('layouts.app')
@section('content')
    <div id="page-wrapper">
        <div class="tree">
            <ul>
                @if($userIndex)
                    <li>
                        <a href="/home/{{$userIndex->id}}/detail">
                            <div><p>{{$userIndex->name}}</p></div>
                        </a>
                        <?php

                        $home = new App\Http\Controllers\HomeController();
                        echo $home->getListChilrendOnlyNameOld($userIndex->id);
                        ?>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endsection

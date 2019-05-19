@extends('layouts.app')
@section('tree')
    <!-- Styles -->
    <link href="{{ asset('css/style-tree.css') }}" rel="stylesheet">
    <style>
        .navbar-laravel{
            position: fixed !important;
        }
    </style>
@endsection
@section('content')
        <div class="tree text-center">
            <ul>
                @if($userIndex)
                    <li>
                        <a href="/home/{{$userIndex->id}}/detail">
                            <div><img src="{{'../uploads/'.$userIndex->avatar}}" style="width: 100px; height: 125px"><br><p>{{$userIndex->name}}</p></div>
                            <?php
                            $home = new App\Http\Controllers\HomeController();

                            echo $home->showWifeHusband($userIndex->id);
                            ?>
                        </a>
                        <?php  echo $home->getListChilrend($userIndex->id); ?>
                    </li>
                @endif
            </ul>
        </div>
@endsection

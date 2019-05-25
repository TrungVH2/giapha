@extends('layouts.app')
@section('tree')
    <!-- Styles -->
    <link href="{{ asset('css/style-tree.css') }}" rel="stylesheet">
    <style>
        .navbar-laravel{
            position: fixed !important;
        }
        .zoom-tree{
            float: left;
            margin-top: 50px;
            margin-left: 30px;
            width: 100px;
            height: 25px;
            border: 2px solid #ccc;
            border-radius: 2px 2px 2px 2px;
            background-color: #fff3cd;
            position: fixed;
            z-index: 1;
            text-align: center;
        }
        .zoom-add{
            float: left;
            width: 50%;
        }
        .zoom-remove{
            float: left;
            width: 50%;
        }
        .zoom-add:hover{
            background-color: #ccc;
        }
        .zoom-remove:hover{
            background-color: #ccc;
        }

        .zoom-25
        {
            zoom: 25%;
            margin-top: 150px;
        }
        .zoom-50
        {
            zoom: 50%;
            margin-top: 75px;
        }
        .zoom-65
        {
            zoom: 65%;
            margin-top: 50px;
        }
        .zoom-75
        {
            zoom: 75%;
            margin-top: 50px;
        }

        .zoom-85
        {
            zoom: 85%;
            margin-top: 50px;
        }

        .zoom-95
        {
            zoom: 95%;
        }
    </style>

    <script>
       function removeZoomClass() {
           $(".tree").removeClass('zoom-50');
        }

        function addZoomClass() {
           $(".tree").addClass('zoom-50');
        }
    </script>
@endsection
@section('content')
    <div class="zoom-tree">
        <a class="zoom-remove" onclick="addZoomClass();"><i class="fa fa-search-minus"></i></a>
        <a class="zoom-add" onclick="removeZoomClass();"><i class="fa fa-search-plus"></i></a>
    </div>
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

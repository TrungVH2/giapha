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
            width: 150px;
            height: 50px;
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
            border-bottom: 2px solid #ccc;
        }
        .zoom-remove{
            float: left;
            width: 50%;
            border-bottom: 2px solid #ccc;
        }
        .zoom-add:hover{
            background-color: #ccc;
        }
        .zoom-remove:hover, .tree-view:hover{
            background-color: #ccc;
        }
        .tree-view{
            float: left;
            width: 33%;

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

        function hiddenImg(){
           $(".img-user").hide();
        }

        function hiddenWifeOrHusband() {
            $(".show-wife-husband").hide();
        }

        function showall() {
            $(".img-user").show();
            $(".show-wife-husband").show();
        }
    </script>
@endsection
@section('content')
    <div class="zoom-tree">
        <a class="zoom-remove" onclick="addZoomClass();"><i class="fa fa-search-minus"></i></a>
        <a class="zoom-add" onclick="removeZoomClass();"><i class="fa fa-search-plus"></i></a>
        <a class="tree-view" onclick="showall();"><i class="fa fa-reply-all"></i></a>
        <a class="tree-view" onclick="hiddenImg();"><i class="fa fa-image"></i></a>
        <a class="tree-view" onclick="hiddenWifeOrHusband();"><i class="fa fa-tree"></i></a>
    </div>
        <div class="tree text-center" style="position: center !important;">
            <ul>
                @if($userIndex)
                    <li>
                        <a href="/tree/{{$userIndex->id}}/view-detail">
                            <div>
                                <img class="img-user" src="{{'../uploads/'.$userIndex->avatar}}" style="width: 75px; height: 100px">
                                <p>{{$userIndex->name}}</p>
                            </div>
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

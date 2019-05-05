<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/spur.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom_admin.css') }}" rel="stylesheet">
    <!-- Page level plugin CSS-->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    @yield('chartsjs')
    @yield('js_common')
    <title>Admin Vo Huy</title>
</head>
<body>
<div class="dash">
    <div class="dash-nav dash-nav-dark">
        <header>
            <a href="#!" class="menu-toggle">
                <i class="fas fa-bars"></i>
            </a>
            <a href="/Admin" class="spur-logo"><i class="fas fa-bolt"></i> <span>Vo Huy</span></a>
        </header>
        <nav class="dash-nav-list">
            <a href="index.html" class="dash-nav-item">
                <i class="fas fa-home"></i> Dashboard </a>
            <div class="dash-nav-dropdown ">
                <a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
                    <i class="fas fa-cube"></i> Thành viên </a>
                <div class="dash-nav-dropdown-menu">
                    <a href="{{url('/Admin/list-members')}}" class="dash-nav-dropdown-item">Danh sách</a>
                    <a href="{{url('/Admin/add-new-member')}}" class="dash-nav-dropdown-item">Thêm mới</a>
                </div>
            </div>
            <div class="dash-nav-dropdown">
                <a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
                    <i class="fas fa-newspaper"></i> Tin Tức </a>
                <div class="dash-nav-dropdown-menu">
                    <a href="#" class="dash-nav-dropdown-item">Thống báo</a>
                    <a href="#" class="dash-nav-dropdown-item">Đăng thông báo</a>
                    <a href="#" class="dash-nav-dropdown-item">Album sự kiện</a>
                </div>
            </div>
            <div class="dash-nav-dropdown">
                <a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
                    <i class="fas fa-book"></i> Admin </a>
                <div class="dash-nav-dropdown-menu">
                    <a href="#" class="dash-nav-dropdown-item">Account manage</a>
                    <a href="#" class="dash-nav-dropdown-item">Xác nhận</a>
                    <a href="#" class="dash-nav-dropdown-item">Sign up</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="dash-app">
        <header class="dash-toolbar">
            <a href="#!" class="menu-toggle">
                <i class="fas fa-bars"></i>
            </a>
            <a href="#!" class="searchbox-toggle">
                <i class="fas fa-search"></i>
            </a>
            <form class="searchbox" action="#!">
                <a href="#!" class="searchbox-toggle"> <i class="fas fa-arrow-left"></i> </a>
                <button type="submit" class="searchbox-submit"> <i class="fas fa-search"></i> </button>
                <input type="text" class="searchbox-input" placeholder="type to search">
            </form>
            <div class="tools">
                <a href="https://github.com/HackerThemes/spur-template" target="_blank" class="tools-item">
                    <i class="fab fa-github"></i>
                </a>
                <a href="#!" class="tools-item">
                    <i class="fas fa-bell"></i>
                    <i class="tools-item-count">4</i>
                </a>
                <div class="dropdown tools-item">
                    <a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                        <a class="dropdown-item" href="#!">Profile</a>
                        <a class="dropdown-item" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </header>
        <main class="dash-content">
            @yield('content')
        </main>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="{{ asset('js/spur.js') }}"></script>
<!-- Page level plugin JavaScript-->
<script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin.min.js') }}"></script>

<!-- Demo scripts for this page-->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
</body>
</html>

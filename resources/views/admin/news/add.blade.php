@extends('layouts.admin_app')
@section('js_common')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="../js/editor.js"></script>
    <script>
        $(document).ready(function() {
            $("#txtEditor").Editor();
        });
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="../css/editor.css" type="text/css" rel="stylesheet"/>
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="dash-title">Forms</h1>
        <div class="row">
            <div class="col-xl-10">
                <div class="card spur-card">
                    <div class="card-header">
                        <div class="spur-card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="spur-card-title"> Simple Form </div>
                    </div>
                    <div class="card-body">
                         <form action="" method="" >
                            <div class="form-group">
                                <label for="titleControl">Tiêu đề:</label>
                                <input type="text" class="form-control" id="titleControl" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="demo-editor-bootstrap">Nội dung bài viết:</label>
                                <textarea id="txtEditor"/>
                                <!-- <textarea class="form-control" id="demo-editor-bootstrap" rows="3"/> -->
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="submit"  class="btn btn-primary">Đăng bài</button>
                    </div>
                </div>
            </div>
        </div>
    <div>
@endsection
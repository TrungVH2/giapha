@extends('layouts.admin_app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card spur-card">
                <div class="card-header">
                    <div class="spur-card-icon">
                        <i class="fas fa-table"></i>
                    </div>
                    <div class="spur-card-title">Danh sách thành viên trong họ</div>
                </div>
                <div class="card-body ">
                    <table class="table table-striped table-in-card">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">Năm sinh</th>
                            <th scope="col">Quê quán</th>
                            <th scope="col">Điện thoại</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tên cha</th>
                            <th scope="col">Tùy chọn</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Mark</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Mark</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Mark</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
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
                            <th scope="col" class="text-black-50">#</th>
                            <th scope="col" class="text-black-50">Chi họ</th>
                            <th scope="col" class="text-black-50">Tên cha/bố</th>
                            <th scope="col" class="text-black-50">Tên mẹ</th>
                            <th scope="col" >Họ tên</th>
                            <th scope="col" class="text-black-50">Vợ</th>
                            <th scope="col" class="text-black-50">Năm sinh</th>
                            <th scope="col" class="text-black-50">Quê quán</th>
                            <th scope="col" class="text-black-50">Điện thoại</th>
                            <th scope="col" class="text-black-50">Email</th>
                            <th scope="col" class="text-black-50">Tùy chọn</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td><a href="#">Mark</a></td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                                <a href="#">Thêm con</a>
                                <a href="#">Sửa</a>
                                <a href="#">xóa</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td><a href="#">Mark</a></td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                                <a href="#">Thêm con</a>
                                <a href="#">Sửa</a>
                                <a href="#">xóa</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td><a href="#">Mark</a></td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                                <a href="#">Thêm con</a>
                                <a href="#">Sửa</a>
                                <a href="#">xóa</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td><a href="#">Mark</a></td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                                <a href="#">Thêm con </a> |
                                <a href="#">Sửa</a> |
                                <a href="#">xóa</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
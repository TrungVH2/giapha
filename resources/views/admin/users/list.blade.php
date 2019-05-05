@extends('layouts.admin_app')
@section('content')
    <div class="row list-members">
        <div class="col-lg-12">
            <div class="card spur-card">
                <div class="card-header">
                    <div class="spur-card-icon">
                        <i class="fas fa-table"></i>
                    </div>
                    <div class="spur-card-title">Danh sách thành viên trong họ</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-in-card" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th scope="col" class="text-black-50">#</th>
                            <th scope="col" class="text-black-50">Chi họ</th>
                            <th scope="col" >Hình</th>
                            <th scope="col" >Họ tên</th>
                            <th scope="col" class="text-black-50">Năm sinh</th>
                            <th scope="col" class="text-black-50">Quê quán</th>
                            <th scope="col" class="text-black-50">Điện thoại</th>
                            <th scope="col" class="text-black-50">Tùy chọn</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listUser as $item)
                            @if($loop->iteration/2 != 0)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>Chi họ</td>
                                    @if(!$item->avatar)
                                        <td><a href="#"><img src="../img/avatar.png" class="img-circle" title="{{$item->name}}" alt="{{$item->name}}" width="50" height="50"></a></td>
                                    @else
                                        <td><a href="#"><img src="../uploads/{{$item->avatar}}" class="img-circle" title="{{$item->name}}" alt="{{$item->name}}" width="50" height="50"></a></td>
                                    @endif
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->birthday}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>
                                        <a href="{{route('add-new-member')}}">Thêm </a>
                                        <a href="{{route('edit-member', ['userId'=> $item->id])}}">Sửa </a>
                                        @if($item->roles_id == 1)
                                            <a href="#" onclick="confirm('Bạn có chắc chắn muốn xóa thành viên này không?')">
                                                Xóa<span class="glyphicon glyphicon-remove"></span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>Chi họ</td>
                                    @if(!$item->avatar)
                                        <td><a href="#"><img src="../img/avatar.png" class="img-circle" title="{{$item->name}}" alt="{{$item->name}}" width="50" height="50"></a></td>
                                    @else
                                        <td><a href="#"><img src="../uploads/{{$item->avatar}}" class="img-circle" title="{{$item->name}}" alt="{{$item->name}}" width="50" height="50"></a></td>
                                    @endif
                                    <td><a href="#">{{$item->name}}</a></td>
                                    <td>{{$item->birthday}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>
                                        <a href="{{route('add-new-member')}}">Thêm </a>
                                        <a href="{{route('edit-member', ['userId'=> $item->id])}}">Sửa </a>
                                        @if($item->roles_id == 1)
                                            <a href="#" onclick="confirm('Bạn có chắc chắn muốn xóa thành viên này không?')">
                                                Xóa<span class="glyphicon glyphicon-remove"></span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
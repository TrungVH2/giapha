@extends('layouts.admin_app')
@section('js_common')
    <script>
        function showImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#txtimage')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        function checkControllParent(input) {
            $('#motherSelect').show();
        }
        
        function checkControllWife(input) {
            $('#motherSelect').hide();
        }
        function getWifeOrHusband(user)
        {
            var userId = user.selectedIndex;
            if(userId != null && userId != ''){
                $.ajax(
                    {
                        url: '?userId=' + userId,
                        type: 'Get',
                        dataType: 'html'
                    }
                ).done(function (data) {
                    alert(data);
                    }
                ).fail(function (jqXHR, ajaxOptions, thrownError) {
                        alert('Xảy ra lỗi');
                    }
                )
            }
        }
    </script>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card spur-card">
                    <div class="card-header">
                        <div class="spur-card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="spur-card-title"> Thêm mới</div>
                    </div>
                    <div class="card-body">
                        @if (Session()->has('error'))
                            <div class="alert alert-success">
                                <ul>
                                    {!! Session::get('error') !!}
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('successful'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! Session::get('successful') !!}</li>
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('post-add-new-member')}}" method="POST" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group col-sm-12">
                                <label style="color: blue;">Bạn là ai?</label>
                                <br>
                                <label class="radio-inline">
                                    <input type="radio" name="optionsRadiosIsParent" onchange="checkControllParent(this)" id="optionsRadiosInline2" value="0" checked>
                                    Con của cha/mẹ (Bố/Mẹ)  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="optionsRadiosIsParent" onchange="checkControllWife(this)" id="optionsRadiosInline1" value="1" >
                                    Vợ/chồng của
                                </label>
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtparent_id') ? ' has-error' : '' }}">
                                <select class="form-control" name="txtparent_id" onchange="getWifeOrHusband(this)" id="txtparent">
                                    <option value= "" selected>-- Chọn người liên quan --</option>
                                    @foreach($listParent as $user)
                                            <option value= "{{$user->id}}"  @if(Request::old('txtparent_id') == $user->id) selected @endif>- {{$user->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('txtparent_id'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtparent_id') }}</strong>
                                    </san>
                                @endif
                                <label for="mother"></label>
                                <select class="form-control" id="motherSelect">
                                    <option>Vo A1 - </option>
                                    <option>Vo A2</option>
                                    <option>Vo A3</option>
                                    <option>Vo A4</option>
                                    <option>Vo A5</option>
                                </select>

                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtname') ? ' has-error' : '' }}">
                                <label class="col-form-lable" for="exampleFormControlInput1">Họ và tên *</label>
                                <input type="text" class="form-control" name="txtname" id="exampleFormControlInput1" placeholder=".........">
                                @if ($errors->has('txtname'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtname') }}</strong>
                                    </san>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <img src="../img/avatar.png" width="205" id="txtimage" height="250" class="float-left border" alt="avatar">
                                <label class="col-sm-12" for="choose-img"></label>
                                <input type="file" onchange="showImage(this)" name="fileAvatar" class="form-control-file magin-top" id="choose-img" accept="image/gif, image/jpg, image/png">
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtbirthday') ? ' has-error' : '' }}">
                                <label for="exampleFormControlInput1">Ngày sinh</label>
                                <input type="date" name="txtbirthday" class="form-control col-sm-6" id="txtbirthday" placeholder=" ">
                                @if ($errors->has('txtbirthday'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtbirthday') }}</strong>
                                    </san>
                                @endif
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtdieldate_at') ? ' has-error' : '' }}">
                                <label for="exampleFormControlInput1">Ngày mất</label>
                                <input type="date" name="txtdieldate_at" class="form-control col-sm-6" id="txtdieldate" placeholder=" ">
                                @if ($errors->has('txtdieldate_at'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtdieldate_at') }}</strong>
                                    </san>
                                @endif
                            </div>
                            <div class="form-group row col-sm-12 {{ $errors->has('txtgender') ? ' has-error' : '' }}">
                                <label for="exampleFormControlInput1" class="col-sm-3">Giới tính</label>
                                <div class="custom-control custom-radio col-sm-2">
                                    <input type="radio" id="customRadio1" name="txtgender" checked value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Nam</label>
                                </div>
                                <div class="custom-control custom-radio col-sm-4">
                                    <input type="radio" id="customRadio2" name="txtgender" value="0" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Nữ</label>
                                </div>
                                @if ($errors->has('txtgender'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtgender') }}</strong>
                                    </san>
                                @endif
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtaddress') ? ' has-error' : '' }}">
                                <label for="exampleFormControlInput1">Địa chỉ</label>
                                <input type="text" class="form-control" name="txtaddress" id="exampleFormControlInput1" placeholder=" ">
                                @if ($errors->has('txtaddress'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtaddress') }}</strong>
                                    </san>
                                @endif
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtphone') ? ' has-error' : '' }}">
                                <label for="exampleFormControlInput1">Điện thoại</label>
                                <input type="number" class="form-control" name="txtphone" id="exampleFormControlInput1" placeholder=" ">
                                @if ($errors->has('txtphone'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtphone') }}</strong>
                                    </san>
                                @endif
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtemail') ? ' has-error' : '' }}">
                                <label for="exampleFormControlInput1">Email</label>
                                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="vohuy...@gmail.com">
                                @if ($errors->has('txtemail'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtemail') }}</strong>
                                    </san>
                                @endif
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtdescription') ? ' has-error' : '' }}">
                                <label for="exampleFormControlTextarea1">Tiểu sử</label>
                                <textarea class="form-control" name="txtdescription" id="exampleFormControlTextarea1" rows="3"></textarea>
                                @if ($errors->has('txtdescription'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtdescription') }}</strong>
                                    </san>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary float-right m-2">Đăng ký</button>
                            <button type="clear" class="btn btn-primary float-right m-2">Nhập lại</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card spur-card">
                    <div class="card-header">
                        <div class="spur-card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="spur-card-title"> Gia đình</div>
                    </div>
                    <div class="card-body">
                        cay gia đình 3 thế hệ.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

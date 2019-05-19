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
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $(document).ready(function(){
            $('#motherSelect').hide();

            $("#dieldate").click(function(){
                $("#txtdieldate").toggle();
            });

            $("#txtparent").change(function(e) {
                var userId = this.value;

                if(userId != null && userId != ''){
                    $.ajax({
                        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                        url: "{{ route('get-wife-husband') }}",
                        method: 'POST',
                        data : {userId:userId, _token: "{{ csrf_token() }}"},
                        dataType: 'html',
                        success: function(data){
                            if(data)
                            {  $_data = $.parseJSON(data);
                                $options ='';
                                $.each( $_data['wifeHusband'], function( key, value ) {
                                    $options +=  ' <option selected value="'+value['id']+'"> - '+ value['name'] +'</option>';
                                });
                                if($options!= ''){
                                    $("#motherSelect").html($options);
                                    $("#motherSelect").show();
                                }else{
                                    $("#motherSelect").html('');
                                    $("#motherSelect").hide();
                                }
                            }else{
                                $("#motherSelect").html('');
                                $("#motherSelect").hide();
                            }
                        },
                        error: function(error){
                            console.log(error)
                        }
                    });
                }
                else {
                    $("#motherSelect").html('');
                    $("#motherSelect").hide();
                }
            });
        });
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
                                <select class="form-control" name="txtparent_id" id="txtparent">
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
                                <select class="form-control" name="mother_id" id="motherSelect">
                                    {{--<option selected disabled >chưa có vợ/chồng</option>--}}
                                </select>

                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtname') ? ' has-error' : '' }}">
                                <label class="col-form-lable" for="exampleFormControlInput1">Họ và tên *</label>
                                <input type="text" class="form-control" name="txtname" id="txtname" placeholder="">
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
                                <label id="dieldate" style="color: #1b4b72; ">Ngày mất <i class="fas fa-arrow-down"></i></label>
                                <input type="date" style="display: none" name="txtdieldate_at" class="form-control col-sm-6" id="txtdieldate" placeholder=" ">
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
                            <div class="form-group col-sm-12 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="exampleFormControlInput1">Email</label>
                                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="vohuy...@gmail.com">
                                @if ($errors->has('email'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                        <div class="spur-card-title"> Gia đình:<label id="gduser"></label></div>
                    </div>
                    <div class="card-body">
                        <label for="granderFather" class="float-left">Bố mẹ:</label>
                        <div class="form-group col-sm-12 text-center">
                            <img src="../uploads/avatar.png" title="" width="100" id="txtimagefather" height="125" class="border" alt="">
                            <img src="../uploads/avatar.png" title="" width="100" id="txtimagefather" height="125" class="border" alt="">
                        </div>
                        <label for="granderFather" class="float-left">Tôi--:</label>
                        <div class="form-group col-sm-12 text-center">
                            <img src="../uploads/avatar.png" title="" width="100" id="txtimagefather" height="125" class="border" alt="">
                            <img src="../uploads/avatar.png" title="" width="100" id="txtimagefather" height="125" class="border" alt="">
                        </div>
                        <label for="granderFather" class="float-left">Các con:</label>
                        <div class="form-group col-sm-12 text-center">
                            <img src="../uploads/avatar.png" title="" width="100" id="txtimagefather" height="125" class="border" alt="">
                            <img src="../uploads/avatar.png" title="" width="100" id="txtimagefather" height="125" class="border" alt="">
                            <img src="../uploads/avatar.png" title="" width="100" id="txtimagefather" height="125" class="border" alt="">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

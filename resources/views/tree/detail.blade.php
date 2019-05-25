@extends('layouts.app')

@section('tree')
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
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

        //Choose img for child
        function showChildImage(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#txtimageChild')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function checkControllParent(input) {
            $('#motherSelect').show();
        }

        function checkControllWife(input) {
            $("#motherSelect").html('');
            $("#motherSelect").hide();
        }

        function checkChild(input){
            $(".husband_wife").hide();
            $(".add-child").show();
            $(".wife-show").show();
        }

        function checkHusbandWife(){
            $(".add-child").hide();
            $(".husband_wife").show();
            $(".wife-show").hide();
        }

        $(document).ready(function(){

            $(".husband_wife").hide();

            if($("#optionsRadiosInline1").is(":checked"))
            {
                $("#motherSelect").html('');
                $("#motherSelect").hide();
            }

            if($("#txtdieldate").val() =='')
            {
                $("#txtdieldate").css("display", "none")
            }

            $("#dieldate").click(function(){
                $("#txtdieldate").toggle();
            });

            $("#txtparent").change(function(e) {
                var userId = this.value;
                var parentId = $("#"+this.value).val();
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

                                //Set data family when choose people relationship
                                $grandparent = '';
                                $isparent = '';
                                $ischild = '';
                                $.each($_data['familyUser'], function( key, value ){
                                    $item = ' '
                                        +'<div class="float-left mx-2">'
                                        +'<img src="/uploads/'+value['avatar']+'" title="'+value['name']+'" width="100"  id="txtimagefather" height="125" class="border" alt="'+value['name']+'"><br/>'
                                        +'<label for="name" >'+value['name']+'</label>'
                                        +'</div>';
                                    if(value['id'] == parentId || value['husband_wife_id'] == parentId)
                                    {
                                        $grandparent += $item;
                                    }

                                    if(value['id'] == userId || value['husband_wife_id'] == userId)
                                    {
                                        $isparent +=$item;
                                    }

                                    if(value['parent_id'] == userId)
                                    {
                                        $ischild +=$item;
                                    }
                                });
                                if($grandparent!= ''){
                                    $(".grandparent").html($grandparent);
                                }else{
                                    $(".grandparent").html('');
                                }

                                if($isparent!= ''){
                                    $(".is-parent").html($isparent);
                                }else{
                                    $(".is-parent").html('');
                                }

                                if($ischild!= ''){
                                    $(".is-child").html($ischild);
                                }else{
                                    $(".is-child").html('');
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6" style="margin-bottom: 5px">
                <div class="card spur-card">
                    <div class="card-header">
                        <div class="spur-card-title"><i class="fas fa-user-shield"></i>   Gia đình 3 thế hệ của : <label style="color: blue;">{{$user->name}}</label></div>
                    </div>
                    <div class="card-body ">
                        <div class="form-row col-sm-12">
                            <label for="granderFather" class="float-left">Bố mẹ:</label>
                            <div class="form-group mx-auto grandparent text-center">
                                @if($parent)
                                    @foreach($parent as $item)
                                        <div class="float-left mx-2">
                                            <img src="/uploads/{{$item->avatar?$item->avatar:'avatar.png'}}" title="{{$item->name}}" width="100" id="txtimagefather" height="125" class="border" alt="{{$item->name}}"><br/>
                                            <label for="txtimagefather" >{{$item->name}}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="form-row col-sm-12">
                            <label for="father" class="float-left">Tôi:</label>
                            <div class="form-group mx-auto is-parent text-center">
                                <div class="float-left mx-2">
                                    <img src="/uploads/{{$user->avatar?$user->avatar:'avatar.png'}}" title="{{$user->name}}"  width="100" id="txtimageuser" height="125" class="border" alt="{{$user->name}}"><br/>
                                    <label for="xxx" >{{$user->name}}</label>
                                </div>
                                @foreach($listParent as $item)
                                    @if($item->husband_wife_id == $user->id || $item->id == $user->husband_wife_id)
                                        <div class="float-left mx-2">
                                            <img src="/uploads/{{$item->avatar?$item->avatar:'avatar.png'}}" title="{{$item->name}}"  width="100" id="txtimagewife" height="125" class="border" alt="{{$item->name}}"><br/>
                                            <label for="ccc" >{{$item->name}}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="form-row col-sm-12">
                            <label for="children" class="float-left">Các con:</label>
                            <div class="form-group mx-auto is-child text-center">
                                @if(count($children) > 0)
                                    @foreach($children as $item)
                                        <div class="float-left mx-2">
                                            <img src="/uploads/{{$item->avatar?$item->avatar:'avatar.png'}}" width="100" title="{{$item->name}}"  id="txtimagechildren" height="125" class="border" alt="{{$item->name}}"><br/>
                                            <label for="cccai" >{{$item->name}}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div  class="col-sm-12 float-right pb-2">
                        @auth()
                            @if(Auth::user()->id = $user->id || ($user->roles_id = 1) || (Auth::user()->id = $user->parent_id))
                                <button type="button" class="addChild btn btn-primary m-md-2 float-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fas fa-user-plus"></i>  Thêm thành viên mới</button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card spur-card">
                    <div class="card-header">
                        <div class="spur-card-title"> <i class="fas fa-paperclip"></i> Thông tin cá nhân : <label style="color: blue;">{{$user->name}}</label></div>
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
                        <form aria-disabled="true" action="{{route('save-edit-member')}}" method="POST" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <label style="color: blue;">Bạn là ai?</label>
                            <div class="form-group row radio-inline col-sm-12">
                                <div class="col-sm-6">
                                    <input type="radio" @guest disabled @endguest name="optionsRadiosIsParent" onchange="checkControllParent(this)" id="optionsRadiosInline2" value="0"
                                           @if(isset($user->parent_id)|| (!isset($user->parent_id) && !isset($user->husband_wife_id))) checked @endif>
                                    <label >Con của cha/mẹ (Bố/Mẹ)</label>
                                </div>
                                <div class="col-sm-6 p-lg-0">
                                    <input type="radio" @guest disabled @endguest name="optionsRadiosIsParent" onchange="checkControllWife(this)" id="optionsRadiosInline1" value="1"
                                           @if(isset($user->husband_wife_id)) checked @endif>
                                    <label  >Vợ/chồng của</label>
                                </div>

                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtparent_id') ? ' has-error' : '' }}">
                                <select class="form-control" @guest disabled @endguest name="txtparent_id"  id="txtparent">
                                    <option value= "" selected>-- Chọn người liên quan --</option>
                                    @foreach($listParent as $item)
                                        @if(($item->id != $user->id && $item->parent_id != $user->id && $item->parent_id != null) || ($item->roles_id == 3))
                                            <option value= "{{$item->id}}"  @if(Request::old('txtparent_id') == $item->id) selected  @elseif(($item->id == $user->parent_id) || ($item->id == $user->husband_wife_id) ) selected @endif>- {{$item->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('txtparent_id'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtparent_id') }}</strong>
                                    </san>
                                @endif
                                    <label for="mother"></label>
                                    <select class="form-control" @guest disabled @endguest name="mother_id" id="motherSelect">
                                        @if($parent && !isset($user->husband_wife_id))
                                            @foreach($parent as $item)
                                                @if($item->husband_wife_id && !isset($user->husband_wife_id))
                                                    <option value= "{{$item->id}}"  @if(Request::old('mother_id') == $item->id) selected @endif>- {{$item->name}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtname') ? ' has-error' : '' }}">
                                <label class="col-form-lable" for="exampleFormControlInput1">Họ và tên *</label>
                                <input type="text" @guest disabled @endguest class="form-control" name="txtname" id="txtname" value="{{$user->name}}" placeholder=".........">
                                @if ($errors->has('txtname'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtname') }}</strong>
                                    </san>
                                @endif
                                <input type="text" hidden="true" class="form-control" name="txtuserid" id="txtuserid" value="{{$user->id }}">
                            </div>
                            <div class="form-group col-sm-6">
                                @if($user->avatar)
                                    <img src="/uploads/{{$user->avatar}}" width="205" id="txtimage" height="250" class="float-left border" alt="avatar">
                                @else
                                    <img src="/img/avatar.png" width="205" id="txtimage" height="250" class="float-left border" alt="avatar">
                                @endif
                                <label class="col-sm-12" for="choose-img"></label>
                                <input type="file" @guest disabled @endguest onchange="showImage(this)" name="fileAvatar" class="form-control-file magin-top" id="choose-img" accept="image/gif, image/jpg, image/png">
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtbirthday') ? ' has-error' : '' }}">
                                <label for="exampleFormControlInput1">Ngày sinh</label>
                                <input type="date" @guest disabled @endguest name="txtbirthday" class="form-control col-sm-6" id="txtbirthday" value="{{$user->birthday}}" placeholder=" ">
                                @if ($errors->has('txtbirthday'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtbirthday') }}</strong>
                                    </san>
                                @endif
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtdieldate_at') ? ' has-error' : '' }}">
                                <label id="dieldate" style="color: #1b4b72; ">Ngày mất <i class="fas fa-hand-point-left"></i></label>
                                <input type="date" @guest disabled @endguest name="txtdieldate_at" class="form-control col-sm-6" id="txtdieldate" value="{{$user->dieldate_at}}"  placeholder=" ">
                                @if ($errors->has('txtdieldate_at'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtdieldate_at') }}</strong>
                                    </san>
                                @endif
                            </div>
                            <div class="form-group row col-sm-12 {{ $errors->has('txtgender') ? ' has-error' : '' }}">
                                <label for="exampleFormControlInput1" class="col-sm-3">Giới tính</label>
                                <div class="custom-control custom-radio col-sm-2">
                                    <input type="radio" @guest disabled @endguest id="customRadio1" name="txtgender" @if($user->gender==1) checked @endif value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Nam</label>
                                </div>
                                <div class="custom-control custom-radio col-sm-4">
                                    <input type="radio" @guest disabled @endguest id="customRadio2" name="txtgender" @if($user->gender==0) checked @endif value="0" class="custom-control-input">
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
                                <input type="text" @guest disabled @endguest class="form-control" name="txtaddress" value="{{$user->address}}" id="txtaddress" placeholder=" ">
                                @if ($errors->has('txtaddress'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtaddress') }}</strong>
                                    </san>
                                @endif
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtphone') ? ' has-error' : '' }}">
                                <label for="exampleFormControlInput1">Điện thoại</label>
                                <input type="number" @guest disabled @endguest class="form-control" name="txtphone" value="{{$user->phone}}" id="txtphone" placeholder=" ">
                                @if ($errors->has('txtphone'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtphone') }}</strong>
                                    </san>
                                @endif
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtemail') ? ' has-error' : '' }}">
                                <label for="exampleFormControlInput1">Email</label>
                                <input type="email" @guest disabled @endguest class="form-control" name="email" value="{{$user->email}}" id="email" placeholder="vohuy...@gmail.com">
                                @if ($errors->has('txtemail'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtemail') }}</strong>
                                    </san>
                                @endif
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('txtdescription') ? ' has-error' : '' }}">
                                <label for="exampleFormControlTextarea1">Tiểu sử</label>
                                <textarea @guest disabled @endguest class="form-control" name="txtdescription" id="txtdescription" rows="3">{{$user->description}}</textarea>
                                @if ($errors->has('txtdescription'))
                                    <san class="help-block">
                                        <strong>{{ $errors->first('txtdescription') }}</strong>
                                    </san>
                                @endif
                            </div>
                            @auth
                                @if(Auth::user()->id = $user->id || ($user->roles_id = 1))
                                    <button type="submit"  class="btn btn-primary float-right m-2"><i class="fas fa-save"></i>   Lưu sửa đổi</button>
                                    <button type="reset"  value="Reset" class="btn btn-primary float-right m-2"><i class="fas fa-researchgate"></i>  Nhập lại</button>
                                @endif
                            @endauth
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($listParent as $item)
        <input type="hidden" class="form-control" value="{{$item->parent_id}}" id="{{$item->id}}">
    @endforeach
    <!--Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Khai báo thông tin thành viên trong gia đình!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('add-child-wife-husband')}}" method="POST" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group col-sm-12">
                            <label for="ddd" class="col-sm-12" style="color: blue;">Chọn thành viên muốn thêm</label>
                            <div class="row col-sm-10 mx-auto">
                                <div class="custom-control custom-radio col-sm-4">
                                    <input type="radio" id="txtchild1" onchange="checkChild(this);" name="txtchild" checked value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="txtchild1">Thêm con</label>
                                </div>
                                <div class="custom-control custom-radio col-sm-6">
                                    <input type="radio" id="txtchild2" onchange="checkHusbandWife(this);" name="txtchild" value="0" class="custom-control-input">
                                    <label class="custom-control-label" for="txtchild2">Thêm vợ/chồng</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <input type="text" disabled class="form-control" name="parent_name" id="parent_id" value="{{$user->name}}">
                            <input type="hidden" class="form-control" name="parent_id" id="parent_id" value="{{$user->id}}">
                        </div>
                        <div class="form-group wife-show col-sm-12 {{ $errors->has('mother_id') ? ' has-error' : '' }}">
                            <label class="col-form-lable" for="txtmother">Vợ/chồng </label>
                            <select class="form-control" name="mother_id" id="txtmother">
                                @foreach($listParent as $item)
                                    @if($item->husband_wife_id == $user->id)
                                        <option value= "{{$item->id}}"  @if(Request::old('mother_id')) selected @endif>- {{$item->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-12 {{ $errors->has('txtname') ? ' has-error' : '' }}">
                            <label class="col-form-lable add-child" for="exampleFormControlInput1">Họ tên con *</label>
                            <label class="col-form-lable husband_wife" for="txtmother">Họ tên vợ/chồng </label>
                            <input type="text" class="form-control" required name="txtname" id="txtname" value="@if(Request::old('txtname')) {{Request::old('txtname') }}@endif" placeholder="">
                            @if ($errors->has('txtname'))
                                <san class="help-block">
                                    <strong>{{ $errors->first('txtname') }}</strong>
                                </san>
                            @endif
                        </div>
                        <div class="form-group col-sm-6">
                            <img src="/img/avatar.png" width="150" id="txtimageChild" height="175" class="float-left border" alt="avatar">
                            <label class="col-sm-12" for="choose-img"></label>
                            <input type="file" onchange="showChildImage(this)" name="fileAvatar" class="form-control-file magin-top" id="choose-img-child" accept="image/gif, image/jpg, image/png">
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
                        <div class="form-group row col-sm-12 {{ $errors->has('add-gender') ? ' has-error' : '' }}">
                            <label for="ffff" class="col-sm-3">Giới tính</label>
                            <div class="custom-control custom-radio col-sm-2">
                                <input type="radio" id="customRadio3" name="add-gender" checked value="1" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio3">Nam</label>
                            </div>
                            <div class="custom-control custom-radio col-sm-4">
                                <input type="radio" id="customRadio4" name="add-gender" value="0" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio4">Nữ</label>
                            </div>
                            @if ($errors->has('add-gender'))
                                <san class="help-block">
                                    <strong>{{ $errors->first('add-gender') }}</strong>
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
                        <input type="hidden" class="form-control" name="txtaddress" id="exampleFormControlInput1" value="{{$user->address}}">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class=""></i>Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal-->
@endsection

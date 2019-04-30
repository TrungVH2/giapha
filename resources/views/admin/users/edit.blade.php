@extends('layouts.admin_app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card spur-card">
                    <div class="card-header">
                        <div class="spur-card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="spur-card-title"> Chỉnh sửa</div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group col-sm-12">
                                <label for="exampleFormControlSelect1">Cha/Mẹ (Bố/Mẹ) *</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Vo A1 - </option>
                                    <option>Vo A2</option>
                                    <option>Vo A3</option>
                                    <option>Vo A4</option>
                                    <option>Vo A5</option>
                                </select>
                                <label for="mother"></label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>BÀ 1 - </option>
                                    <option>BÀ 2</option>
                                    <option>BÀ 3</option>
                                    <option>BÀ 4</option>
                                    <option>BÀ 5</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                    <label class="col-form-lable" for="exampleFormControlInput1">Tên con *</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                            </div>
                            <div class="form-group col-sm-6">
                                <img src="../images/avatar.png" width="205" height="250" class="float-left border" alt="avatar">
                                <label class="col-sm-12" for="choose-img"></label>
                                <input type="file" class="form-control-file magin-top" id="choose-img">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="exampleFormControlInput1">Ngày sinh</label>
                                <input type="date" class="form-control col-sm-6" id="exampleFormControlInput1" placeholder=" ">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="exampleFormControlInput1">Ngày mất</label>
                                <input type="date" class="form-control col-sm-6" id="exampleFormControlInput1" placeholder=" ">
                            </div>
                            <div class="form-group row col-sm-12">
                                <label for="exampleFormControlInput1" class="col-sm-3">Giới tính</label>
                                <div class="custom-control custom-radio col-sm-2">
                                    <input type="radio" id="customRadio1" name="customRadio" checked class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Nam</label>
                                </div>
                                <div class="custom-control custom-radio col-sm-4">
                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Nữ</label>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="exampleFormControlInput1">Địa chỉ</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder=" ">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="exampleFormControlInput1">Điện thoại</label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder=" ">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="exampleFormControlInput1">Email</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder=" ">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="exampleFormControlTextarea1">Tiểu sử</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <button type="clear" class="btn btn-primary ">Nhập lại</button>
                            <button type="submit" class="btn btn-primary ">Đăng ký</button>
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

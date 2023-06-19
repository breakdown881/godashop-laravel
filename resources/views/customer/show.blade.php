@extends('layout.app')
@section('content')
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Tài khoản</span></li>
                </ol>
            </div>
            <div class="clearfix"></div>
            @include('customer.sidebar')
            <div class="col-md-9 account">
                <div class="row">
                    <div class="col-xs-6">
                        <h4 class="home-title">Thông tin tài khoản</h4>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <form class="info-account" action="{{route("customer.update")}}" method="POST" role="form">
                            @csrf
                            <div class="form-group">
                                <input type="text" value="{{Auth()->user()->name}}" class="form-control" name="fullname" placeholder="Họ và tên" required="" oninvalid="this.setCustomValidity('Vui lòng nhập tên của bạn')" oninput="this.setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <input type="tel" value="{{Auth()->user()->mobile}}" class="form-control" name="mobile" placeholder="Số điện thoại" required="" pattern="[0][0-9]{9,}" oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại bắt đầu bằng số 0 và ít nhất 9 con số theo sau')" oninput="this.setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="old_password" placeholder="Mật khẩu hiện tại">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Mật khẩu mới" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" oninvalid="this.setCustomValidity('Vui lòng nhập ít nhất 8 ký tự: số, chữ hoa, chữ thường')" oninput="this.setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="re-password" placeholder="Nhập lại mật khẩu mới" autocomplete="off" autosave="off" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" oninvalid="this.setCustomValidity('Vui lòng nhập ít nhất 8 ký tự: số, chữ hoa, chữ thường')" oninput="this.setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
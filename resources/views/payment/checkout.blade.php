@extends('layout.app')
@section('content')
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Giỏ hàng</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Thông tin giao hàng</span></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <aside class="col-md-6 cart-checkout">
                @foreach (Cart::content() as $item)
                <div class="row">
                    <div class="col-xs-2">
                        <img class="img-responsive" src="{{asset("")}}/images/{{$item->options->image}}" alt="{{$item->name}}"> 
                    </div>
                    <div class="col-xs-7">
                        @php
                        $prefixSlug = \Str::slug($item->name);
                        $slug = "{$prefixSlug}-{$item->id}"
                        @endphp
                        <a class="product-name" href="{{route("product.show", ["slug" => $slug])}}">{{$item->name}}</a> 
                        <br>
                        <span>{{$item->qty}}</span> x <span>{{number_format($item->price)}}₫</span>
                    </div>
                    <div class="col-xs-3 text-right">
                        <span>{{number_format($item->qty * $item->price)}}₫</span>
                    </div>
                </div>
                <hr>
                @endforeach
                <div class="row">
                    <div class="col-xs-6">
                        Tạm tính
                    </div>
                    {{-- data="{{Cart::priceTotal(0,"","")}}" --}}
                    <div class="col-xs-6 text-right priceTotal">
                        {{Cart::priceTotal()}}₫
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        Giảm giá
                    </div>
                    <div class="col-xs-6 text-right discount">
                        - {{Cart::discount()}}₫
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        Tổng tiền
                    </div>
                    <div class="col-xs-6 text-right subTotal">
                        {{Cart::subTotal()}}₫
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        VAT
                    </div>
                    <div class="col-xs-6 text-right tax">
                        {{Cart::tax()}}₫
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        Tổng tiền bao gồm VAT
                    </div>
                    <div class="col-xs-6 text-right total" data="{{Cart::total(0,"","")}}">
                        {{Cart::total()}}₫
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        Phí vận chuyển
                    </div>
                    <div class="col-xs-6 text-right">
                        <span class="shipping-fee" data="">{{number_format($shipping_fee)}}₫</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-3">
                        Mã giảm giá
                    </div>
                    <div class="col-xs-9 text-right">
                        <form action="{{route("cart.discount")}}">
                            <input class="form-control" type="text" name="discount-code" id="discount-code" placeholder="Mã giảm giá" value="{{request()->session()->get("discount_code")}}">
                            <div class="alert alert-danger">{{request()->session()->get("error_discount_code")}}</div>
                            <button type="submit" class="btn btn-primary">Sử dụng</button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        Thành tiền
                    </div>
                    <div class="col-xs-6 text-right">
                        @php
                            $total = $shipping_fee + Cart::total(0,"","");
                        @endphp
                        <span class="payment-total">{{number_format($total)}}₫</span>
                    </div>
                </div>
            </aside>
            <div class="ship-checkout col-md-6">
                <h4>Thông tin giao hàng</h4>
                @guest
                <div>Bạn đã có tài khoản? <a href="javascript:void(0)" class="btn-login">Đăng Nhập  </a></div>
                <br>
                @endguest
                <form action="{{route("payment.store")}}" method="POST">
                    @csrf
                    @include('layout.shippingAddress')
                    <h4>Phương thức thanh toán</h4>
                    <div class="form-group">
                        <label> <input type="radio" name="payment_method" checked="" value="0"> Thanh toán khi giao hàng (COD) </label>
                        <div></div>
                    </div>
                    <div class="form-group">
                        <label> <input type="radio" name="payment_method" value="1"> Chuyển khoản qua ngân hàng </label>
                        <div class="bank-info">STK: 0421003707901<br>Chủ TK: Nguyễn Hữu Lộc. Ngân hàng: Vietcombank TP.HCM <br>
                            Ghi chú chuyển khoản là tên và chụp hình gửi lại cho shop dễ kiểm tra ạ
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm btn-primary pull-right">Hoàn tất đơn hàng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
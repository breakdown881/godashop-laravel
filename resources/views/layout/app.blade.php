<!DOCTYPE html>
<html>

<head>
    <title>Trang chủ - Mỹ Phẩm Goda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}/images/logo.jpg" />
    <link rel="stylesheet" href="{{ asset('') }}vendor/fontawesome-free-5.11.2-web/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('') }}vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('') }}vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('') }}vendor/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('') }}vendor/star-rating/css/star-rating.min.css">
    <link rel="stylesheet" href="{{ asset('') }}css/style.css">
    <script src="{{ asset('') }}vendor/jquery.min.js"></script>
    <script src="{{ asset('') }}vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}vendor/star-rating/js/star-rating.min.js"></script>
    {!! NoCaptcha::renderJs() !!}
    <script src="{{ asset('') }}vendor/format/number_format.js"></script>
    <script src="{{ asset('') }}vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}js/script.js"></script>
</head>

<body>
    @php
        $currentRoute = Route::currentRouteName();
    @endphp

    <header>
        <!-- use for ajax -->
        <input type="hidden" id="reference" value="">
        <!-- Top Navbar -->
        <div class="top-navbar container-fluid">
            <div class="menu-mb">
                <a href="javascript:void(0)" class="btn-close" onclick="closeMenuMobile()">×</a>
                <a class="{{ $currentRoute == 'index' ? 'active' : '' }}" href="{{ route('index') }}">Trang chủ</a>
                <a class="{{ in_array($currentRoute, ['product.index', 'category.show']) ? 'active' : '' }}"
                    href="{{ route('product.index') }}">Sản phẩm</a>
                <a href="chinh-sach-doi-tra.html">Chính sách đổi trả</a>
                <a href="chinh-sach-thanh-toan.html">Chính sách thanh toán</a>
                <a href="chinh-sach-giao-hang.html">Chính sách giao hàng</a>
                <a href="lien-he.html">Liên hệ</a>
            </div>
            <div class="row">
                <div class="hidden-lg hidden-md col-sm-2 col-xs-1">
                    <span class="btn-menu-mb" onclick="openMenuMobile()"><i
                            class="glyphicon glyphicon-menu-hamburger"></i></span>
                </div>
                <div class="col-md-6 hidden-sm hidden-xs">
                    <ul class="list-inline">
                        <li><a href="https://www.facebook.com/HocLapTrinhWebTaiNha.ThayLoc"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://www.pinterest.com/"><i class="fab fa-pinterest"></i></a></li>
                        <li><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-10 col-xs-11">
                    <ul class="list-inline pull-right top-right">
                        <li class="account-login">
                            @auth
                                <a href="{{ route('customer.orders') }}" class="btn-logout">Đơn hàng của tôi</a>
                            @endauth
                            @guest
                                <a href="javascript:void(0)" class="btn-register">Đăng Ký</a>
                            @endguest
                        </li>
                        <li>
                            @auth
                                <a href="javascript:void(0)" class="btn-account dropdown-toggle" data-toggle="dropdown"
                                    id="dropdownMenu">{{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu">
                                    <li><a href="{{ route('customer.show') }}">Thông tin tài khoản</a></li>
                                    <li><a href="{{ route('customer.address') }}">Địa chỉ giao hàng</a></li>
                                    <li><a href="{{ route('customer.orders') }}">Đơn hàng của tôi</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="javascript:void()"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Thoát
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            @endauth
                            @guest
                                <a href="javascript:void(0)" class="btn-login">Đăng Nhập </a>
                            @endguest
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End top navbar -->
        <!-- Header -->
        <div class="container">
            <div class="row">
                <!-- LOGO -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 logo">
                    <a href="#"><img src="{{ asset('') }}images/goda450x170_1.jpg"
                            class="img-responsive"></a>
                </div>
                <div class="col-lg-4 col-md-4 hidden-sm hidden-xs call-action">
                    <a href="#"><img src="{{ asset('') }}images/godakeben450x170.jpg"
                            class="img-responsive"></a>
                </div>
                <!-- HOTLINE AND SERCH -->
                <div class="col-lg-4 col-md-4 hotline-search">
                    <div>
                        <p class="hotline-phone"><span><strong>Hotline: </strong><a
                                    href="tel:091.610.6232">091.610.6232</a></span></p>
                        <p class="hotline-email"><span><strong>Email: </strong><a
                                    href="mailto:hoanghai170599@gmail.com">hoanghai170599@gmail.com</a></span></p>
                    </div>
                    <form class="header-form" action="{{ route('product.index') }}">
                        <div class="input-group">
                            <input type="search" class="form-control search" placeholder="Nhập từ khóa tìm kiếm"
                                name="search" autocomplete="off"
                                value="{{ request()->has('search') ? request()->input('search') : '' }}">
                            <div class="input-group-btn">
                                <button class="btn bt-search bg-color" type="submit"><i class="fa fa-search"
                                        style="color:#fff"></i>
                                </button>
                            </div>
                        </div>
                        <div class="search-result">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End header -->
    </header>
    <!-- NAVBAR DESKTOP-->
    <nav class="navbar navbar-default desktop-menu">
        <div class="container">
            <ul class="nav navbar-nav navbar-left hidden-sm hidden-xs">
                <li class="{{ $currentRoute == 'index' ? 'active' : '' }}">
                    <a href="{{ route('index') }}">Trang chủ</a>
                </li>
                <li class="{{ in_array($currentRoute, ['product.index', 'category.show']) ? 'active' : '' }}"><a
                        href="{{ route('product.index') }}">Sản phẩm </a></li>
                <li><a href="chinh-sach-doi-tra.html">Chính sách đổi trả</a></li>
                <li><a href="chinh-sach-thanh-toan.html">Chính sách thanh toán</a></li>
                <li><a href="chinh-sach-giao-hang.html">Chính sách giao hàng</a></li>
                <li><a href="lien-he.html">Liên hệ</a></li>
            </ul>
            <span class="hidden-lg hidden-md experience">Trải nghiệm cùng sản phẩm của Goda</span>
            @auth
                @php
                    Cart::destroy();
                    Cart::restore(Auth()->user()->email);
                    Cart::store(Auth()->user()->email);
                @endphp
            @endauth
            <ul class="nav navbar-nav navbar-right">
                <li class="cart"><a href="javascript:void(0)" class="btn-cart-detail" title="Giỏ Hàng"><i
                            class="fa fa-shopping-cart"></i> <span
                            class="number-total-product">{{ Cart::count() }}</span></a></li>
            </ul>
        </div>
    </nav>

    @include('layout.message');
    @yield('content');

    <!-- FOOTER -->
    <footer class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-4 list">
                            <div class="footerLink">
                                <h4>Danh mục</h4>
                                <ul class="list-unstyled">
                                    <li><a href="#">Kem Chống Nắng </a></li>
                                    <li><a href="#">Kem Dưỡng Da </a></li>
                                    <li><a href="#">Kem Trị Mụn </a></li>
                                    <li><a href="#">Kem Trị Thâm Nám </a></li>
                                    <li><a href="#">Sữa Rửa Mặt </a></li>
                                    <li><a href="#">Sữa Tắm </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-4 list">
                            <div class="footerLink">
                                <h4>Liên kết </h4>
                                <ul class="list-unstyled">
                                    <li><a href="san-pham.html">Sản phẩm </a></li>
                                    <li><a href="chinh-sach-doi-tra.html">Chính sách đổi trả</a></li>
                                    <li><a href="chinh-sach-thanh-toan.html">Chính sách thanh toán</a></li>
                                    <li><a href="chinh-sach-giao-hang.html">Chính sách giao hàng </a></li>
                                    <li><a href="lien-he.html">Liên hệ </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-4 list">
                            <div class="footerLink">
                                <h4>Liên hệ với chúng tôi </h4>
                                <ul class="list-unstyled">
                                    <li>Phone: 0932.538.468</li>
                                    <li><a href="mailto:nguyenhuulocla2006@gmail.com">Mail:
                                            nguyenhuulocla2006@gmail.com</a></li>
                                </ul>
                                <ul class="list-inline">
                                    <li><a href="https://www.facebook.com/HocLapTrinhWebTaiNha.ThayLoc"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="fab fa-pinterest"></i></a></li>
                                    <li><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 list">
                            <div class="newsletter clearfix">
                                <h4>Bản tin</h4>
                                <p>Nhập Email của bạn để chúng tôi cung cấp thông tin nhanh nhất cho bạn về những sản
                                    phẩm mới!!</p>
                                <form action="" method="POST">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Nhập email của bạn.."
                                            name="email">
                                        <button type="submit" class="btn btn-primary send pull-right">Gửi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->
    <!-- BACK TO TOP -->
    <div class="back-to-top" class="bg-color">▲</div>
    <!-- END BACK TO TOP -->
    <!-- REGISTER DIALOG -->
    <div class="modal fade" id="modal-register" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-color">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title text-center">Đăng ký</h3>
                </div>
                <form action="{{ route('register') }}" method="POST" role="form" name="registration"
                    style="font-weight:normal !important">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Họ và tên">
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" name="mobile" placeholder="Số điện thoại">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Mật khẩu">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Nhập lại mật khẩu">
                        </div>
                        <div class="form-group">
                            {!! app('captcha')->display() !!}
                            <input type="text" name="hiddenRecaptcha"
                                style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;">
                        </div>
                        <input type="hidden" name="reference" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END REGISTER DIALOG -->
    <!-- LOGIN DIALOG -->
    <div class="modal fade" id="modal-login" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-color">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title text-center">Đăng nhập</h3>
                    <!-- Google login -->
                    <br>
                    <div class="text-center">
                        <a class="btn btn-primary google-login" href="#"><i class="fab fa-google"></i></i> Đăng
                            nhập bằng Google</a>
                        <!-- Facebook login -->
                        <a class="btn btn-primary facebook-login" href="#"><i class="fab fa-facebook-f"></i>
                            Đăng nhập bằng Facebook</a>
                    </div>
                </div>
                <form id="login" action="{{ route('login') }}" method="POST" role="form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                        </div>
                        <input type="hidden" name="reference" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Đăng Nhập</button><br>
                        <div class="text-left">
                            <a href="javascript:void(0)" class="btn-register">Bạn chưa là thành viên? Đăng kí
                                ngay!</a>
                            <a href="javascript:void(0)" class="btn-forgot-password">Quên Mật Khẩu?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END LOGIN DIALOG -->
    <!-- FORTGOT PASSWORD DIALOG -->
    <div class="modal fade" id="modal-forgot-password" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-color">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title text-center">Quên mật khẩu</h3>
                </div>
                <form action="#" method="POST" role="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <input name="email" type="email" class="form-control" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="reference" value="">
                        <button type="submit" class="btn btn-primary">GỬI</button><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END FORTGOT PASSWORD DIALOG -->
    <!-- CART DIALOG -->
    <div class="modal fade" id="modal-cart-detail" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-color">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3 class="modal-title text-center">Giỏ hàng</h3>
                </div>
                <div class="modal-body">
                    <div class="page-content">
                        <div class="clearfix hidden-sm hidden-xs">
                            <div class="col-xs-1">
                            </div>
                            <div class="col-xs-3">
                                <div class="header">
                                    Sản phẩm
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="header">
                                    Đơn giá
                                </div>
                            </div>
                            <div class="label_item col-xs-3">
                                <div class="header">
                                    Số lượng
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="header">
                                    Thành tiền
                                </div>
                            </div>
                            <div class="lcol-xs-1">
                            </div>
                        </div>
                        <div class="cart-product">
                            @include('layout.cartitem')

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="clearfix">
                        <div class="col-xs-12 text-right">
                            <p>
                                <span>Tổng tiền</span>
                                <span class="price-total">{{ Cart::subtotal() }}₫</span>
                            </p>
                            <a href="{{ route('product.index') }}"><input type="button" name="back-shopping"
                                    class="btn btn-default" value="Tiếp tục mua sắm"></a>
                            <a href="{{ route('payment.create') }}"><input type="button" name="checkout"
                                    class="btn btn-primary" value="Đặt hàng"></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CART DIALOG -->
    <!-- Facebook Messenger Chat -->
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v4.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- Your customer chat code -->
    <div class="fb-customerchat" attribution=setup_tool page_id="112296576811987"
        logged_in_greeting="Chào bạn, bạn muốn mua sản phẩm nào bên GodaShop.com"
        logged_out_greeting="Chào bạn, bạn muốn mua sản phẩm nào bên GodaShop.com">
    </div>
    <!-- End Facebook Messenger Chat -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</body>

</html>

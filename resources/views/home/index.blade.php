@extends('layout.app')
@section('content')
<div class="slideshow container-fluid">
    <div class="row">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                <li data-target="#myCarousel" data-slide-to="2" class=""></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="../images/slider1.jpg" alt="slider 1">
                </div>

                <div class="item">
                    <img src="../images/slider_2.jpg" alt="slider 2">
                </div>

                <div class="item">
                    <img src="../images/slider_3.jpg" alt="slider 3">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<!-- END SLIDESHOW -->
<!-- SERVICES -->
<div class="top-services container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 item item-1">
            <div class="item-inner">
                <a class="item-inline" title="7 NGÀY ĐỔI TRẢ" href="#">
                    <span class="title-sv">7 NGÀY ĐỔI TRẢ</span>
                    <span>Chăm sóc khách hàng cực tốt</span>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 item item-2">
            <div class="item-inner">
                <a class="item-inline" title="MIỄN PHÍ SHIP" href="#">
                    <span class="title-sv">MIỄN PHÍ SHIP</span>
                    <span>Với dịch vụ giao hàng tiết kiệm</span>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 item item-3">
            <div class="item-inner">
                <a class="item-inline" title="BÁN BUÔN NHƯ BÁN SỈ" href="#">
                    <span class="title-sv">BÁN BUÔN NHƯ BÁN SỈ</span>
                    <span>Giá hợp lý nhất quả đất</span>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 item item-4">
            <div class="item-inner">
                <a class="item-inline" title="CHẤT LƯỢNG HÀNG ĐẦU" href="#">
                    <span class="title-sv">CHẤT LƯỢNG HÀNG ĐẦU</span>
                    <span>Chăm sóc bạn như người thân </span>
                </a>
            </div>
        </div>
    </div>
</div>
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row equal">
            <div class="col-xs-12">
                <h4 class="home-title">Sản phẩm nổi bật</h4>
            </div>
            @foreach ($featuredProducts as $product)
            <div class="col-xs-6 col-sm-3">
                @include('layout.products')
            </div>
            @endforeach
            
        </div>
        <div class="row equal">
            <div class="col-xs-12">
                <h4 class="home-title">Sản phẩm mới nhất</h4>
            </div>
            @foreach ($latestProducts as $product)
            <div class="col-xs-6 col-sm-3">
                @include('layout.products')
            </div>
            @endforeach
        </div>
        @php
            foreach($categoryProducts as $categoryName => $products): 
        @endphp
            <div class="row equal">
            <div class="col-xs-12">
                <h4 class="home-title">{{$categoryName}}</h4>
            </div>
            @foreach ($products as $product)
            <div class="col-xs-6 col-sm-3">
                @include('layout.products')
            </div>
            @endforeach
            
        </div>
        @php
            endforeach;
        @endphp
       
        
    </div>
</main>
@endsection
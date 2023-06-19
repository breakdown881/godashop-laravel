@extends('layout.app')
@section('content')
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>{{$product->category->name}}</span></li>
                </ol>
            </div>
            <div class="col-xs-3 hidden-lg hidden-md">
                <a class="hidden-lg pull-right btn-aside-mobile" href="javascript:void(0)">Bộ lọc <i class="fa fa-angle-double-right"></i></a>
            </div>
            <div class="clearfix"></div>
           @include('layout.sidebar');
            <div class="col-md-9 product-detail">
                <div class="row product-info">
                    <div class="col-md-6">
                        <img data-zoom-image="{{asset("")}}/images/{{$product->featured_image}}" class="img-responsive thumbnail main-image-thumbnail" src="{{asset("")}}/images/{{$product->featured_image}}" alt="">
                        <div class="product-detail-carousel-slider">
                            <div class="owl-carousel owl-theme">
                                <div class="item thumbnail"><img src="{{asset("")}}/images/{{$product->featured_image}}" alt=""></div>
                                @foreach ($product->imageItems as $imageItem)
                                <div class="item thumbnail"><img src="{{asset("")}}/images/{{$imageItem->name}}" alt=""></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="product-name">{{$product->name}}</h5>
                        <div class="brand">
                            <span>Nhãn hàng: </span> <span>{{$product->brand->name}}</span> 
                        </div>
                        <div class="product-status"> 
                            <span>Trạng thái: </span>
                            <span class="{{$product->inventory_qty != 0 ? "label-success" : "label-danger"}}">{{$product->inventory_qty != 0 ? "Còn hàng" : "Hết hàng"}}</span>
                        </div>
                        <div class="product-item-price">
                            <span>Giá: </span>
                            @if ($product->sale_price != $product->price)
                            <span class="product-item-discount">{{number_format($product->sale_price)}}₫</span> 
                            @else
                            <span class="product-item-discount">{{number_format($product->price)}}₫</span>  
                            @endif     
                        </div>
                        @if ($product->inventory_qty > 0)
                        <div class="input-group">
                            <input type="number" class="product-quantity form-control" value="1" min="1">
                            <a href="javascript:void(0)" product-id="{{$product->id}}" class="buy-in-detail btn btn-success cart-add-button"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
                       </div>
                        @endif
                    </div>
                </div>
                <div class="row product-description">
                    <div class="col-xs-12">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#product-description" aria-controls="home" role="tab" data-toggle="tab">Mô tả</a>
                                </li>
                                <li role="presentation">
                                    <a href="#product-comment" aria-controls="tab" role="tab" data-toggle="tab">Đánh giá</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="product-description">   
                                <p>Mô tả chi tiết</p>
                                {!!$product->description!!}
                            
                                </div>
                                <div role="tabpanel" class="tab-pane" id="product-comment">
                                    <form class="form-comment" action="{{route("comment.store")}}" method="POST" role="form">
                                        @csrf
                                        <label>Đánh giá của bạn</label>
                                        <div class="form-group">
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input class="rating-input" name="rating" type="text" title="" value="4"/>
                                            <input type="text" class="form-control" id="" name="fullname" placeholder="Tên *" required>
                                            <input type="email" name="email" class="form-control" id="" placeholder="Email *" required>
                                            <textarea name="description" id="input" class="form-control" rows="3" required placeholder="Nội dung *"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Gửi</button>
                                    </form>
                                    @php
                                        $comments = $product->comments;
                                        $comments = $comments->sortByDesc("created_date");
                                    @endphp
                                    <div class="comment-list">
                                        @foreach ($comments as $comment)
                                        <hr>
                                        <span class="date pull-right">{{$comment->created_date}}</span>
                                        <input class="answered-rating-input" name="rating" type="text" title="" value="{{$comment->star}}" readonly />
                                        <span class="by">{{$comment->fullname}}</span>
                                        <p>{{$comment->description}}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-related equal">
                    <div class="col-md-12">
                        <h4 class="text-center">Sản phẩm liên quan</h4>
                        <div class="owl-carousel owl-theme">
                            @php
                                $relatedProducts = $product->category->products;
                                $memoryProduct = $product;
                            @endphp
                            @foreach ($relatedProducts as $product)
                            @if ($memoryProduct->id != $product->id)
                            <div class="item thumbnail">
                                @include('layout.products');
                             </div>
                             @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
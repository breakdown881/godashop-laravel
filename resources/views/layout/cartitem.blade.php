@foreach (Cart::content() as $rowId => $item)
    <hr>
    <div class="clearfix text-left">
        <div class="row">
            <div class="col-sm-6 col-md-1">
                <div>
                    <img class="img-responsive" src="{{ asset('') }}/images/{{ $item->options->image }}"
                        alt="{{ $item->name }} ">
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <a class="product-name" href="#">{{ $item->name }}</a>
            </div>
            <div class="col-sm-6 col-md-2">
                <span class="product-item-discount">{{ number_format($item->price) }}₫</span>
            </div>
            <div class="col-sm-6 col-md-3">
                <input type="hidden" value="1"><input type="number"
                    onchange="updateProductInCart(this,'{{ $rowId }}')" min="1"
                    value="{{ $item->qty }}">
            </div>
            <div class="col-sm-6 col-md-2">
                <span>{{ number_format($item->qty * $item->price) }}₫</span>
            </div>
            <div class="col-sm-6 col-md-1">
                <a class="remove-product" href="javascript:void(0)"
                    onclick="deleteProductInCart('{{ $rowId }}')">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </div>
        </div>
    </div>
@endforeach

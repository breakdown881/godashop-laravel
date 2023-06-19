<ul class="list-unstyled">
	@foreach ($products as $product)
    @php
    $prefixSlug =  \Str::slug($product->name);
    $slug = "{$prefixSlug}-{$product->id}";
    @endphp
	<li>
		<a class="product-name" href="{{route("product.show", ["slug" => $slug])}}" title="{{$product->name}}">
            <img style="width:50px" src="{{asset("")}}/images/{{$product->featured_image}}" alt="">
            {{$product->name}}
        </a>
	</li>
	@endforeach
</ul>
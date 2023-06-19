@php
$prefixSlug = \Str::slug($product->name);
$slug = "{$prefixSlug}-{$product->id}"
@endphp
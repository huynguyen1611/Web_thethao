@if (isset($products) && count($products) > 0)
<section class="hot-products">
    <div class="container">
      <div class="row-grid">
        <p class="heading-text">Sản phẩm hot</p>
      </div>
      <div class="row-grid row-grid-hot-product">
        @foreach ($products as $product)
            <div class="hot-product-item">
                <a href="/frontend/product/{{ $product-> id }}"><img src="{{ asset($product->image) }}" alt="" /></a>
                <p><a href="/frontend/product/{{ $product-> id }}">{{ $product->name }}</a></p>
                <span>{{ $product->material }}</span>
                <div class="hot-product-item-price">
                    <p>
                        {{ number_format($product->price_sale, 0, ',', '.') }} <sup>đ</sup>
                        <span class="old-price">{{ number_format($product->price_nomal, 0, ',', '.') }} <sup>đ</sup></span>
                    </p>
                </div>
            </div>
        @endforeach
      </div>
    </div>
  </section>
@endif

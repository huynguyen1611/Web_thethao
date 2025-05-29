@extends('frontend.main')
@section('content')
    <section class="product-detail p-to-top">
        <form action="/cart/add" method="post" class="add-to-cart-form">
            <div class="container">
                <div class="row-flex row-flex-product-detail">
                    <p>Sản phẩm</p>
                    <i class="ri-arrow-right-line"></i>
                    <p>{{ $product->name }}</p>
                </div>
                <div class="row-grid">
                    <div class="product-detail-left">
                        <img class="main-img" src="{{ asset($product->image) }}" alt="" />
                        <div class="product-img-items">
                            @foreach ($listImages as $product_image)
                                <img src="{{ asset($product_image) }}" alt="">
                            @endforeach
                        </div>
                    </div>
                    <div class="product-detail-right">
                        <div class="product-detail-right-infor">
                            <h1>{{ $product->name }}</h1>
                            <span>{{ $product->material }}</span>
                            <div class="hot-product-item-price">
                                <p>
                                    {{ number_format($product->price_sale, 0, ',', '.') }} <sup>đ</sup>
                                    <span class="old-price">{{ number_format($product->price_nomal, 0, ',', '.') }}
                                        <sup>đ</sup></span>
                                </p>
                            </div>
                        </div>
                        <div class="row-flex">
                            <h2 class=" h2-heading">Đặt điểm nổi bật</h2>
                        </div>
                        <div class="product-detail-right-detail">
                            {!! $product->description !!}
                        </div>
                        <div class="product-detail-right-quantity">
                            <h2>Số lượng:</h2>
                            <div class="product-detail-right-quantity-input">
                                <i class="ri-subtract-line"></i>
                                <input onkeydown="return false" name="product_qty" class="quantity-input" type="number"
                                    value="1" />
                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                <i class="ri-add-line"></i>
                            </div>
                        </div>
                        <div class="product-detail-right-addcart">
                            <button type="submit" class="main-btn">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
                <div class="row-flex">
                    <h2 class=" h2-heading">Chi tiết sản phẩm</h2>
                </div>
                <div class="">
                    <div class="product-detail-content">
                        {!! $product->content !!}
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </section>
@endsection

@section('hot_product')
    @include('frontend.parts.hot_product')
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-to-cart-form').submit(function(e) {
            e.preventDefault();

            const form = $(this);
            const actionUrl = form.attr('action');
            console.log(actionUrl);
            console.log(form.serialize());

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    console.log(response);

                    if (response.success) {
                        alert('Đã thêm vào giỏ hàng!');
                        $('.ri-shopping-cart-2-fill').attr('number', response
                            .cart_count);
                    } else {
                        alert('Thêm vào giỏ hàng thất bại!');
                    }
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra!');
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

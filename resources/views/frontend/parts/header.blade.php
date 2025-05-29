<header id="header">
    <div class="container">
        <div class="row-flex">
            <div class="header-bar-icon">
                <i class="ri-menu-line"></i>
            </div>
            <div class="header-logo">
                <a href="/"><img src="{{ asset('frontend/asset/img/NQH Shop.png') }}" alt="" /></a>
            </div>
            <div class="header-logo-mobile">
                <a href="/"><img src="{{ asset('backend/asset/image/logo2.png') }}" alt="" /></a>
            </div>
            <div class="header-nav">
                <nav>
                    <ul>
                        <li><a href="">SẢN PHẨM</a></li>
                        <li><a href="">ĐỒ HÈ</a></li>
                        <li><a href="">MẶT HÀNG NGÀY</a></li>
                        <li><a href="">ĐỒ THỂ THAO</a></li>
                        <li><a href="">SẢN XUẤT RIÊNG</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header-search">
                <input type="text" placeholder="Tìm kiếm" />
                <i class="ri-search-eye-line"></i>
            </div>
            <div class="header-user">
                <a href="{{ route('edit_user') }}">
                    <i class="ri-user-3-line"></i>
                </a>
            </div>
            @php
                $cart = Session::get('cart');
                $cart = is_array($cart) ? $cart : []; // Nếu không phải array thì gán mảng rỗng
                $productCount = count($cart);
            @endphp
            <div class="header-cart">
                <a href="/frontend/cart">
                    <i class="ri-shopping-cart-2-fill" number="{{ $productCount }}"></i>
                </a>
            </div>

        </div>
    </div>
</header>

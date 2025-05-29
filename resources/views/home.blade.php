<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.parts.head')
</head>

<body>
    <!-- ------Header----------- -->
    @include('frontend.parts.header')
    <!-- -----------Slider------------- -->
    <section class="slider">
        <div class="slider-items">
            <div class="slider-item">
                <img src="{{ asset('frontend/asset/img/anhnen3.png') }}" alt="" />
            </div>
            <div class="slider-item">
                <img src="{{ asset('frontend/asset/img/anhnen2.png') }}" alt="" />
            </div>
            <div class="slider-item">
                <img src="{{ asset('frontend/asset/img/anhnen.png') }}" alt="" />
            </div>
        </div>
        <div class="slider-icon">
            <i class="ri-arrow-right-fill"></i>
            <i class="ri-arrow-left-fill"></i>
        </div>
    </section>
    <!-- --------Hot-product--------- -->
    @include('frontend.parts.hot_product')
    <!-- -------product - new -->
    @include('frontend.parts.product_new')
    <!-- ----footer----- -->
    @include('frontend.parts.footer')
</body>

</html>

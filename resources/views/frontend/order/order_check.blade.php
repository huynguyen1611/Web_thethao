@extends('frontend.main')
@section('content')
<section class="order-check p-to-top">
    <div class="container">
      <div class="row-flex row-flex-product-detail">
        <p>Xác nhận đơn hàng: <b>{{ $order->name }} #{{ $order->id }}</b></p>
      </div>
      <div class="row-flex">
        <div class="order-check-content">
          <p>
            Đơn hàng của bạn đã được gửi <b>Thành Công!</b><br />
            Vui lòng check
            <b
              ><a
                href="https://accounts.google.com/ServiceLogin?service=mail"
                target="_blank"
                >>>Email<<</a
              ></b
            >
            đã đăng kí để nhận và xác nhận Đơn hàng
          </p>
          <a href="/"> <button class="main-btn">Tiếp tục mua hàng</button></a>
        </div>
      </div>
    </div>
  </section>
  <!-- --------
@endsection

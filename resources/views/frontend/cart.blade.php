@extends('frontend.main')
@section('content')
    <!-- Loader -->
    <div id="loader"
        style="display:none; position:fixed; left:50%; top:50%; transform:translate(-50%, -50%); z-index:1000;">
        <div
            style="
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;">
        </div>
    </div>

    <style>
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <section class="cart-section p-to-top">
        <form action="/cart/send" method="post" id="orderForm" onsubmit="showLoaderWithDelay()">
            <div class="container">
                <div class="row-grid">
                    <p>Giỏ hàng</p>
                </div>
                <div class="row-grid">
                    <div class="cart-section-left">
                        <h2 class="main-h2">Chi tiết đơn hàng</h2>
                        <div class="cart-section-left-detail">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Ảnh</th>
                                        <th>Sản phẩm</th>
                                        <th>Thành tiền</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($products as $product)
                                        @php
                                            $price = $product->price_sale * Session()->get('cart')[$product->id];
                                            $total += $price;
                                        @endphp
                                        <tr>
                                            <td>
                                                <img style="width: 70px" src="{{ asset($product->image) }}"
                                                    alt="" />
                                            </td>
                                            <td>
                                                <div class="product-detail-right-infor">
                                                    <h1>{{ $product->name }}</h1>
                                                    <span>{{ $product->material }}</span>
                                                    <div class="hot-product-item-price">
                                                        <p>
                                                            {{ number_format($product->price_sale, 0, ',', '.') }}
                                                            <sup>đ</sup>
                                                            <span
                                                                class="old-price">{{ number_format($product->price_nomal, 0, ',', '.') }}
                                                                <sup>đ</sup></span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="product-detail-right-quantity">
                                                    <div class="product-detail-right-quantity-input">
                                                        <i class="ri-subtract-line change_qty"
                                                            data-id="{{ $product->id }}"></i>
                                                        <input onkeydown="return false"
                                                            class="quantity-input quantity-input_{{ $product->id }}"
                                                            type="number" name="product_id[{{ $product->id }}]"
                                                            data-id="{{ $product->id }}"
                                                            value="{{ Session()->get('cart')[$product->id] }}" />
                                                        <i class="ri-add-line change_qty"
                                                            data-id="{{ $product->id }}"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-price-id="{{ $product->id }}">
                                                <p class="total_line_price_{{ $product->id }}"
                                                    data-price="{{ $price }}">
                                                    {{ number_format($price, 0, ',', '.') }}<sup>đ</sup></p>
                                            </td>
                                            <td><a href="/cart/delete/{{ $product->id }}"><i
                                                        class="ri-close-line"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- chèn them voucher --}}
                                    <tr>
                                        <td colspan="2"><strong>Nhập mã giảm giá:</strong></td>
                                        <td colspan="2">
                                            <input type="text" name="voucher_code" id="voucher_code"
                                                placeholder="Nhập mã..." />
                                            <button type="button" id="apply_voucher" class="main-btn">Áp dụng</button>
                                            <p id="voucher_message" style="color: red; margin-top: 5px;"></p>
                                        </td>
                                    </tr>
                                    <tr id="discount-row" style="display: none;">
                                        <td colspan="2"><strong>Giảm giá:</strong></td>
                                        <td colspan="2" id="discount-amount" style="color: green;">0đ</td>
                                    </tr>
                                    {{-- tổng tiền --}}
                                    <tr style="background-color: #c2bfbf ; color: black">
                                        <td style="font-weight: bold" colspan="2">Tổng tiền</td>
                                        <td style="font-weight: bold" id="total-price">
                                            {{-- <p data-price="{{ $total }}">{{ number_format($total, 0, ',', '.') }}
                                                <sup>đ</sup>
                                            </p> --}}
                                            @php
                                                $cart = session('cart', []);
                                                $total = 0;
                                                foreach ($cart as $productId => $qty) {
                                                    $product = \App\Models\Product::find($productId);
                                                    $total += $product->price_sale * $qty;
                                                }

                                                $voucher = session('voucher');
                                                $total_after_discount = $voucher['total_after_discount'] ?? $total;
                                                $discount = $voucher['discount'] ?? 0;
                                            @endphp

                                            <p>Tổng tiền: {{ number_format($total, 0, ',', '.') }} đ</p>
                                            @if ($discount > 0)
                                                <p>Giảm giá: -{{ number_format($discount, 0, ',', '.') }} đ</p>
                                            @endif
                                            <p><strong>Thành tiền: {{ number_format($total_after_discount, 0, ',', '.') }}
                                                    đ</strong></p>

                                        </td>
                                        <td></td>
                                    </tr>
                                    {{-- <tr style="background-color: #f2f2f2; color: black">
                                        <td colspan="2" style="font-weight: bold">Tổng tiền gốc</td>
                                        <td style="font-weight: bold">
                                             <p>Tổng tiền: {{ number_format($total, 0, ',', '.') }} đ</p>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr style="background-color: #dcdcdc; color: black">
                                        <td colspan="2" style="font-weight: bold">Giảm giá</td>
                                        <td style="font-weight: bold">
                                             @if ($discount > 0)
                                                <p>Giảm giá: -{{ number_format($discount, 0, ',', '.') }} đ</p>
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr style="background-color: #c2bfbf; color: black">
                                        <td colspan="2" style="font-weight: bold">Tổng thanh toán</td>
                                        <td style="font-weight: bold">
                                            <p id="total-after-discount">
                                                {{ number_format($total, 0, ',', '.') }}<sup>đ</sup>
                                            </p>
                                        </td>
                                        <td></td>
                                    </tr> --}}
                                </tbody>
                                @if (isset($message))
                                    <div class="alert alert-info" style="color: red; padding: 10px; font-weight: bold;">
                                        {{ $message }}
                                    </div>
                                @endif
                            </table>
                            <br />
                            <button formaction="/cart/update" class="main-btn">Cập nhật giỏ hàng</button>
                            <a style="color: blue; font-style: italic" href="/">>>Tiếp tục mua hàng</a>
                        </div>
                    </div>
                    <div class="cart-section-right">
                        <h2 class="main-h2">Thông tin Giao Hàng</h2>
                        <div class="cart-section-right-input-name-phone">
                            <input type="text" placeholder="Tên" name="name" id="" />
                            @error('name')
                                <div style="color: red; font-size: 12px;">{{ $message }}</div>
                            @enderror
                            <input type="text" placeholder="Điện thoại" name="phone" id="" />
                            @error('phone')
                                <div style="color: red; font-size: 12px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="cart-section-right-input-email">
                            <input type="email" placeholder="Email" name="email" id="" />
                            @error('email')
                                <div style="color: red; font-size: 12px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="cart-section-right-select">
                            <select name="city" id="city">
                                <option value="">Tỉnh/Tp</option>
                            </select>
                            @error('city')
                                <div style="color: red; font-size: 12px;">{{ $message }}</div>
                            @enderror
                            <select name="district" id="district">
                                <option value="">Quận/Huyện</option>
                            </select>
                            @error('district')
                                <div style="color: red; font-size: 12px;">{{ $message }}</div>
                            @enderror
                            <select name="ward" id="ward">
                                <option value="">Phường/Xã</option>
                            </select>
                            @error('ward')
                                <div style="color: red; font-size: 12px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="cart-section-right-input-adress">
                            <input type="text" placeholder="Địa chỉ" name="address" id="" />
                            @error('address')
                                <div style="color: red; font-size: 12px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="cart-section-right-input-note">
                            <input type="text" placeholder="Ghi chú" name="note" id="" />
                        </div>
                        <button class="main-btn">Gửi đơn hàng</button>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </section>
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="{{ asset('frontend/asset/js/apiprovince.js') }}"></script>
    {{-- Loader --}}
    <script>
        function showLoaderWithDelay() {
            // Hàm được gọi khi bấm submit form (được gắn vào thuộc tính onsubmit của thẻ <form>).
            // Đợi 300ms rồi mới hiện loader, tránh hiện khi có lỗi và form reload nhanh
            setTimeout(() => {
                document.getElementById('loader').style.display = 'block';
            }, 300);
        }
    </script>
    {{-- voucher --}}
    <script>
        $('#apply_voucher').click(function() {
            let code = $('#voucher_code').val();
            if (!code) {
                $('#voucher_message').text('Vui lòng nhập mã.');
                return;
            }
            $.post('/cart/apply-voucher', {
                voucher_code: code
            }, function(response) {
                if (response.success) {
                    $('#voucher_message').css('color', 'green').text(response.message);
                    $('#discount-row').show();
                    $('#discount-amount').text(response.discount.toLocaleString() + 'đ');
                    $('#total-price')
                        .attr('data-price', response.total_after_discount)
                        .html(response.total_after_discount.toLocaleString() + '<sup>đ</sup>');
                } else {
                    $('#voucher_message').css('color', 'red').text(response.message);
                    $('#discount-row').hide();
                }
            }).fail(function() {
                $('#voucher_message').text('Đã xảy ra lỗi.');
            });
        });
    </script>
    {{-- Xử lí thành tiền và tổng tiền --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.change_qty').on('click', function() {
                let productId = $(this).data('id');
                let newQty = $('.quantity-input_' + productId).val()
                let totalPrice = $('#total-price').attr('data-price');
                let currentPrice = $('.total_line_price_' + productId).attr('data-price');
                // console.log(currentPrice);
                // console.log(totalPrice);
                // console.log(productId);
                // console.log(newQty);
                let formValid = {
                    'product_id': productId,
                    'product_qty': newQty
                }
                $.ajax({
                    url: '/cart/update-ajax',
                    type: 'POST',
                    data: formValid,
                    success: function(response) {
                        // console.log(response);
                        // let newTotalPrice = totalPrice + response.price - currentPrice;
                        // console.log(newTotalPrice);

                        // Cập nhật thành tiền
                        // $(`.total_line_price_` + productId).html(response.price
                        //     .toLocaleString() + '<sup>đ</sup>');
                        $(`.total_line_price_` + productId)
                            .html(response.price.toLocaleString() + '<sup>đ</sup>')
                            .attr('data-price', response.price); // Cập nhật lại data-price
                        // // Cập nhật tổng tiền
                        // $('#total-price').html(response.total
                        //     .toLocaleString() + '<sup>đ</sup>');

                        // Tính tổng lại tất cả thành tiền các dòng
                        let newTotal = 0;
                        $('[data-price-id]').each(function() {
                            let linePrice = parseInt($(this).find('p').attr(
                                'data-price'));
                            //Trong từng dòng, nó tìm thẻ <p> bên trong phần tử và lấy giá trị của thuộc tính data-price.
                            //parseInt(...): chuyển giá trị đó(chuỗi) sang số nguyên.
                            newTotal += linePrice;
                            //Cộng giá tiền của dòng hiện tại vào biến newTotal.
                        });
                        // Cập nhật tổng tiền
                        $('#total-price')
                            .attr('data-price', newTotal)
                            .html(newTotal.toLocaleString() + '<sup>đ</sup>');
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra!');
                        console.error(xhr.responseText);
                    }
                });
            })
        });
    </script>
@endsection

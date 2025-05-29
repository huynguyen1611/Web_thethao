<!-- resources/views/emailadmin.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Thông báo đơn hàng mới</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f8f8;
            color: #333;
            padding: 20px;
        }

        .email-container {
            background: #fff;
            padding: 30px;
            border-radius: 6px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        h2 {
            color: #2c3e50;
        }

        .section-title {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .info p {
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #eee;
            text-align: left;
        }

        th {
            background: #f1f1f1;
        }

        .total-row td {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>🛒 Bạn có đơn hàng mới từ {{ $order->name }}!</h2>

        <div class="section-title">Thông tin khách hàng</div>
        <div class="info">
            <p><strong>Họ tên:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
            <p><strong>Ghi chú:</strong> {{ $order->note ?: 'Không có' }}</p>
        </div>

        <div class="section-title">Chi tiết đơn hàng</div>
        <table>
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach (json_decode($order->order_detail, true) as $productId => $quantity)
                    @php
                        $product = \App\Models\Product::find($productId);
                        $price = $product->price_sale;
                        $subtotal = $price * $quantity;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $quantity }}</td>
                        <td>{{ number_format($price) }}đ</td>
                        <td>{{ number_format($subtotal) }}đ</td>
                    </tr>
                @endforeach
                @if ($order->discount)
                    <tr>
                        <td colspan="3">Giảm giá</td>
                        <td>-{{ number_format($order->discount) }}đ</td>
                    </tr>
                @endif
                <tr class="total-row">
                    <td colspan="3">Tổng thanh toán</td>
                    <td>{{ number_format($total - ($order->discount ?? 0)) }}đ</td>
                </tr>
            </tbody>
        </table>

        <p style="margin-top: 20px;">📩 Vui lòng kiểm tra hệ thống để xử lý đơn hàng.</p>
        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ url('') }}"
                style="
                background-color: #04080c;
                color: white;
                padding: 10px 15px;
                text-decoration: none;
                border-radius: 4px;
                font-size: 16px;
            ">
                Xem đơn hàng
            </a>
        </div>
    </div>
</body>

</html>

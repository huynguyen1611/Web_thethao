@extends('admin.main')
@section('content')
    <div class="admin-content-mani-order-detail">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Tùy biến</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($products as $product)
                    @php
                        $price = $order_detail[$product->id] * $product->price_sale;
                        $total += $price;
                    @endphp
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            <img style="width: 70px" src="{{ asset($product->image) }}" alt="" />
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price_sale, 0, ',', '.') }}</td>
                        <td>{{ $order_detail[$product->id] }}</td>
                        <td>{{ number_format($price, 0, ',', '.') }}</td>
                        <td>
                            <a class="delete-class" href="">Xóa</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td style="font-weight: bold" colspan="5">Tổng tiền</td>
                    <td style="font-weight: bold">{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>


        </table>
    </div>
@endsection

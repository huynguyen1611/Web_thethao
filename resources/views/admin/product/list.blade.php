@extends('admin.main')
@section('content')
    <div class="admin-content-main-table">
        <table>
            <thead>
                <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá bán</th>
                <th>Giá giảm</th>
                <th>Ngày đăng</th>
                <th>Tủy chỉnh</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$product ->id}}</td>
                    <td>
                        <img
                        style="width: 70px; height: 100px;"
                        src="{{ asset($product->image) }}"/>
                    </td>
                    <td>{{$product ->name}}</td>
                    <td>{{$product ->price_nomal}}</td>
                    <td>{{$product ->price_sale}}</td>
                    <td>{{$product ->created_at}}</td>
                    <td>
                        <a class="edit-class" href="{{ route('admin.product.edit', ['id' => $product->id]) }}">Sửa</a>
                        |
                        <a href="javascript:void(0)" onclick="removeRow({{ $product->id }}, '{{ route('admin.product.delete') }}')" class="delete-class">Xóa</a>
                    </td>
                </tr>
                @endforeach
                @section('footer')
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    function removeRow(product_id, url) {
        if (confirm('Bạn có muốn xóa không?')) {
            $.ajax({
                url: url,
                data: {
                    product_id: product_id
                },
                method: 'post', // hoặc 'POST' nếu bạn muốn an toàn hơn
                dataType: 'json',
                success: function (res) {
                    if(res.success){
                        alert('Xóa thành công!');
                        location.reload();
                    } else {
                        alert(res.message || 'Xóa thất bại!');
                    }
                },
                error: function () {
                    alert('Có lỗi xảy ra!');
                }
            });
        }
    }
</script>
@endsection

            </tbody>
        </table>
    </div>
@endsection

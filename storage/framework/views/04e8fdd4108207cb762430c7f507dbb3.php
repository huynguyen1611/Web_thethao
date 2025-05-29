<?php $__env->startSection('content'); ?>
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
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($product ->id); ?></td>
                    <td>
                        <img
                        style="width: 70px; height: 100px;"
                        src="<?php echo e(asset($product->image)); ?>"/>
                    </td>
                    <td><?php echo e($product ->name); ?></td>
                    <td><?php echo e($product ->price_nomal); ?></td>
                    <td><?php echo e($product ->price_sale); ?></td>
                    <td><?php echo e($product ->created_at); ?></td>
                    <td>
                        <a class="edit-class" href="<?php echo e(route('admin.product.edit', ['id' => $product->id])); ?>">Sửa</a>
                        |
                        <a href="javascript:void(0)" onclick="removeRow(<?php echo e($product->id); ?>, '<?php echo e(route('admin.product.delete')); ?>')" class="delete-class">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__env->startSection('footer'); ?>
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
<?php $__env->stopSection(); ?>

            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\Wed_thethaoProject2\resources\views/admin/product/list.blade.php ENDPATH**/ ?>
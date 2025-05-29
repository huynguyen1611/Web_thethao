<?php if(isset($products) && count($products) > 0): ?>
<section class="hot-products">
    <div class="container">
      <div class="row-grid">
        <p class="heading-text">Sản phẩm hot</p>
      </div>
      <div class="row-grid row-grid-hot-product">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="hot-product-item">
                <a href="/frontend/product/<?php echo e($product-> id); ?>"><img src="<?php echo e(asset($product->image)); ?>" alt="" /></a>
                <p><a href="/frontend/product/<?php echo e($product-> id); ?>"><?php echo e($product->name); ?></a></p>
                <span><?php echo e($product->material); ?></span>
                <div class="hot-product-item-price">
                    <p>
                        <?php echo e(number_format($product->price_sale, 0, ',', '.')); ?> <sup>đ</sup>
                        <span class="old-price"><?php echo e(number_format($product->price_nomal, 0, ',', '.')); ?> <sup>đ</sup></span>
                    </p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\Wed_thethaoProject2\resources\views/frontend/parts/hot_product.blade.php ENDPATH**/ ?>
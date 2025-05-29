<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make('frontend.parts.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>

<body>
    <!-- ------Header----------- -->
    <?php echo $__env->make('frontend.parts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- -----------Slider------------- -->
    <section class="slider">
        <div class="slider-items">
            <div class="slider-item">
                <img src="<?php echo e(asset('frontend/asset/img/anhnen3.png')); ?>" alt="" />
            </div>
            <div class="slider-item">
                <img src="<?php echo e(asset('frontend/asset/img/anhnen2.png')); ?>" alt="" />
            </div>
            <div class="slider-item">
                <img src="<?php echo e(asset('frontend/asset/img/anhnen.png')); ?>" alt="" />
            </div>
        </div>
        <div class="slider-icon">
            <i class="ri-arrow-right-fill"></i>
            <i class="ri-arrow-left-fill"></i>
        </div>
    </section>
    <!-- --------Hot-product--------- -->
    <?php echo $__env->make('frontend.parts.hot_product', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- -------product - new -->
    <?php echo $__env->make('frontend.parts.product_new', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- ----footer----- -->
    <?php echo $__env->make('frontend.parts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html>
<?php /**PATH C:\wamp64\www\Wed_thethaoProject2\resources\views/home.blade.php ENDPATH**/ ?>
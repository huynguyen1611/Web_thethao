<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make('admin.parts.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>

<body>
    <section class="admin">
        <div class="row-grid">
            <div class="admin-sidebar">
                    <?php echo $__env->make('admin.parts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <div class="admin-content">
                <div class="admin-content-top">
                    <?php echo $__env->make('admin.parts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
                <div class="admin-content-main">
                    <div class="admin-content-main-title">
                        <h1><?php echo e(isset($title)? $title : 'Dashboard'); ?></h1>
                    </div>
                        <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <?php echo $__env->make('admin.parts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </footer>
</body>

</html>
<?php /**PATH C:\wamp64\www\Wed_thethaoProject2\resources\views/admin/main.blade.php ENDPATH**/ ?>
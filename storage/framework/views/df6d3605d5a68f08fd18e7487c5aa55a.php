<!DOCTYPE html>
<html lang="en">
  <head>
   <?php echo $__env->make('frontend.parts.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </head>
  <body>
    <!-- ------Header----------- -->
    <?php echo $__env->make('frontend.parts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- -----------Content------------- -->
    <?php echo $__env->yieldContent('content'); ?>
    <!-- --------Hot-product--------- -->
    <?php echo $__env->yieldContent('hot_product'); ?>
    <!-- -------product - new -->
    
    <!-- ----footer----- -->
    <?php echo $__env->make('frontend.parts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </body>
</html>
<?php /**PATH C:\wamp64\www\Wed_thethaoProject2\resources\views/frontend/main.blade.php ENDPATH**/ ?>
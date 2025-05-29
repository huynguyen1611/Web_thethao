<?php echo $__env->make('frontend.parts.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('frontend.parts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<style>
    .cart-section-right {
        margin-bottom: 50px;
    }

    .container1 {
        margin-bottom: 50px;
        max-width: 1240px;
        margin: auto;
    }

    .container1>h2 {
        margin-top: 100px;
        text-align: center;
    }

    .cart-section-right h2 {
        text-align: center;
    }

    .button,
    .main-btn {
        display: block;
        margin: 0 auto;
        padding: 10px 30px;
        text-transform: uppercase;
        border-radius: 16px 0px;
    }

    .register-left {
        width: 50%;
    }

    .register {
        gap: 20px
    }

    #header {
        top: 0px;
    }

    .password,
    .password-change {
        display: grid;
    }

    label {
        margin-bottom: 5px;
    }

    .password input {
        margin-bottom: 20px;
        height: 30px;
        border: none;
        background-color: var(--main-bg);
        margin-bottom: 12px;
        padding-left: 12px;
        border-radius: 15px;
    }

    .password-change input {
        height: 30px;
        border: none;
        background-color: var(--main-bg);
        margin-bottom: 12px;
        padding-left: 12px;
        border-radius: 15px;
    }
</style>
<div class="container1 ">
    <h2 class="main-h2">ĐĂNG KÍ</h2>

    <form method="POST" action="<?php echo e(route('account_register.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="register row-flex">
            <div class="register-left">
                <h2 class="main-h2">Thông tin mật khẩu</h2>
                <div class="password">
                    <label for="">Mật khẩu <span style="color: red">*</span></label>
                    <input type="password" name="password" placeholder="Mật khẩu...">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: red; font-size: 12px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="password-change">
                    <label for="">Nhập lại mật khẩu <span style="color: red">*</span></label>
                    <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu...">
                    <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: red; font-size: 12px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="cart-section-right">
                <h2 class="main-h2">Thông tin khách hàng</h2>
                <div class="cart-section-right-input-name-phone">
                    <input type="text" placeholder="Tên" name="name" id="" value="<?php echo e(old('name')); ?>" />
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: red; font-size: 12px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <input type="text" placeholder="Điện thoại" name="phone" id=""
                        value="<?php echo e(old('phone')); ?>" />
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: red; font-size: 12px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="cart-section-right-input-email">
                    <input type="email" placeholder="Email" name="email" id=""
                        value="<?php echo e(old('email')); ?>" />
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: red; font-size: 12px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="cart-section-right-select">
                    <select name="city" id="city" value="<?php echo e(old('city')); ?>">
                        <option value="">Tỉnh/Tp</option>
                    </select>
                    <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: red; font-size: 12px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <select name="district" id="district" value="<?php echo e(old('district')); ?>">
                        <option value="">Quận/Huyện</option>
                    </select>
                    <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: red; font-size: 12px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <select name="ward" id="ward" value="<?php echo e(old('ward')); ?>">
                        <option value="">Phường/Xã</option>
                    </select>
                    <?php $__errorArgs = ['ward'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: red; font-size: 12px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="cart-section-right-input-adress">
                    <input type="text" placeholder="Địa chỉ" name="address" id=""
                        value="<?php echo e(old('address')); ?>" />
                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: red; font-size: 12px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>
        <button type="submit" class="main-btn button">Đăng kí</button>
    </form>

</div>
<?php echo $__env->make('frontend.parts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="<?php echo e(asset('frontend/asset/js/apiprovince.js')); ?>"></script>
<script>
    const toggle = document.getElementById("togglePassword");
    const password = document.getElementById("password");

    toggle.addEventListener("click", () => {
        const isPassword = password.type === "password";
        password.type = isPassword ? "text" : "password";
        toggle.className = isPassword ? "ri-eye-line toggle-password" : "ri-eye-close-line toggle-password";
    });
</script>
<?php /**PATH C:\wamp64\www\Wed_thethaoProject2\resources\views/frontend/accout/register.blade.php ENDPATH**/ ?>
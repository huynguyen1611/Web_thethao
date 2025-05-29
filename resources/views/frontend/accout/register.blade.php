@include('frontend.parts.head')
@include('frontend.parts.header')
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

    <form method="POST" action="{{ route('account_register.store') }}">
        @csrf
        <div class="register row-flex">
            <div class="register-left">
                <h2 class="main-h2">Thông tin mật khẩu</h2>
                <div class="password">
                    <label for="">Mật khẩu <span style="color: red">*</span></label>
                    <input type="password" name="password" placeholder="Mật khẩu...">
                    @error('password')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="password-change">
                    <label for="">Nhập lại mật khẩu <span style="color: red">*</span></label>
                    <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu...">
                    @error('password_confirmation')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="cart-section-right">
                <h2 class="main-h2">Thông tin khách hàng</h2>
                <div class="cart-section-right-input-name-phone">
                    <input type="text" placeholder="Tên" name="name" id="" value="{{ old('name') }}" />
                    @error('name')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                    <input type="text" placeholder="Điện thoại" name="phone" id=""
                        value="{{ old('phone') }}" />
                    @error('phone')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="cart-section-right-input-email">
                    <input type="email" placeholder="Email" name="email" id=""
                        value="{{ old('email') }}" />
                    @error('email')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="cart-section-right-select">
                    <select name="city" id="city" value="{{ old('city') }}">
                        <option value="">Tỉnh/Tp</option>
                    </select>
                    @error('city')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                    <select name="district" id="district" value="{{ old('district') }}">
                        <option value="">Quận/Huyện</option>
                    </select>
                    @error('district')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                    <select name="ward" id="ward" value="{{ old('ward') }}">
                        <option value="">Phường/Xã</option>
                    </select>
                    @error('ward')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="cart-section-right-input-adress">
                    <input type="text" placeholder="Địa chỉ" name="address" id=""
                        value="{{ old('address') }}" />
                    @error('address')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="main-btn button">Đăng kí</button>
    </form>

</div>
@include('frontend.parts.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="{{ asset('frontend/asset/js/apiprovince.js') }}"></script>
<script>
    const toggle = document.getElementById("togglePassword");
    const password = document.getElementById("password");

    toggle.addEventListener("click", () => {
        const isPassword = password.type === "password";
        password.type = isPassword ? "text" : "password";
        toggle.className = isPassword ? "ri-eye-line toggle-password" : "ri-eye-close-line toggle-password";
    });
</script>

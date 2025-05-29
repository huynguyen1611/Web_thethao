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

    .logout-wrapper {
        text-transform: uppercase;
        border-radius: 16px 0px;
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .logout-wrapper button {
        padding: 10px 30px;
        text-transform: uppercase;
        border-radius: 16px 0px;
        border: none;
        background-color: #c75d5d;
        color: white;
        cursor: pointer;
    }

    .logout-wrapper form {
        margin-right: 0;
    }
</style>
<div class="container1 ">
    <h2 class="main-h2">Chỉnh sửa thông tin cá nhân</h2>
    <form method="POST" action="{{ route('update_user') }}">
        @csrf
        <div class="register row-flex">
            <div class="register-left">
                <h2 class="main-h2">Thông tin mật khẩu</h2>
                <div class="password">
                    <label for="">Mật khẩu <span style="color: red">*</span></label>
                    <input type="password" name="password" value="{{ $customer->password }}" placeholder="Mật khẩu...">
                </div>
                <div class="password-change">
                    <label for="">Nhập lại mật khẩu <span style="color: red">*</span></label>
                    <input type="password" name="password_confirmation" value="{{ $customer->password }}"
                        placeholder="Nhập lại mật khẩu...">
                </div>
            </div>
            <div class="cart-section-right">
                <h2 class="main-h2">Thông tin khách hàng</h2>
                <div class="cart-section-right-input-name-phone">
                    <input type="text" placeholder="Tên" name="name" id=""
                        value="{{ $customer->name }}" />
                    @error('name')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                    <input type="text" placeholder="Điện thoại" name="phone" id=""
                        value="{{ $customer->phone }}" />
                    @error('phone')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="cart-section-right-input-email">
                    <input type="email" placeholder="Email" name="email" id=""
                        value="{{ $customer->email }}" />
                    @error('email')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="cart-section-right-select">
                    <select name="city" id="city" value="{{ $customer->city }}">
                        <option value="">Tỉnh/Tp</option>
                    </select>
                    @error('city')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                    <select name="district" id="district" value="{{ $customer->district }}">
                        <option value="">Quận/Huyện</option>
                    </select>
                    @error('district')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                    <select name="ward" id="ward" value="{{ $customer->ward }}">
                        <option value="">Phường/Xã</option>
                    </select>
                    @error('ward')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="cart-section-right-input-adress">
                    <input type="text" placeholder="Địa chỉ" name="address" id=""
                        value="{{ $customer->address }}" />
                    @error('address')
                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="main-btn button">Lưu thay đổi</button>
    </form>
    <div class="logout-wrapper">
        <form method="POST" action="{{ route('logout_user') }}">
            @csrf
            <button type="submit">Đăng xuất</button>
        </form>
    </div>
</div>
@include('frontend.parts.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="{{ asset('frontend/asset/js/apiprovince.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toggle = document.getElementById("togglePassword");
        const password = document.getElementById("password");

        if (toggle && password) {
            toggle.addEventListener("click", () => {
                const isPassword = password.type === "password";
                password.type = isPassword ? "text" : "password";
                toggle.className = isPassword ?
                    "ri-eye-line toggle-password" :
                    "ri-eye-close-line toggle-password";
            });
        }
    });
</script>
<script>
    window.customerData = {
        city: {!! json_encode($customer->city ?? '') !!},
        district: {!! json_encode($customer->district ?? '') !!},
        ward: {!! json_encode($customer->ward ?? '') !!}
    };
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng ký - NQH SHOP</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(145deg, #555, #999);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            padding: 40px 30px;
            border: 1px solid #ccc;
            border-radius: 20px;
            width: 350px;
            text-align: center;
            color: white;
            position: relative;
        }

        .login-container h1 {
            margin-bottom: 30px;
            font-size: 20px;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #fff;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar img {
            width: 40px;
            height: 40px;
        }

        .input-group {
            position: relative;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            padding-right: 40px;
            border: none;
            border-radius: 5px;
            background: #eee;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            cursor: pointer;
            user-select: none;
            font-size: 18px;
            color: #555;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background: white;
            border: none;
            border-radius: 5px;
            color: #333;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .error-text {
            color: red;
            font-size: 12px;
            text-align: left;
            margin-bottom: 10px;
        }

        a {
            text-decoration: none
        }

        .login {
            text-align: right;
        }

        .login a {
            color: #080808
        }

        .login a:hover {
            color: #2814d6
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="avatar">
            <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="avatar">
        </div>
        <h1>Đăng ký tài khoản</h1>

        <form action="{{ route('register.store') }}" method="post">
            @csrf

            <input type="text" name="name" placeholder="Họ và tên" value="{{ old('name') }}">
            @error('name')
                <div class="error-text">{{ $message }}</div>
            @enderror

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
                <div class="error-text">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Mật khẩu">
                <i class="ri-eye-close-line toggle-password" id="togglePassword"></i>
            </div>
            @error('password')
                <div class="error-text">{{ $message }}</div>
            @enderror

            <button type="submit">ĐĂNG KÝ</button>
            <div class="login">
                <a href="/login">Đăng nhập</a>
            </div>
        </form>
    </div>

    <script>
        const toggle = document.getElementById("togglePassword");
        const password = document.getElementById("password");

        toggle.addEventListener("click", () => {
            const isPassword = password.type === "password";
            password.type = isPassword ? "text" : "password";
            toggle.className = isPassword ? "ri-eye-line toggle-password" : "ri-eye-close-line toggle-password";
        });
    </script>
</body>

</html>

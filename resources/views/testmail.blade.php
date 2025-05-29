<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thông báo đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            height: 50px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .greeting {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .message-content {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .footer {
            font-size: 13px;
            color: #777;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="logo">
            <img src="{{ asset('backend/asset/image/logo2.png') }}" alt="Logo">
        </div>

        <p class="greeting">Xin chào {{ $Nameinfo }},</p>

        <div class="message-content">
            Bạn vừa có một đơn hàng trên NQH Shop vào lúc:
            {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}.<br><br>
            Nếu bạn không phải là người thực hiện hành động này, vui lòng <a href="">nhấn vào đây</a> để liên hệ
            ngay với chúng tôi nhằm đảm bảo an toàn cho tài khoản của bạn.
        </div>

        <div class="footer">
            Nếu cần hỗ trợ vui lòng liên hệ <span style="color: #1e0fe4">0368965148</span> bộ phận chăm sóc
            khách hàng.<br><br>
            Đây là thư tự động, vui lòng không trả lời.<br><br>
            Trân trọng,<br>
            <strong>Trung tâm tài khoản Website NQH Shop</strong><br><br>
            © {{ date('Y') }} WebBanhang Online. Bảo lưu mọi quyền.
        </div>
    </div>
</body>

</html>

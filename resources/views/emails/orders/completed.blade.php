<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; background-color: #f9f9f9; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; padding: 30px; text-align: center; }
        .content { padding: 30px; }
        .product-box { background: #f0f4ff; border-radius: 8px; padding: 20px; margin: 20px 0; text-align: center; border: 1px solid #dbeafe; }
        .btn { display: inline-block; background-color: #4CAF50; color: #fff; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px; margin-top: 10px; }
        .footer { background: #f1f1f1; padding: 20px; text-align: center; font-size: 12px; color: #666; }
        .info-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .info-table td { padding: 8px; border-bottom: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Đơn Hàng Thành Công!</h1>
            <p>Cảm ơn bạn đã mua sản phẩm tại BotBanHang.vn</p>
        </div>
        
        <div class="content">
            <p>Xin chào <strong>{{ $order->customer_name }}</strong>,</p>
            <p>Chúng tôi đã nhận được thanh toán cho đơn hàng <strong>#{{ $order->order_code }}</strong>.</p>
            
            <div class="product-box">
                <h3 style="margin-top: 0; color: #4a5568;">{{ $order->product->name }}</h3>
                <p>Đây là link download full source code của bạn:</p>
                <a href="{{ $order->product->download_link ?? '#' }}" class="btn">
                    📥 TẢI XUỐNG NGAY
                </a>
                @if(!$order->product->download_link)
                <p style="color: red; font-size: 12px; margin-top: 5px;">(Link đang cập nhật, vui lòng liên hệ Admin nếu nút không hoạt động)</p>
                @endif
            </div>

            <h3>📋 Chi Tiết Đơn Hàng:</h3>
            <table class="info-table">
                <tr>
                    <td><strong>Sản Phẩm:</strong></td>
                    <td>{{ $order->product->name }}</td>
                </tr>
                <tr>
                    <td><strong>Tổng Tiền:</strong></td>
                    <td>{{ number_format($order->amount) }}đ</td>
                </tr>
                <tr>
                    <td><strong>Ngày Đặt:</strong></td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>

            <p>Nếu cần hỗ trợ cài đặt, vui lòng reply email này hoặc liên hệ qua Telegram <strong>@specademy</strong>.</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} BotBanHang.vn. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

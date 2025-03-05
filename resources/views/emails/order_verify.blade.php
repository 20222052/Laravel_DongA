<div style="
    border: 2px solid #4CAF50;
    padding: 20px;
    background: #f9fff9;
    width: 600px;
    margin: auto;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
">
    <h3 style="color: #2e7d32; text-align: center;">Xin chào, {{ $order->customer->name }}</h3>
    
    <p style="color: #555; line-height: 1.6; text-align: center;">
        Cảm ơn bạn đã đặt hàng! Dưới đây là chi tiết đơn hàng của bạn:
    </p>

    <h4 style="color: #388e3c;">📦 Chi tiết đơn hàng</h4>

    <table style="
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    ">
        <thead>
            <tr style="background: #4CAF50; color: white;">
                <th style="padding: 10px;">STT</th>
                <th style="padding: 10px;">Sản phẩm</th>
                <th style="padding: 10px;">Giá</th>
                <th style="padding: 10px;">Số lượng</th>
                <th style="padding: 10px;">Tổng</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            @foreach ($order->details as $detail)
            <tr style="text-align: center; border-bottom: 1px solid #ddd;">
                <td style="padding: 10px;">{{ $loop->index + 1 }}</td>
                <td style="padding: 10px;">{{ $detail->product->name }}</td>
                <td style="padding: 10px; color: #d32f2f;">{{ number_format($detail->price) }}đ</td>
                <td style="padding: 10px;">{{ $detail->quantity }}</td>
                <td style="padding: 10px; font-weight: bold;">{{ number_format($detail->price * $detail->quantity) }}đ</td>
            </tr>
            <?php $total += $detail->price * $detail->quantity; ?>
            @endforeach
            <tr style="background: #e8f5e9; font-weight: bold;">
                <td colspan="4" style="padding: 12px; text-align: right;">Tổng cộng:</td>
                <td style="padding: 12px; text-align: center; color: #d32f2f; font-size: 16px;">
                    {{ number_format($total) }}đ
                </td>
            </tr>
        </tbody>
    </table>

    <p style="text-align: center; margin-top: 20px;">
        <a href="{{ route('order.verify', $token) }}" 
            style="
                display: inline-block; 
                padding: 12px 25px; 
                background: #007bff; 
                color: white; 
                text-decoration: none; 
                font-size: 16px; 
                border-radius: 5px; 
                transition: 0.3s;
            "
            onmouseover="this.style.background='#0056b3'"
            onmouseout="this.style.background='#007bff'">
            ✅ Xác nhận đơn hàng
        </a>
    </p>

    <p style="font-size: 13px; color: #777; text-align: center;">
        Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi qua email hoặc số điện thoại hỗ trợ.
    </p>
</div>

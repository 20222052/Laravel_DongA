<div style="
    border: 2px solid #4CAF50; 
    padding: 20px; 
    background: #f9fff9; 
    width: 550px; 
    margin: auto; 
    border-radius: 10px; 
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    text-align: center;
">
    <h3 style="color: #2e7d32; margin-bottom: 10px;">Xin chào {{ $customer->name }}</h3>
    
    <p style="color: #555; line-height: 1.6;">
        Chúng tôi nhận được yêu cầu đặt lại mật khẩu của bạn. Nếu bạn không yêu cầu thay đổi này, vui lòng bỏ qua email này.
    </p>

    <p>
        <a href="{{ route('account.reset_password', $token) }}" 
            style="
                display: inline-block; 
                padding: 10px 25px; 
                color: white; 
                background: #007bff; 
                text-decoration: none; 
                font-size: 16px; 
                border-radius: 5px;
                transition: 0.3s;
            "
            onmouseover="this.style.background='#0056b3'"
            onmouseout="this.style.background='#007bff'">
            🔒 Đặt lại mật khẩu
        </a>
    </p>

    <p style="font-size: 13px; color: #777;">
        Nếu bạn gặp sự cố, hãy sao chép liên kết này và dán vào trình duyệt:  
        <br>
        <span style="color: #007bff;">{{ route('account.reset_password', $token) }}</span>
    </p>
</div>

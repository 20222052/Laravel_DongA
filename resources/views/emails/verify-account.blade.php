<div style="
    border: 2px solid #4CAF50;
    padding: 20px;
    background: #f9fff9;
    width: 500px;
    margin: auto;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    text-align: center;
">
    <h3 style="color: #2e7d32;">Xin chào, {{ $account->name }} 👋</h3>

    <p style="color: #555; line-height: 1.6;">
        Cảm ơn bạn đã đăng ký tài khoản! Để hoàn tất quá trình đăng ký, vui lòng xác nhận email của bạn bằng cách nhấp vào nút bên dưới.
    </p>

    <p style="margin: 20px 0;">
        <a href="{{ route('account.veryfy', $account->email) }}" 
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
            ✅ Xác nhận tài khoản
        </a>
    </p>

    <p style="font-size: 13px; color: #777;">
        Nếu bạn không đăng ký tài khoản, vui lòng bỏ qua email này.  
        <br>
        Hoặc sao chép liên kết này và dán vào trình duyệt:  
        <br>
        <span style="color: #007bff;">{{ route('account.veryfy', $account->email) }}</span>
    </p>
</div>

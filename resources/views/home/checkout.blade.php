@extends('master.main')

@section('main')
<!-- main-area -->
<main>
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Order checkout</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Order checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- contact-area -->
    <section class="contact-area">
        <div class="contact-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <form id="checkout-form" action="{{ route('order.place') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input name="name" value="{{ $auth->name }}" type="text" class="form-control" placeholder="Your Name *" required>
                                <input type="hidden" id="check_payment_method" name="check_payment_method" value="0">
                                <input type="hidden" id="transactionId" name="transactionId" value="0">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input name="email" value="{{ $auth->email }}" type="email" class="form-control" placeholder="Your Email *" required>
                            </div>
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input name="phone" type="text" value="{{ $auth->phone }}" class="form-control" placeholder="Your phone *" required>
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input name="address" type="text" value="{{ $auth->address }}" class="form-control" placeholder="Your address *" required>
                            </div>

                            <!-- Payment Method Selection -->
                            <div class="form-group">
                                <label for="payment_method">Payment Method</label>
                                <select name="payment_method" id="payment_method" class="form-control">
                                    <option value="0">Cash on Delivery</option>
                                    <option value="1">Bank Transfer</option>
                                </select>
                            </div>

                            <!-- QR Code Display -->
                            <div id="qr_code_section" style="display: none; text-align: center;">
                                <p>Scan the QR code to make the payment:</p>
                                <img id="qr_code" src="" alt="QR Code" width="200">
                                <p><strong>Waiting for payment confirmation...</strong></p>
                            </div>

                            <br>
                            <button type="submit" id="submit-btn">Place Order</button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $item)
                                <tr>
                                    <td scope="row">{{ $loop->index + 1 }}</td>
                                    <td><img src="uploads/product/{{ $item->prod->image }}" width="40"></td>
                                    <td>{{ $item->prod->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                @php
                $totalPrice = 0;
                @endphp

                @foreach ($carts as $item)
                @php
                $totalPrice += $item->price * $item->quantity;
                @endphp
                @endforeach
                <h2>Total Price: {{ number_format($totalPrice, 0, ',', '.') }} VND</h2>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->
</main>
<!-- main-area-end -->

<!-- JavaScript -->
<script>
    document.getElementById('payment_method').addEventListener('change', function() {
        let qrSection = document.getElementById('qr_code_section');
        let qrCode = document.getElementById('qr_code');
        let submitBtn = document.getElementById('submit-btn');
        let totalAmount = {{ $totalPrice }}; // Get total price

        if (this.value == '1') { // If Bank Transfer is selected
            qrSection.style.display = 'block';
            submitBtn.style.display = 'none'; // Hide submit button
            let transactionId = 'TTHD20000USERID1ORDERID23';
            // let transactionId = 'Order' + Math.floor(Math.random() * 10000);
            qrCode.src = "https://qr.sepay.vn/img?acc=2004020423&bank=MBBank&amount=" + totalAmount + "&des=" + transactionId;

            // Start checking for payment confirmation
            checkPaymentStatus(transactionId);
        } else {
            qrSection.style.display = 'none';
            submitBtn.style.display = 'block'; // Show submit button
        }
    });

    function checkPaymentStatus(transactionId) {
    let apiUrl = "http://127.0.0.1:8000/api/transactions"; // Gọi API Laravel thay vì API SEPay

    let checkInterval = setInterval(async function () {
        try {
            let response = await fetch(apiUrl, { method: 'GET' });
            let data = await response.json();

            if (data && data.transactions) {
                let found = data.transactions.some(txn => txn.transaction_content.includes(transactionId));

                if (found) {
                    clearInterval(checkInterval);
                    document.getElementById("check_payment_method").value = 1;
                    document.getElementById("transactionId").value = transactionId;
                    document.getElementById("checkout-form").submit();
                }
            }
        } catch (error) {
            console.error("Error connecting to API:", error);
        }
    }, 5000); // Kiểm tra mỗi 5 giây
}

</script>

@stop

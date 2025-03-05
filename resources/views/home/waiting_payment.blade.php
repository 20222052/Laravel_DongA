@extends('master.main')

@section('main')
<main>
    <section class="breadcrumb-area tg-motion-effects breadcrumb-bg">
        <div class="container">
            <h2 class="title">Waiting for Payment</h2>
        </div>
    </section>

    <section class="contact-area">
        <div class="contact-wrap">
            <div class="container text-center">
                <h3>Please complete your bank transfer</h3>
                <p>Scan the QR code below:</p>
                <img id="qr_code" src="https://qr.sepay.vn/img?acc=2004020423&bank=MBBank&amount={{ $order->total_price }}&des={{ $order->transactionId }}" alt="QR Code" width="200">
                <p><strong>Waiting for payment confirmation...</strong></p>
            </div>
        </div>
    </section>
</main>

<script>
    function checkPaymentStatus() {
        let orderId = "{{ $order->id }}";
        let apiUrl = "http://127.0.0.1:8000/api/check-payment/" + orderId;

        let checkInterval = setInterval(async function () {
            try {
                let response = await fetch(apiUrl, { method: 'GET' });
                let data = await response.json();

                if (data.message === "Payment confirmed") {
                    clearInterval(checkInterval);
                    alert("Payment confirmed! Redirecting...");
                    window.location.href = "{{ route('home.index') }}";
                }
            } catch (error) {
                console.error("API Error:", error);
            }
        }, 5000);
    }

    checkPaymentStatus();
</script>

@stop

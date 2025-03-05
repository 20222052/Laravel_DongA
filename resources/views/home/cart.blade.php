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
                        <h2 class="title">Your Shpping cart</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Your favorites</li>
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
            <div class="container" id="main_cart">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($carts as $item)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td>
                                <img src="uploads/product/{{ $item->prod->image }}" width="40">
                            </td>
                            <td>{{ $item->prod->name }}</td>
                            <td>{{ number_format($item->price, 0, ',', '.') }}VND</td>
                            <td>
                                <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 200px; display:flex">
                                    <input type="hidden" name="product_id" class="product_id" value="{{$item->product_id}}">
                                    <button type="button" class="add">+</button>
                                    <input type="text" class="text-center quantity" style="width: 80px" name="quantity" value="{{$item->quantity}}" placeholder="">
                                    <button type="button" class="minus">-</button>
                                </div>
                            </td>
                            <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}VND</td>
                            <td>
                                <button class="delete_prd"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                @php
                $totalPrice = 0;
                @endphp

                @foreach ($carts as $item)
                @php
                $totalPrice += $item->price * $item->quantity;
                @endphp
                @endforeach

                <h2>Total Price: {{ number_format($totalPrice, 0, ',', '.') }} VND</h2>
                <br>
                <div class="text-center">
                    <a href="" class="btn btn-primary">Continue shopping</a>
                    @if($carts->count())
                    <a href="{{ route('cart.clear') }}" class="btn btn-danger" onclick="return confirm('Are you sure wanto delete all product?')"><i class="fa fa-trash"></i> Clear shopping</a>
                    <a href="{{ route('order.checkout') }}" class=" btn btn-success">Place Order</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

</main>
<!-- main-area  -end -->
@stop()

@section('js')
<script>
    $(document).on('click', 'button.delete_prd', function() {
        if (confirm('Are you sure want to delete product?')) {
            let prd_id = $(this).closest('tr').find('input.product_id').val();
            let url = "{{ route('cart.delete', ':prd_id') }}".replace(':prd_id', prd_id);

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    updateCart();
                })
                .catch(error => console.error('Error:', error));
        }
    });
    $(document).on('click', 'button.add', function() {
        let prd_id = $(this).closest('.quantity-container').find('input.product_id').val();
        let quantity = $(this).closest('.quantity-container').find('input.quantity').val();
        let newQuantity = parseInt(quantity) + 1;
        $(this).closest('.quantity-container').find('input.quantity').val(newQuantity);

        let url = "{{ route('cart.update', ':prd_id') }}".replace(':prd_id', prd_id) + "?quantity=" + newQuantity;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                console.log(data);
                updateCart(); // Làm mới giỏ hàng
            })
            .catch(error => console.error('Error:', error));
    });
    $(document).on('click', 'button.minus', function() {
        let prd_id = $(this).closest('.quantity-container').find('input.product_id').val();
        let quantity = $(this).closest('.quantity-container').find('input.quantity').val();
        let newQuantity = quantity > 1 ? parseInt(quantity) - 1 : 1;
        $(this).closest('.quantity-container').find('input.quantity').val(newQuantity);

        let url = "{{ route('cart.update', ':prd_id') }}".replace(':prd_id', prd_id) + "?quantity=" + newQuantity;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                console.log(data);
                updateCart(); // Làm mới giỏ hàng
            })
            .catch(error => console.error('Error:', error));
    });
    function updateCart() {
        $.ajax({
            url: location.href, 
            type: 'GET',
            success: function(response) {
                $('#main_cart').html($(response).find('#main_cart').html());
                $('#shoping_cart').html($(response).find('#shoping_cart').html());
            }
        });
    }
</script>
@stop()
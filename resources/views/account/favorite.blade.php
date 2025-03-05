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
                        <h2 class="title">Your favorites</h2>
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
            <div class="container">
               <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Image</th>
                        <th>Favorite date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($favorites as $item)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $item->prod->name }}</td>
                            <td>{{ $item->prod->price }} / {{ $item->prod->sale_price }}</td>
                            <td>
                                <img src="uploads/product/{{ $item->prod->image }}" width="40">
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a title="Bỏ thích" onclick="return confirm('Bạn có muốn bỏ thích không')" href="{{ route('home.favorite', $item->product_id) }}"><i class="fas fa-heart"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
               </table>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

</main>
<!-- main-area-end -->

@stop()

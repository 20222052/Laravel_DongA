@extends('master.main')
@section('title', $cat->name)
@section('main')
<!-- main-area -->
<main>

    <!-- breadcrumb-area -->
    <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">{{$cat->name}}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$cat->name}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- shop-area -->
    <section class="shop-area shop-bg" data-background="assets/img/bg/shop_bg.jpg">
        <div class="container custom-container-five">
            <div class="shop-inner-wrap">
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="shop-top-wrap">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="shop-showing-result">
                                    </div>
                                </div>
                                <div class="col-md-6">
                            
                                        <form action="" method="GET" class="form" role="form">
                                            <div class="row">
                                                <div class="col-xl-9 col-md-9" style="padding: 9px 10px 15px 10px;">
                                                    <select name="order" class="form-control">
                                                        <option value="">Default</option>
                                                        <option value="id-asc" {{request('order') == 'id-asc' ? 'selected' : ''}}>Sort ascending by id</option>
                                                        <option value="id-desc" {{request('order') == 'id-desc' ? 'selected' : ''}}>Sort descending by id</option>
                                                        <option value="name-asc" {{request('order') == 'name-asc' ? 'selected' : ''}}>Sort ascending by name</option>
                                                        <option value="name-desc" {{request('order') == 'name-desc' ? 'selected' : ''}}>Sort descending by name</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-2 col-md-3">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                         
                                </div>
                            </div>
                        </div>
                        <div class="shop-item-wrap">
                            <div class="row">
                                @foreach($products as $prod)
                                <div class="col-xl-4 col-md-6">
                                    <div class="product-item-three inner-product-item">
                                        <div class="product-thumb-three">
                                            <a href="{{route('home.product', $prod->id)}}"><img src="uploads/product/{{$prod->image}}" alt=""></a>
                                            <span class="batch">New<i class="fas fa-star"></i></span>
                                        </div>
                                        <div class="product-content-three">
                                            <a href="shop.html" class="tag">{{$prod->cat->name}}</a>
                                            <h2 class="title"><a href="{{route('home.product', $prod->id)}}">{{$prod->name}}</a></h2>
                                            @if($prod->sale_price > 0)
                                            <span><del style="font-size: 12px;">{{number_format($prod->price)}} VND</del></span>
                                            <span class="price" style="font-size: 18px;">{{number_format($prod->sale_price)}} VND</span>
                                            @else
                                            <span class="price" style="font-size: 18px;">{{number_format($prod->price)}} VND</span>
                                            @endif

                                            @if(auth('cus')->check())
                                            @if($prod->favorited)
                                            <a title="Bỏ thích" onclick="return confirm('Bạn có muốn bỏ thích không')" href="{{ route('home.favorite', $prod->id) }}"><i class="fas fa-heart"></i></a>
                                            @else
                                            <a title="Yêu thích" href="{{ route('home.favorite', $prod->id) }}"><i class="far fa-heart"></i></a>
                                            @endif

                                            <button class="add_to_cart" style="border: none; background-color: #f1ece3;" title="Thêm vòa giỏ hàng" href="{{ route('cart.add', $prod->id) }}"><i class="fa fa-shopping-cart"></i></button>
                                            <input class="product_id" type="hidden" name="product_id" value="{{$prod->id}}">
                                            @else
                                            <a title="Thêm vòa giỏ hàng" href="{{ route('account.login') }}" onclick="alert('vui lòng đăng nhập để thêm giỏ hàng')"><i class="fa fa-shopping-cart"></i></a>
                                            @endif
                                            <div class="product-cart-wrap">
                                            </div>
                                        </div>
                                        <div class="product-shape-two">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 303 445" preserveAspectRatio="none">
                                                <path d="M319,3802H602c5.523,0,10,5.24,10,11.71l-10,421.58c0,6.47-4.477,11.71-10,11.71H329c-5.523,0-10-5.24-10-11.71l-10-421.58C309,3807.24,313.477,3802,319,3802Z" transform="translate(-309 -3802)" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="shop-sidebar">
                            <div class="shop-widget">
                                <h4 class="sw-title">FILTER BY</h4>
                                <div class="price_filter">
                                    <div class="clear-btn">
                                        <a href="{{ route('home.category') }}" type="reset"><i class="far fa-trash-alt"></i>Clear all</a>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-widget">
                                <h4 class="sw-title">Category</h4>
                                <div class="shop-cat-list">
                                    <ul class="list-wrap">
                                        @foreach($cats_home as $cat)
                                        <li>
                                            <div class="shop-cat-item">

                                                <a href="{{ route('home.category', $cat->id) }}" class="form-check-label">{{$cat->name}} <span>{{$cat->products->count()}}</span></a>
                                            </div>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                            <div class="shop-widget">
                                <h4 class="sw-title">Latest Products</h4>
                                <div class="latest-products-wrap">
                                    @foreach($news_products as $np)
                                    <div class="lp-item">
                                        <div class="lp-thumb">
                                            <a href="{{route('home.product', $np->id)}}"><img src="uploads/product/{{$np->image}}" alt=""></a>
                                        </div>
                                        <div class="lp-content">
                                            <h4 class="title"><a href="{{route('home.product', $np->id)}}">{{$np->name}}</a></h4>
                                            @if($np->sale_price > 0)
                                            <span><s>{{number_format($np->price)}} VND</s></span>
                                            <span class="price">{{number_format($np->sale_price)}} VND</span>
                                            @else
                                            <span class="price">{{number_format($np->price)}} VND</span>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{$products->links()}}
            </div>
        </div>
    </section>
    <!-- shop-area-end -->

</main>
<!-- main-area-end -->

@stop()

@section('js')
<script>
    $(document).on('click', '.product-content-three button.add_to_cart', function() {
        let prd_id = $(this).closest('.product-content-three').find('input.product_id').val();
        let url = "{{ route('cart.add', ':prd_id') }}".replace(':prd_id', prd_id);
        fetch(url)
            .then(res => res.json())
            .then(data => {
                console.log(data);
                updateCart();
            })
            .catch(error => console.error('Error:', error));
    });

    function updateCart() {
        $.ajax({
            url: location.href,
            type: 'GET',
            success: function(response) {
                $('#shoping_cart').html($(response).find('#shoping_cart').html());
            }
        });
    }
</script>
@stop()
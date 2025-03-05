@extends('master.main')
@section('title', 'Trang chủ')
@section('main')
<!-- main-area -->
<main>

    <!-- area-bg -->
    <div class="area-bg" data-background="uploads/bg/{{ $topBanner->image }}">

        <!-- banner-area -->
        <section class="banner-area banner-bg tg-motion-effects" data-background="uploads/banner/banner_bg.png">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-content">
                            <h1 class="title wow fadeInUp" data-wow-delay=".2s">{{ $topBanner->name }}</h1>
                            <span class="sub-title wow fadeInUp" data-wow-delay=".4s">Butcher & Meat shop</span>
                            <a href="{{ route('home.category') }}" class="btn wow fadeInUp" data-wow-delay=".6s">order now</a>
                        </div>
                        <div class="banner-img text-center wow fadeInUp" data-wow-delay=".8s">
                            <img src="uploads/banner/banner_img.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-shape-wrap">
                <img src="uploads/banner/banner_shape01.png" alt="" class="tg-motion-effects5">
                <img src="uploads/banner/banner_shape02.png" alt="" class="tg-motion-effects4">
                <img src="uploads/banner/banner_shape03.png" alt="" class="tg-motion-effects3">
                <img src="uploads/banner/banner_shape04.png" alt="" class="tg-motion-effects5">
            </div>
        </section>
        <!-- banner-area-end -->

        <!-- features-area -->
        <section class="features-area pt-130 pb-70">
            <div class="container">
                <div class="row">
                    @foreach($news_products as $np)
                    <div class="col-lg-6">
                        <div class="features-item tg-motion-effects">
                            <div class="features-content">
                                <span>{{$np->cat->name}}</span>
                                <h4 class="title"><a href="{{route('home.product', $np->id)}}">{{$np->name}}</a></h4>
                                <div class="favorite-action">
                                    @if(auth('cus')->check())
                                    @if($np->favorited)
                                    <a title="Bỏ thích" onclick="return confirm('Bạn có muốn bỏ thích không')" href="{{ route('home.favorite', $np->id) }}"><i class="fas fa-heart"></i></a>
                                    @else
                                    <a title="Yêu thích" href="{{ route('home.favorite', $np->id) }}"><i class="far fa-heart"></i></a>
                                    @endif
                                    <button style="border: none; background-color: #fff;" class="add_to_cart" title="Thêm vòa giỏ hàng" href=""><i class="fa fa-shopping-cart"></i></button>
                                    <input class="product_id" type="hidden" name="product_id" value="{{$np->id}}">
                                    @else
                                    <a title="Thêm vòa giỏ hàng" href="{{ route('account.login') }}" onclick="alert('vui lòng đăng nhập để thêm giỏ hàng')"><i class="fa fa-shopping-cart"></i></a>
                                    @endif
                                </div>

                                @if($np->sale_price > 0)
                                <span><s>{{number_format($np->price)}}vnd</s></span>
                                <span class="price">{{number_format($np->sale_price)}} VND</span>
                                @else
                                <span class="price">{{number_format($np->price)}} VND</span>
                                @endif
                            </div>
                            <div class="features-img">
                                <img src="uploads/product/{{$np->image}}" alt="">
                                <div class="features-shape">
                                    <img src="uploads/images/features_shape.png" alt="" class="tg-motion-effects4">
                                </div>
                            </div>
                            <div class="features-overlay-shape" data-background="uploads/images/features_overlay.png"></div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- features-area-end -->

    </div>
    <!-- area-bg-end -->

    <!-- product-area -->
    <section class="product-area product-bg" data-background="uploads/bg/product_bg01.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-60">
                        <span class="sub-title">Organic Shop</span>
                        <h2 class="title">Sale Products</h2>
                        <div class="title-shape" data-background="uploads/images/title_shape.png"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($sale_products as $sp)
                <div class="col-lg-4 col-md-6">
                    <div class="product-item">
                        <div class="product-img">
                            <a href="{{route('home.product', $sp->id)}}"><img src="uploads/product/{{$sp->image}}" alt=""></a>
                        </div>
                        <div class="product-content">
                            <div class="line" data-background="uploads/images/line.png"></div>
                            <h4 class="title"><a href="{{route('home.product', $sp->id)}}">{{$sp->name}}</a></h4>
                            @if($sp->sale_price > 0)
                            <span><s>{{number_format($sp->price)}} VND</s></span>
                            <span class="price">{{number_format($sp->sale_price)}} VND</span>
                            @else
                            <span class="price">{{number_format($sp->price)}} VND</span>
                            @endif
                            @if(auth('cus')->check())
                            @if($sp->favorited)
                            <a title="Bỏ thích" onclick="return confirm('Bạn có muốn bỏ thích không')" href="{{ route('home.favorite', $sp->id) }}"><i class="fas fa-heart"></i></a>
                            @else
                            <a title="Yêu thích" href="{{ route('home.favorite', $sp->id) }}"><i class="far fa-heart"></i></a>
                            @endif

                            <button style="border: none; background-color: #fff;" class="add_to_cart" title="Thêm vòa giỏ hàng" href=""><i class="fa fa-shopping-cart"></i></button>
                            <input class="product_id" type="hidden" name="product_id" value="{{$sp->id}}">

                            @else
                            <a title="Thêm vòa giỏ hàng" href="{{ route('account.login') }}" onclick="alert('vui lòng đăng nhập để thêm giỏ hàng')"><i class="fa fa-shopping-cart"></i></a>

                            @endif
                        </div>
                        <div class="product-shape">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 401 314" preserveAspectRatio="none">
                                <path d="M331.5,1829h361a20,20,0,0,1,20,20l-29,274a20,20,0,0,1-20,20h-292a20,20,0,0,1-20-20l-40-274A20,20,0,0,1,331.5,1829Z" transform="translate(-311.5 -1829)" />
                            </svg>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="shop-shape">
            <img src="uploads/product/product_shape01.png" alt="">
        </div>
    </section>
    <!-- product-area-end -->

    <!-- gallery-area -->
    <div class="gallery-area gallery-bg" data-background="uploads/bg/{{ $gallerys[0]->image }}">
        <div class="container">
            <div class="gallery-item-wrap">
                <div class="row justify-content-center">
                    <div class="col-88">
                        <div class="gallery-active">
                            @foreach ($gallerys as $ga)
                            <div class="gallery-item">
                                <a href="uploads/banner/{{ $ga->image }}" class="popup-image"><img src="uploads/banner/{{ $ga->image }}" alt=""></a>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- gallery-area-end -->

    <!-- product-area -->
    <section class="product-area-two product-bg-two" data-background="uploads/bg/product_bg02.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-70">
                        <span class="sub-title">Organic Shop</span>
                        <h2 class="title">Fueature Products</h2>
                        <div class="title-shape" data-background="uploads/images/title_shape.png"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($feature_products as $fp)
                <div class="col-lg-6 col-md-10">
                    <div class="product-item-two">
                        <div class="product-img-two">
                            <a href="{{route('home.product', $fp->id)}}"><img src="uploads/product/{{ $fp->image }}" alt=""></a>
                        </div>
                        <div class="product-content-two">
                            <div class="product-info">
                                <h4 class="title"><a href="{{route('home.product', $fp->id)}}">{{ $fp->name }}</a></h4>
                                @if(auth('cus')->check())
                                @if($fp->favorited)
                                <a title="Bỏ thích" onclick="return confirm('Bạn có muốn bỏ thích không')" href="{{ route('home.favorite', $fp->id) }}"><i class="fas fa-heart"></i></a>
                                @else
                                <a title="Yêu thích" href="{{ route('home.favorite', $fp->id) }}"><i class="far fa-heart"></i></a>
                                @endif

                                <button style="border: none; background-color: #fff;" class="add_to_cart" title="Thêm vòa giỏ hàng" href=""><i class="fa fa-shopping-cart"></i></button>
                                <input class="product_id" type="hidden" name="product_id" value="{{$fp->id}}">

                                @else
                                <a title="Thêm vòa giỏ hàng" href="{{ route('account.login') }}" onclick="alert('vui lòng đăng nhập để thêm giỏ hàng')"><i class="fa fa-shopping-cart"></i></a>

                                @endif
                            </div>
                            <div class="product-price">
                                @if($fp->sale_price > 0)
                                <span><s>{{number_format($fp->price)}} VND</s></span>
                                <span class="price">{{number_format($fp->sale_price)}} VND</span>
                                @else
                                <span class="price">{{number_format($fp->price)}} VND</span>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="shop-now-btn text-center mt-40">
                <a href="{{ route('home.category') }}" class="btn">Shop Now</a>
            </div>
        </div>
    </section>
    <!-- product-area-end -->

    <!-- blog-post-area -->
    <section class="blog-post-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-70">
                        <span class="sub-title">Lastest News</span>
                        <h2 class="title">Latest News Update</h2>
                        <div class="title-shape" data-background="uploads/images/title_shape.png"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($lastest_news as $ln)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-post-item">
                        <div class="blog-post-thumb">
                            <a href="{{ route('home.blog_details', $ln->id) }}"><img src="uploads/blog/{{ $ln->image }}" alt=""></a>
                        </div>
                        <div class="blog-post-content">
                            <div class="blog-meta">
                                <ul class="list-wrap">
                                    <li><a href="blog.html"><i class="fas fa-user"></i>Hamolin Pilot</a></li>
                                    <li><i class="fas fa-comments"></i>03</li>
                                </ul>
                            </div>
                            <h4 class="title"><a href="{{ route('home.blog_details', $ln->id) }}">{{ $ln->name }}</a></h4>
                            <p>{{ $ln->description }}</p>
                            <div class="blog-post-bottom">
                                <a href="{{ route('home.blog_details', $ln->id) }}" class="link-btn">Read More</a>
                                <a href="{{ route('home.blog_details', $ln->id) }}" class="link-arrow"><i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- blog-post-area-end -->

</main>
<!-- main-area-end -->

@stop()

@section('js')
<script>
    //PRD INFO
    $(document).on('click', '.product-info button.add_to_cart', function() {
        let prd_id = $(this).closest('.product-info').find('input.product_id').val();
        let url = "{{ route('cart.add', ':prd_id') }}".replace(':prd_id', prd_id);
        fetch(url)
            .then(res => res.json())
            .then(data => {
                console.log(data);
                updateCart();
            })
            .catch(error => console.error('Error:', error));
    });
    // PRD CONTENT
    $(document).on('click', '.product-content button.add_to_cart', function() {
        let prd_id = $(this).closest('.product-content').find('input.product_id').val();
        let url = "{{ route('cart.add', ':prd_id') }}".replace(':prd_id', prd_id);
        fetch(url)
            .then(res => res.json())
            .then(data => {
                console.log(data);
                updateCart();
            })
            .catch(error => console.error('Error:', error));
    });
    $(document).on('click', '.favorite-action button.add_to_cart', function() {
        let prd_id = $(this).closest('.favorite-action').find('input.product_id').val();
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
@extends('master.main')

@section('main')

<?php
    function limit_Word($text, $wordLimit) {
        $words = preg_split('/\s+/', $text);
        if (count($words) > $wordLimit) {
            $words = array_slice($words, 0, $wordLimit);
            $text = implode(' ', $words) . '...'; 
        }
        return $text;
    }
?>
        <!-- main-area -->
        <main>

            <!-- breadcrumb-area -->
            <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-content">
                                <h2 class="title">Our Blog</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">our blog</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->

            <!-- blog-area -->
            <section class="blog-area blog-bg" data-background="uploads/bg/blog_bg.jpg">
                <div class="container custom-container-five">
                    <div class="blog-inner-wrap">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                @foreach($blogs as $item)
                                <div class="blog-item">
                                    <div class="blog-thumb">
                                        <a href="{{ route('home.blog_details', $item->id) }}"><img src="uploads/blog/{{$item -> image}}" alt=""></a>
                                    </div>
                                    <div class="blog-content">
                                        <h2 class="title"><a href="{{ route('home.blog_details', $item->id) }}">{{$item -> name}}</a></h2>
                                            <p>
                                                {{limit_Word($item -> description, 100);}}
                                            </p>
                                        <a href="{{ route('home.blog_details', $item->id) }}" class="link-btn">Read more<i class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>
            <!-- blog-area-end -->

        </main>
        <!-- main-area-end -->
@stop()


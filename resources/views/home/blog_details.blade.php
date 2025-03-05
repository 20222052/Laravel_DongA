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
                        <h2 class="title">Blog Details</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- blog-details-area -->
    <section class="blog-area blog-details-area blog-bg" data-background="uploads/bg/blog_bg.jpg">
        <div class="container custom-container-five">
            <div class="blog-inner-wrap">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="blog-details-wrap">
                            <div class="blog-thumb">
                                <img src="uploads/blog/{{$blog->image}}" alt="">
                            </div>

                            <div class="blog-content blog-details-content">

                                <h2 class="title">{{$blog->name}}</h2>
                                <p>{{$blog-> description}}</p>
                            </div>
                        </div>
                        <h3 class="comment-reply-title">Comment</h3>
                        @foreach ($comments as $comm)
                        <div class="blog-avatar-wrap">
                            <div class="blog-avatar-info">
                                <h4 class="name">{{$comm->custm->name}}</h4>
                                <p>{{ $comm->comment}}</p>

                                @if(auth('cus')->check() && auth('cus')->id() === $comm->customer_id)
                                <a href="{{ route('home.comment.edit', $comm->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('home.comment.delete', $comm->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        <div class="comment-respond">
                            <h3 class="comment-reply-title">Leave A Comment</h3>
                            @if (auth('cus')->check())
                            <form class="form-control" action="{{ route('home.comment', $blog->id) }}" method="POST" role="form">
                                @csrf
                                <div class="form-grp">
                                    <textarea name="comment" class="form-control" placeholder="Write your comment here..."></textarea>
                                    @error('comment')
                                    <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                                <br>
                                <button type="submit" class="btn">send Comment</button>
                            </form>
                            @else

                            <div class="alert alert-danger" role="alert">
                                <strong>Sign in to comment!</strong> <a href="{{ route('account.login') }}">Click here to login</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog-details-area-end -->

</main>
<!-- main-area-end -->
@stop()
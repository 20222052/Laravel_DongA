@extends('master.main')

@section('main')
<!-- breadcrumb-area -->
<section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Edit your comment</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Comment</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

<div class="container">
    <h3>Edit Comment</h3>
    <form action="{{ route('home.comment.update', $comment->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <br>
            <br>
            <textarea name="comment" class="form-control" rows="4" placeholder="Write your comment here...">{{ $comment->comment }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@stop

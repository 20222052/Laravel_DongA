@extends('master.admin')
@section('title', 'Edit a Blog'. $blog->name)
@section('main')


<div class="row">
    <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="col-md-9">

            <div class="form-group">
                <label for="">Blog name</label>
                <input type="text" name="name" class="form-control" id="" placeholder="Input field" value="{{ $blog->name }}">
                @error('name')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Blog Link</label>
                <input type="text" name="link" class="form-control" id="" placeholder="Input field" value="{{ $blog->link }}">
                @error('link')
                <small>{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Blog Desscription</label>
                <textarea name="description" class="form-control description" placeholder="Blog content">{{ $blog->description }}</textarea>
                @error('description')
                <small>{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Blog Position</label>
                <input type="text" name="position" class="form-control" id="" placeholder="Input field" value="{{ $blog->position }}">
                @error('position')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="radio">
                    <label>
                        <input type="radio" name="status" value="1" {{$blog->status == 1 ? 'checked' : ''}} />
                        Publish
                    </label>
                </div>

                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="0" {{$blog->status == 0 ? 'checked' : ''}} />
                        Hidden
                    </label>
                </div>
            <div class="form-group">
                <label for="">Blog Image</label>
                <input type="file" name="img" class="form-control" onchange="showImage(this)">
                <img src="uploads/blog/{{ $blog->image }}" id="show_img" alt="" width="100%">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </form>
</div>


@stop()


@section('css')
<link rel="stylesheet" href="ad_assets/plugins/summernote/summernote.min.css">
@stop()

@section('js')
<script src="ad_assets/plugins/summernote/summernote.min.js"></script>
<script>
    $('.description').summernote({
        height: 250
    });

    function showImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#show_img').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@stop()
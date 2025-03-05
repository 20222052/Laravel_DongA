@extends('master.admin')
@section('title', 'Edit a Banner'. $banner->name)
@section('main')


<div class="row">
    <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="col-md-7">

            <div class="form-group">
                <label for="">Banner name</label>
                <input type="text" name="name" class="form-control" id="" placeholder="Input field" value="{{ $banner->name }}">
                @error('name')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Banner Link</label>
                <input type="text" name="link" class="form-control" id="" placeholder="Input field" value="{{ $banner->link }}">
                @error('link')
                <small>{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Banner Desscription</label>
                <textarea name="description" class="form-control description" placeholder="Banner content">{{ $banner->description }}</textarea>
                @error('description')
                <small>{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-5">
        <div class="form-group">
                <label for="">Banner position</label>
                <input type="text" name="position" class="form-control" id="" placeholder="Input field" value="{{ $banner->position }}">
                @error('position')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Banner prioty</label>
                <input type="text" name="prioty" class="form-control" id="" placeholder="Input field" value="{{ $banner->prioty }}">
                @error('prioty')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Banner Status</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="1" {{$banner->status == 1 ? 'checked' : ''}} />
                        Publish
                    </label>
                </div>

                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="0" {{$banner->status == 0 ? 'checked' : ''}} />
                        Hidden
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="">Banner Image</label>
                <input type="file" name="img" class="form-control" onchange="showImage(this)">
                <img src="uploads/banner/{{ $banner->image }}" width="100%" id="show_img">
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
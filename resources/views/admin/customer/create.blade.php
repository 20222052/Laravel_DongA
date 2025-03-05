@extends('master.admin')
@section('title', 'Create new a customer')
@section('main')


<div class="row">
    <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">

            <div class="form-group">
                <label for="">Customer name</label>
                <input type="text" name="name" class="form-control" id="" placeholder="Input field" value="{{old('name')}}">
                @error('name')
                <small>{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Customer Email</label>
                <input type="text" name="email" class="form-control" id="" placeholder="Input field" value="{{old('email')}}">
                @error('email')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Customer Phone</label>
                <input type="text" name="phone" class="form-control" id="" placeholder="Input field" value="{{old('phone')}}">
                @error('phone')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Customer Address</label>
                <input type="text" name="address" class="form-control" id="" placeholder="Input field" value="{{old('address')}}">
                @error('address')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Customer Password</label>
                <input type="text" name="password" class="form-control" id="" placeholder="Input field" value="{{old('password')}}">
                @error('password')
                <small>{{$message}}</small>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="">Customer Gender</label>

                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="1" {{old('gender') == 1 ? 'checked' : ''}} />
                        Nam
                    </label>
                </div>

                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="0" {{old('gender') == 0 ? 'checked' : ''}} />
                        Nữ
                    </label>
                </div>
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
</script>
@stop()
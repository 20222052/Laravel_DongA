@extends('master.admin')
@section('title', 'Create new a Category')
@section('main')


<div class="row">
    <div class="col-md-4">
        
        <form action="{{route('category.store')}}" method="post" role="form">
            @csrf
            <div class="form-group">
                <label for="">Category name</label>
                <input type="text" class="form-control" name="name" placeholder="Input field" value="{{old('name')}}">
                @error('name')
                <small>{{$message}}</small>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="">Category Status</label>
                
                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="1" {{old('status') == 1 ? 'checked' : ''}} />
                        Publish
                    </label>
                </div>

                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="0" {{old('status') == 0 ? 'checked' : ''}} />
                        Hidden
                    </label>
                </div>
                
            </div>
        
            
        
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </form>
        
    </div>
</div>


@stop()

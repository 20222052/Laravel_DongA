@extends('master.admin')
@section('title', 'Create new a User')
@section('main')


<div class="row">
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="col-md-9">
            <div class="form-group">
                <label for="">User name</label>
                <input type="text" name="name" class="form-control" placeholder=" Name" value="{{old('name')}}">
                @error('name')
                <small>{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="">User Email</label>
                <input type="text" name="email" class="form-control" placeholder=" Email" value="{{old('email')}}">
                @error('email')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Role Management</label>

                <div class="radio">
                    <label>
                        <input type="radio" name="role" value="staff" checked />
                        Staff
                    </label>
                </div>

                <div class="radio">
                    <label>
                        <input type="radio" name="role" value="editor" />
                        Editor
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="role" value="admin" />
                        Admin
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="">User PassWord</label>
                <input type="text" name="password" class="form-control" placeholder=" PassWord">
                @error('password')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Comfirm PassWord</label>
                <input type="text" name="re_password" class="form-control" placeholder=" Comfirm PassWord">
                @error('re_password')
                <small>{{$message}}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </form>
</div>
@stop()
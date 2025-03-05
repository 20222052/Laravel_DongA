@extends('master.admin')
@section('title', 'User manager')
@section('main')

<form action="" method="GET" class="form-inline" role="form">
@csrf
    <div class="form-group" >
        
        <label class="sr-only" for="">label</label>
        <input type="text" class="form-control" name="keyword" placeholder="Input field" value="{{request('keyword')}}">
    </div>



    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    <a href="{{ route('user.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add new</a>
</form>


<br>


<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td class="text-right">
                <form action="{{ route('user.destroy', $user->id) }}" method="post" >
                @csrf @method('DELETE')
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you suere wanto delete it?')"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$data->appends(request()->all())->links()}}

@stop()

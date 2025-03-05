@extends('master.admin')
@section('title', 'Customer manager')
@section('main')

<form action="" method="GET" class="form-inline" role="form">
    @csrf
    <div class="form-group">
        <label for="">  Name</label>
        <input type="text" class="form-control" name="keyword" placeholder="Input field" value="{{request('keyword')}}">
    </div>
    
    <div class="form-group">
    <label for="">  Arrange</label>
        <select name="order" class="form-control">
        <option value="">Default</option>
            <option value="id-asc" {{request('order') == 'id-asc' ? 'selected' : ''}}>sort ascending by id</option>
            <option value="id-desc" {{request('order') == 'id-desc' ? 'selected' : ''}}>sort descending by id</option>
            <option value="name-asc"{{request('order') == 'name-asc' ? 'selected' : ''}}>sort ascending by name</option>
            <option value="name-desc"{{request('order') == 'name-desc' ? 'selected' : ''}}>sort descending by name</option>
            <option value="created_at-asc"{{request('order') == 'created_at-asc' ? 'selected' : ''}}>sort ascending by created_at</option>
            <option value="created_at-desc"{{request('order') == 'created_at-desc' ? 'selected' : ''}}>sort descending by created_at</option>
        </select>   
    </div>
    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    <a href="{{ route('customer.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add new</a>
</form>


<br>


<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Password</th>
            <th>Created_at</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $model)
        <tr>
            <td>{{ $model->id }}</td>
            <td>{{ $model->name }}</td>
            <td>{{ $model->email }}</td>
            <td>{{ $model->phone }}</td>
            <td>{{ $model->address }}</td>
            <td>{{ $model->gender == 0 ? 'Nu' : 'Nam' }}</td>
            <td>{{ $model->password }}</td>
            <td>{{ $model->created_at->format('d/m/y')}}</td>
            <td class="text-right">
                <form action="{{ route('customer.destroy', $model->id) }}" method="post">
                    @csrf @method('DELETE')

                    <a href="{{ route('customer.edit', $model->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you suere wanto delete it?')"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach


    </tbody>
</table>
{{$data->appends(request()->all())->links()}}

@stop()
@extends('master.admin')
@section('title', 'Banner manager')
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
    <a href="{{ route('banner.create')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add new</a>
</form>


<br>


<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Link</th>
            <th>Image</th>
            <th>Description</th>
            <th>Position</th>
            <th>Prioty</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $model)
        <tr>
            <td>{{ $model->id }}</td>
            <td>{{ $model->name }}</td>
            <td>{{ $model->link}}</td>
            <td>
                <img src="uploads/banner/{{ $model->image }}" width="40">
            </td>
            <td>{{ $model->description  }}</td>
            <td>{{ $model->position}}</td>
            <td>{{ $model->prioty}}</td>
            <td>{{ $model->status == 0 ? 'Hidden' : 'Publish' }}</td>
            <td class="text-right">
                <form action="{{ route('banner.destroy', $model->id) }}" method="post">
                    @csrf @method('DELETE')

                    <a href="{{ route('banner.edit', $model->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                    @canany(['admin', 'editor'])
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you suere wanto delete it?')"><i class="fa fa-trash"></i></button>
                    @endcanany
                </form>
            </td>
        </tr>
        @endforeach


    </tbody>
</table>
{{$data->appends(request()->all())->links()}}

@stop()
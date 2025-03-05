@extends('master.admin')
@section('title', 'Comment manager')
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
</form>


<br>


<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Blog Name</th>
            <th>Customer Name</th>
            <th>Comment</th>
            <th>Created_at</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $model)
        <tr>
            <td>{{ $model->id }}</td>
            <td>{{ $model->blog->name }}</td>
            <td>{{ $model->custm->name }}</td>
            <td>{{ $model->comment}} </td>
            <td>{{ $model->created_at->format('d/m/y') }}</td>
            
            <td class="text-right">
                <form action="{{ route('comment.destroy', $model->id) }}" method="post">
                    @csrf @method('DELETE')
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
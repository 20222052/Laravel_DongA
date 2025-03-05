@extends('master.admin')
@section('title', 'Category manager')
@section('main')

<form action="" method="GET" class="form-inline" role="form">
    @csrf
    <div class="form-group">
        <label for="">  Name</label>
        <input type="text" class="form-control" name="keyword" placeholder="Input field" value="{{ request('name') }}">
    </div>
    <div class="form-group">
        
    <label for="">  Arrange</label>
    <select name="order" class="form-control">
        <option value="">Default</option>
            <option value="id-asc" {{request('order') == 'id-asc' ? 'checked' : ''}}>sort ascending by id</option>
            <option value="id-desc" {{request('order') == 'id-desc' ? 'checked' : ''}}>sort descending by id</option>
            <option value="name-asc"{{request('order') == 'name-asc' ? 'checked' : ''}}>sort ascending by name</option>
            <option value="name-desc"{{request('order') == 'name-desc' ? 'checked' : ''}}>sort descending by name</option>
            <option value="created_at-asc"{{request('order') == 'created_at-asc' ? 'checked' : ''}}>sort ascending by created_at</option>
            <option value="created_at-desc"{{request('order') == 'created_at-desc' ? 'checked' : ''}}>sort descending by created_at</option>
        </select>      

    </div>



    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    <a href="{{ route('category.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add new</a>
</form>


<br>


<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Category Name</th>
            <th>Totall Product</th>
            <th>Date Created</th>
            <th>Category Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $cats)
        <tr>

            <td>{{$cats->id}}</td>
            <td>{{$cats->name}}</td>
            <td>{{$cats->products->count()}}</td>
            <td>{{$cats->created_at->format('d/m/y') }}</td>
            <td>{{$cats->status == 1 ? 'Publish' : 'Hidden'}}</td>
            
            <td class="text-right">
                <form action="{{route('category.destroy', $cats->id)}}" method="POST">
                @csrf @method('DELETE')
                <a href="{{ route('category.edit', $cats->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                @canany(['admin', 'editor'])
                <button href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                @endcanany
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$data->appends(request()->all())->links()}}

@stop()
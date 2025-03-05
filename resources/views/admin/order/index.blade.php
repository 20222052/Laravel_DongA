@extends('master.admin')
@section('title','Danh sách đơn hàng')
@section('main')
<form action="" method="GET" class="form-inline" role="form">
    @csrf
    <div class="form-group">
        <label for=""> Arrange</label>
        <select name="order" class="form-control">
            <option value="">Default</option>
            <option value="created_at-asc" {{request('order') == 'created_at-asc' ? 'checked' : ''}}>sort ascending by created_at</option>
            <option value="created_at-desc" {{request('order') == 'created_at-desc' ? 'checked' : ''}}>sort descending by created_at</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
</form>
<table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th>Order date</th>
            <th>Status</th>
            <th>Payment Method</th>
            <th>Payment Status</th>
            <th>Total Price</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $item)
        <tr>
            <td scope="row">{{ $loop->index + 1 }}</td>
            <td>{{ $item->created_at->format('d/m/Y') }}</td>
            <td>
                @if ($item->status == 0)
                <span>Chưa xác nhận</span>
                @elseif ($item->status == 1)
                <span>Đã xác nhận</span>
                @elseif ($item->status == 2)
                <span>Đã giao hàng</span>
                @elseif ($item->status == 3)
                <span>Đã Hủy</span>
                @else
                <span>Không xác định</span>
                @endif

            </td>
            <td>
                @if ($item->payment_method == 0)
                <span>Thanh Toán khi nhận hàng</span>
                @elseif ($item->payment_method == 1)
                <span>Chuyển khoản</span>
                @endif
            </td>
            <td>
                @if ($item->status == 0 && $item->payment_method == 0)
                <span>Chờ thanh toán</span>
                @elseif ($item->status == 1 && $item->payment_method == 0)
                <span>Chờ thanh toán</span>
                @elseif ($item->status == 0 && $item->payment_method == 1)
                <span>Đã thanh toán</span>
                @elseif ($item->status == 1 && $item->payment_method == 1)
                <span>Đã thanh toán</span>
                @elseif ($item->status == 2 && $item->payment_method == 1 || $item->status == 2 && $item->payment_method == 0)
                <span>Đã thanh toán</span>
                @elseif ($item->status == 3)
                <span>Không xác định</span>
                @endif
            </td>
            <td>{{ number_format($item->totalPrice) }}</td>
            <td>
                <a href="{{ route('order.show', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
            </td>

        </tr>
        @endforeach

    </tbody>
</table>

@stop()
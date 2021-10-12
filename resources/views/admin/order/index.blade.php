@extends('admin.layout.master')
@section('content')


<table class="table table-striped">
    <thead>
        <tr>
            <th>User</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order as $o)
        <tr>

            <td>{{$o->user->name}}</td>
            <td>{{$o->product->title}}</td>
            <td>{{$o->quantity}}</td>
            <td>{{$o->total_price}}</td>
            <td>{{$o->status}}</td>
            <td>
                @if($o->status=='success')
                -
                @endif

                @if($o->status==='pending')
                <a href="{{url('/admin/change-order?order_id='.$o->id.'&status=success')}}"
                    class="badge badge-success">make success</a>
                <a href="{{url('/admin/change-order?order_id='.$o->id.'&status=cancel')}}"
                    class="badge badge-danger">make cancel</a>
                @endif
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

{{$order->links()}}
@endsection

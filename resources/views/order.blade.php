@extends('layout.master')

@section('content')
<h2>Your Order List</h2>
<hr>
<div class="card p-3">
    <div>
        <a href="{{url('/order-list')}}" class="btn btn-sm btn-dark">All</a>
        <a href="{{url("/order-list?status=pending")}}" class="btn btn-sm btn-warning">Pending</a>
        <a href="{{url("/order-list?status=success")}}" class="btn btn-sm btn-success">Success</a>
        <a href="{{url("/order-list?status=cancel")}}" class="btn btn-sm btn-danger">Cancel</a>
    </div>

</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Total Quantity</th>
            <th>Total Price</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order as $c)
        <tr>

            <td>
                <img src="{{asset($c->product->image_url)}}" style="width:50px;border-radius:30%" alt="">
            </td>
            <td>{{$c->product->title}}</td>
            <td>{{$c->quantity}}</td>
            <td>{{$c->total_price}}</td>

            <td>
                @if($c->status=='pending')
                <span class="badge badge-warning">Pending</span>
                @endif
                @if($c->status=='success')
                <span class="badge badge-success">Success</span>
                @endif
                @if($c->status=='cancel')
                <span class="badge badge-danger">Cancel</span>
                @endif
            </td>

        </tr>
        @endforeach

    </tbody>
</table>

@endsection

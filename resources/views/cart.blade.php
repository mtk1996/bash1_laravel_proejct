@extends('layout.master')

@section('content')
<h2>Your Cart List</h2>
<table class="table table-striped">
    <thead>
        <tr>

            <th>Image</th>
            <th>Name</th>
            <th>Total</th>
            <th>Price</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cart as $c)
        <tr>

            <td>
                <img src="{{asset($c->product->image_url)}}" style="width:50px;border-radius:30%" alt="">
            </td>
            <td>{{$c->product->title}}</td>
            <td>
                <form action="{{url('update-cart')}}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{$c->id}}">
                    <input type="text" name="quantity" value="{{$c->quantity}}" id="">
                    <input type="submit" value="Change">
                </form>
            </td>
            <td>{{$c->product->price}}</td>
            <td>
                {{$c->product->price * $c->quantity}}
            </td>

        </tr>
        @endforeach
        <tr>
            <td colspan="3">
                <h1>Total Quantity</h1>
            </td>
            <td colspan="2">
                <h1>{{$total_qty}}</h1>
            </td>
        </tr>
    </tbody>
</table>
<a href="{{url('order')}}" class="btn btn-primary mr-auto ml-auto">Order</a>

@endsection

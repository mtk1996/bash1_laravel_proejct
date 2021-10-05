@extends('admin.layout.master')
@section('content')
<div>
    <a href="{{route('product.create')}}" class="btn btn-success">Create Category</a>
</div>
<hr>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Total Qty</th>
            <th>Price</th>
            <th>Option</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($product as $c)
        <tr>
            <td>{{$c->id}}</td>
            <td>
                <img src="{{asset('public/images/'.$c->image)}}" class="thumbnail" width="150" alt="">
            </td>
            <td>{{$c->title}}</td>
            <td>{{$c->total_quantity}}</td>
            <td>{{$c->price}}</td>
            <td>
                <a href="{{route('product.edit',$c->id)}}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{route('product.destroy',$c->id)}}" class="d-inline"
                    onsubmit="return confirm('are you sure?')" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete" name="" id="">
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

{{$product->links()}}
@endsection

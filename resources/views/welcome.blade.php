@extends('layout.master')
@section('content')
<div class="card p-1">
    <form action="" class="row" method="GET">
        <div class="col-md-4">
            <select name="color_slug" class="form-control">
                <option value="">Select Color</option>
                @foreach ($color as $c)
                <option value="{{$c->slug}}">{{$c->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select name="size_slug" class="form-control">
                <option value="">Select Size</option>
                @foreach ($size as $c)
                <option value="{{$c->slug}}">{{$c->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input type="submit" value="Filter" class="btn btn-primary">
        </div>
    </form>
</div>
<div class="row">
    <!-- Loop Product -->
    @foreach($products as $p)
    <div class="col-md-4">
        <a href="{{url('product/'.$p->slug)}}">
            <div class="card">
                <img class="card-img-top" src="{{asset($p->image_url)}}" alt="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>{{$p->title}}
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="" class="badge badge-primary">{{$p->price}}ks</a>
                        </div>
                        <div class="col-md-4">
                            <a href="" class="badge badge-warning">{{$p->category->name}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </a>

    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-md-6 offset-3">
        {{$products->links()}}
    </div>
</div>
@endsection

@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{$p->title}}</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <a href="" class="btn btn-primary rounded">
                    <i class="fas fa-cart-arrow-down"></i>
                </a>
            </div>
            <div class="col-md-4">
                <small class="badge badge-warning">
                    <i class="">Price: </i>
                    {{$p->price}}
                </small>
                <br>
                <br>
                <small>Color:</small>
                @foreach ($p->color as $c)
                <small class="badge badge-danger">{{$c->name}}</small>
                @endforeach
            </div>
            <div class="col-md-4">
                <a href="" class="badge badge-primary">Category : {{$p->category->name}}</a>
                <br>
                <br>
                <small>Size:</small>
                @foreach ($p->size as $c)
                <small class="badge badge-danger">{{$c->name}}</small>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <img src="{{asset($p->image_url)}}" class="w-50" alt="">
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <p>
            {!!$p->description!!}
        </p>
    </div>
</div>

@endsection

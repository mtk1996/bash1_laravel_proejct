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
                <a href="{{url('/add-cart?product_slug='.$p->slug)}}" class="btn btn-primary rounded">
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
        @auth
        <div class="card p-3">
            <textarea id="txtReview" id="" class="form-control" placeholder="enter review"></textarea>
            <div class="mt-3">
                <button id="btnCreate" class="btn btn-primary">Create</button>
            </div>

        </div>
        @endauth

        <div id="reviewContainer">

            @foreach ($p->review as $r)
            <div class="card p-5">
                <p class="text-primary">{{$r->user->name}}</p>
                <p>{{$r->review}}</p>
            </div>
            @endforeach



        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            var txtReview = $('#txtReview');
            var btnCreate = $('#btnCreate');
            var reviewContainer = $('#reviewContainer')
            btnCreate.click(function(){
                if(txtReview.val() == ''){
                    toastr.error('Please Enter Review');
                    return;
                }

                $.post('/create-review',{review:txtReview.val(),product_slug:"{{$p->slug}}"}).then(res=>{
                    if(res=='success'){
                        var review = `
                        <div class="reviewContainer">
            <div class="card p-5">
                <p class="text-primary">{{auth()->user()->name}}</p>
                <p>${txtReview.val()}</p>
            </div>
        </div>
                        `
                        reviewContainer.prepend(review);
                        txtReview.val('');
                    }
                })
            })
        })
</script>
@endsection

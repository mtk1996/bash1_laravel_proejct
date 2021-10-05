@extends('admin.layout.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')

<div>
    <a href="{{route('product.index')}}" class="btn btn-dark">Back</a>
</div>
<hr>

<form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="">Choose Category</label>
        <select name="category_id" id="" class="form-control">
            @foreach ($category as $c)
            <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Choose Size</label>
        <select name="size_id[]" multiple id="size">
            @foreach ($size as $z)
            <option value="{{$z->id}}">{{$z->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Choose Color</label>
        <select name="color_id[]" multiple id="color">
            @foreach ($color as $z)
            <option value="{{$z->id}}">{{$z->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Enter Title</label>
        <input type="text" name="title" class="form-control" id="">
    </div>
    <div class="form-group">
        <label for="">Choose Image</label>
        <input type="file" name="image" class="form-control" id="">
    </div>
    <div class="form-group">
        <label for="">Total Qty</label>
        <input type="number" name="total_quantity" class="form-control" id="">
    </div>

    <div class="form-group">
        <label for="">Price</label>
        <input type="number" name="price" class="form-control" id="">
    </div>

    <div class="form-group">
        <label for="">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
    </div>


    <input type="submit" class="btn btn-danger" value="Create">
</form>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(function(){
        $('#size').select2();
        $('#color').select2();
        $('#description').summernote({
            height:300
        });
    })
</script>
@endsection

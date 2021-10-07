@extends('layout.master')

@section('content')
<div class="col-md-8 offset-2 ">
    <div class="card">
        <div class="card-header bg-primary">
            <h4>Register</h4>
        </div>
        <div class="card-body">
            <form action="{{url('/register')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Enter Your Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Enter Your Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Enter Your Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <input type="submit" value="Register" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

@endsection

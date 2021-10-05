<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce Project</title>
    <link rel="stylesheet" href="{{asset('/assets/css/argon.css?v=1.2.0')}}" type="text/css">
</head>

<body>
    <div class="container mt-5">
        <div class="col-12 col-md-4 offset-4 lg-offset-4 ">
            <div class="card">
                <div class="card-header bg-danger">Please Login</div>
                <div class="card-body">
                    @if(session()->has('danger'))
                    <div class="alert alert-danger">{{session()->get('danger')}}</div>
                    @endif

                    <form action="{{url('/admin/login')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Enter Email</label>
                            <input class="form-control" type="email" name="email" id="">
                        </div>
                        <div class="form-group">
                            <label for="">Enter Pasword</label>
                            <input class="form-control" type="password" name="password" id="">
                        </div>
                        <input type="submit" class="btn btn-danger" name="" id="">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MM-Coder-Shop</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://demos.creative-tim.com/argon-dashboard/assets/vendor/nucleo/css/nucleo.css">
    <link rel="stylesheet"
        href="https://demos.creative-tim.com/argon-dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/argon-dashboard/assets/css/argon.min.css?v=1.2.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        #header {
            height: 50vh;
            background: linear-gradient(#007bff, white);
            border-bottom-left-radius: 10%;
            border-bottom-right-radius: 10%;
        }

        #header .nav-link {
            color: white !important;
        }

        #header img {
            width: 60% !important;

        }
    </style>

</head>

<body>
    <!-- Header -->
    <div class="container-fluid" id="header">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand text-white" href="#">MM-Shop</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('/')}}">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Your Order</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            User
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @guest
                            <a class="dropdown-item" href="{{url('/login')}}">Login</a>
                            <a class="dropdown-item" href="{{url('/register')}}">Register</a>
                            @endguest

                            @auth
                            <a class="dropdown-item" href="#">Welcome {{auth()->user()->name}}!</a>
                            <a class="dropdown-item" href="{{url('/logout')}}">Logout</a>
                            @endauth


                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/cart')}}" tabindex="-1" aria-disabled="true">
                            Cart
                            <small class="badge badge-danger">{{ auth()->check() ? $cart_count : 'login'}}</small>
                        </a>
                    </li>
                </ul>
                <form class="form-inline" method="GET">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search"
                        aria-label="Search" value="{{request()->search ? request()->search : ''}}">

                    <button class="btn btn-primary" type="submit">Search</button>
                    @if(request()->search)
                    <a href="/" class="btn btn-danger">Clear</a>
                    @endif
                </form>
            </div>
        </nav>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <h1>Welcome From MM-Coder Shopping Website</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium
                        sequi voluptas similique sed minima rerum labore reprehenderit, illo
                        recusandae quasi tempore placeat aliquam autem, a soluta nisi totam
                        temporibus dolorem!
                    </p>
                    @guest
                    <a href="{{url('/register')}}" class="btn btn-outline-primary">SignUp</a>
                    <a href="{{url('/login')}}" class="btn btn-primary">Login</a>
                    @endguest

                </div>
                <div class="col-md-6 text-center">
                    <img class=""
                        src="https://wp.xpeedstudio.com/seocify/home-fifteen/wp-content/uploads/sites/27/2020/03/home17-banner-image-min.png"
                        alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- End Header -->
    <div class="container mt-3">
        <div class="row">
            <!-- For Category and Information -->
            <div class="col-md-4">
                @auth
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <a href="{{url('/order-list')}}">
                                <li class="list-group-item bg-dark text-white">
                                    Your Order List
                                </li>
                            </a>

                            <li class="list-group-item bg-danger text-white">
                                Your Profile Info
                            </li>
                        </ul>
                    </div>
                </div>
                @endauth


                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item bg-primary text-white">
                                All Category
                            </li>
                            @foreach ($category as $c)
                            <a href="{{url('/?cat_slug='.$c->slug)}}">
                                <li class="list-group-item">
                                    {{$c->name}}
                                    <span class="badge badge-primary float-right">{{$c->product_count}}</span>
                                </li>
                            </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://demos.creative-tim.com/argon-dashboard/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script
        src="https://demos.creative-tim.com/argon-dashboard/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://demos.creative-tim.com/argon-dashboard/assets/js/argon.min.js?v=1.2.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(session()->has('success'))
        toastr.success("{{session()->get('success')}}");
        @endif

        @if(session()->has('error'))
        toastr.error("{{session()->get('error')}}");
        @endif
    </script>

    @yield('script')
</body>

</html>

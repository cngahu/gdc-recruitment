<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login Page | GDC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured recruitment system for GDC" name="description" />
    <meta content="Canjetan Ngahu" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">

    <!-- Bootstrap css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style"/>
    <!-- icons -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Head js -->
    <script src="{{ asset('backend/assets/js/head.js') }}"></script>

</head>

{{--<body style="background-image: url('{{ asset('backend/assets/images/background.png') }}');background-size: cover;">--}}
{{--<body style="background-color:#29A94A ;background-size: cover;">--}}
<body style="background-color: #057833;background-size: cover;">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card bg-pattern">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="" class="logo logo-dark text-center">
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="" height="155">
                    </span>
                                </a>

                                <a href="" class="logo logo-light text-center">
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="" height="155">
                    </span>
                                </a>
                            </div>

                        </div>
                        <br>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="login" class="form-label">Email</label>

                                <input class="form-control @error('email') is-invalid @enderror" name="email" type="text" id="email" required="" placeholder="Enter your email">
                                @error('email')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
                                    @error('password')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror


                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>

{{--                            <div class="mb-3">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>--}}
{{--                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="text-center d-grid">
                                <button class="btn" type="submit" style="background-color:#EE4049;color: white"> Login </button>
                            </div>

                        </form>



                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white"> <a href="{{route('password.request')}}" class="text-white-50 ms-1" style="color: white">Forgot your password?</a></p>
                        <p class="text-white-50">Don't have an account? <a href="{{route('register')}}" class="text-white ms-1"><b>Sign Up</b></a></p>
                    </div> <!-- end col -->
                </div>

                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


<footer class="footer footer-alt">
    &copy;  <a href="https://psasb.go.ke/" class="text-black-50" target="_blank" style="font-weight: bolder">GDC</a>   <script class="text-dark">document.write(new Date().getFullYear())</script>
</footer>

<!-- Vendor js -->
<script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('backend/assets/js/app.min.js') }}"></script>

</body>
</html>

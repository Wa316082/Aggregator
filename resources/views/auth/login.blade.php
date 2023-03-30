@extends('layouts.app')
@section('title','Login')
@section('content')


    <!DOCTYPE html>
<html lang="en">


<body class="">

<div class="row vh-100 " >
    <!--Auth fluid left content -->
    <div class="col-md-10 col-lg-4 m-auto">
        <div class="align-items-center d-flex h-100">
            <div class="card-body">



                <!-- title-->
                <h4 class="mt-0">Sign In</h4>
                <p class="text-muted mb-4">Enter your email address and password to access account.</p>

                <!-- form -->
                <form  method="POST" action="">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input  class="form-control @error('email') is-invalid @enderror" type="email" id="emailaddress"   name="email" required="" placeholder="Enter your email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <a href="auth-recoverpw-2.html" class="text-muted float-right"><small>Forgot your password?</small></a>
                        <label for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter your password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="input-group-append"onclick="myFunction()" >
                                <div class="input-group-text">
                                    <span class="password-eye font-12"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" type="submit">{{ __('Login') }}</button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                    <!-- social-->
                    <div class="text-center mt-4">
                        <p class="text-muted font-16">Sign in with</p>
                        <ul class="social-list list-inline mt-3">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                            </li>
                        </ul>
                    </div>
                </form>
                <!-- end form-->

                <!-- Footer-->
                <footer class="text-center mt-4">
                    <p class="text-secondary fs-6">Don't have an account? <a href="{{ url('/register') }}" class=" ml-1"><b>Sign Up</b></a></p>
                </footer>

            </div> <!-- end .card-body -->
        </div> <!-- end .align-items-center.d-flex.h-100-->
    </div>
    <div class=" d-none d-md-none d-lg-block col-lg-8 vh-100 position-relative " >
        <h1 class="position-absolute text-white" style="bottom: 20%; left:20%;">Welcome to E-Desh Theke
            <br> Deliver all around the World!!!</h1>

        <img class="vh-100 w-100" src="{{ asset('Admin/assets/images/bg-auth.jpg') }}" alt="">
    </div>

</div>

{{-- <script src="{{asset('Admin/assets/js/vendor.min.js')}}"></script> --}}

<!-- App js -->
{{-- <script src="{{asset('Admin/assets/js/app.min.js')}}"></script> --}}

<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>

{{-- <script src="{{asset('Admin/assets/js/vendor.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('Admin/assets/js/app.min.js')}}"></script> --}}


</body>
</html>
@endsection



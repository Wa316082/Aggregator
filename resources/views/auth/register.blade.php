@extends('layouts.app')

@section('content')

    <div class="container py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 >{{ __('Register') }}</h4>
                <a class="btn btn-primary"  href="{{ url('/') }}">
                    Back
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action=" {{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstname" class=" col-form-label text-md-end">{{ __('First Name') }}</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror"  name="firstname" placeholder="First name" value="{{ old('firstname') }}"  autocomplete="firstname" autofocus >
                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror


                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastname" class="col-form-label text-md-end">{{ __('Last Name') }}</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" placeholder="Last name"value="{{ old('lastname') }}"  autocomplete="lastname"  >
                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror


                       </div>


                        <div class="col-md-6  mb-3 ">
                            <label for="username" class="col-form-label text-md-start">{{ __('User Name') }}</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="User name"value="{{ old('username') }}"  autocomplete="username" >
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-6  mb-3">
                            <label for="email" class="col-form-label text-md-start">{{ __('Email') }}</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter your Enail Address" value="{{ old('email') }}"  autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-6  mb-3">
                            <label for="password" class="col-form-label text-md-start">{{ __('Password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password"   >
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="col-md-6  mb-3">
                            <label for="image" class="col-form-label text-md-start">{{ __('Image') }}</label>
                            <input type="file" class="form-control " name="image" placeholder="image"  >
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="col-md-6  mb-3">
                            <label for="password-confirm" class="col-form-label text-md-start">{{ __('Confirm password') }}</label>
                            <input type="password" class="form-control @error('password-confirm') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password"   >

                        </div>

                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>





                </form>

            </div>


        </div>

    </div>

@endsection

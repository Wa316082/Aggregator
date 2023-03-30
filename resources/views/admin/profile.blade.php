@extends('layouts.auth_layouts')
@section('title','Admin Dashboard')

@section('admin_home_content')
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
       <div class="row mt-4">
        <div class="col-md-12">
            <div class="card-box text-center">
                <img src="{{asset('Admin/assets/images/users/user-1.jpg')}}" class="rounded-circle avatar-lg img-thumbnail"
                    alt="profile-image">

                <h4 class="mb-0">{{ $user->name }}</h4>
                <p class="text-muted">{{ $user->email }}</p>

                <button type="button" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Follow</button>
                <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Message</button>

                <div class="text-left mt-3">
                    <h4 class="font-13 text-uppercase">About Me :</h4>
                    <p class="text-muted font-13 mb-3">
                        Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the
                        1500s, when an unknown printer took a galley of type.
                    </p>
                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{ $user->name }}</span></p>

                    <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">(123)
                            123 1234</span></p>

                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ $user->email }}</span></p>

                    <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">Bangladesh</span></p>
                </div>

                <ul class="social-list list-inline mt-3 mb-0">
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i
                                class="mdi mdi-facebook"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                class="mdi mdi-google"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                class="mdi mdi-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i
                                class="mdi mdi-github"></i></a>
                    </li>
                </ul>
            </div>
        </div>
       </div>
    </div>
</div>

@endsection

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <title>Log In | UBold - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('Admin/assets/images/e-desh.ico')}}">

    <!-- App css -->
    <link href="{{asset('Admin/assets/css/bootstrap-modern.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{asset('Admin/assets/css/app-modern.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    {{--    <link href="{{asset('Admin/assets/css/bootstrap-modern-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />--}}
    {{--    <link href="{{asset('Admin/assets/css/app-modern-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />--}}

    {{--    <!-- icons -->--}}
    <link href="{{asset('Admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    {{--    <link href="{{asset('Admin/assets/css/app.css')}}" rel="stylesheet" type="text/css" />--}}

</head>
<body>
    <div id="app">


        <main class="">
            @yield('content')
        </main>
    </div>
</body>
</html>

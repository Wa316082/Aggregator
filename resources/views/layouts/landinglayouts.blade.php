<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Event and Conference Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Eventre HTML Template v1.0">


    <!-- PLUGINS CSS STYLE -->
    {{-- favicon --}}
    <link rel="shortcut icon" href="{{asset('Admin/assets/images/e-desh.ico') }}">
    <!-- Bootstrap -->
    <link href="{{ asset('Landingpage/plugins/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('Landingpage/plugins/font-awsome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Magnific Popup -->
    <link href="{{ asset('Landingpage/plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    <!-- Slick Carousel -->
    <link href="{{ asset('Landingpage/plugins/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('Landingpage/plugins/slick/slick-theme.css') }}" rel="stylesheet">
    <!-- CUSTOM CSS -->
    <link href="{{ asset('Landingpage/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('Landingpage/css/globalFulfillment.css') }}" rel="stylesheet">

    <!-- FAVICON -->


</head>

<body class="body-wrapper">


    <!--========================================
=            Navigation Section            =
=========================================-->
    <nav class=" navbar main-nav border-less fixed-top navbar-expand-lg p-0">
        <div class="container-fluid p-0">
            <!-- logo -->
            <a class="navbar-brand" href="#">
                <img class="w-100" src="{{ asset('Landingpage/images/logo1.png') }}" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item dropdown active">
                        <a class="nav-link" href={{ url('/') }}>Solution</a>
                        {{-- <span>/</span> --}}
                        {{-- </a> --}}
                        {{-- <a class="nav-link" href="#!" data-toggle="dropdown">Solution<i class="fa fa-angle-down"></i> --}}
                        {{-- <span>/</span> --}}
                        {{-- </a> --}}
                        <!-- Dropdown list -->
                        <ul class="dropdown-menu menu">
                            <li><a class="dropdown-item text-center" href="#">eCommerce Merchants</a>
                                <ul class="submenu2">
                                    <li class="dropdown-item "><a href=" {{ url('/overview') }} " class="text-dark">Overview</a></li>
                                    <li class="dropdown-item"><a href="{{ url('dashbord') }}" class="text-dark">
                                            Shipping Dashboard</a></li>
                                    <li class="dropdown-item"><a href="{{ url('landing') }}" class="text-dark"> Integration</a></li>
                                    <li class="dropdown-item"><a href="{{ url('globalfullfillment') }}" class="text-dark">Global Fulfillment</a>
                                    </li>
                                </ul>

                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features
                            {{-- <span>/</span> --}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Subscription
                            {{-- <span>/</span> --}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing
                            {{-- <span>/</span> --}}
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#!" data-toggle="dropdown"> <i class="fa fa-angle-down"></i></a>
                        <!-- Dropdown list -->
                        {{-- <ul class="dropdown-menu"> --}}
                        {{-- <li><a class="dropdown-item" href="about-us.html">About Us</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="single-speaker.html">Single Speaker</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="gallery.html">Gallery</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="gallery-two.html">Gallery-02</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="testimonial.html">Testimonial</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="pricing.html">Pricing</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="FAQ.html">FAQ</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="404.html">404</a></li> --}}

                        {{-- <li class="dropdown dropdown-submenu dropright"> --}}
                        {{-- <a class="dropdown-item dropdown-toggle" href="#!" id="dropdown0301" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sub Menu</a> --}}

                        {{-- <ul class="dropdown-menu" aria-labelledby="dropdown0301"> --}}
                        {{-- <li><a class="dropdown-item" href="index.html">Submenu 01</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="index.html">Submenu 02</a></li> --}}
                        {{-- </ul> --}}
                        {{-- </li> --}}
                        {{-- </ul> --}}
                        {{-- </li> --}}
                        {{-- <li class="nav-item"> --}}
                        {{-- <a class="nav-link" href="schedule.html">Schedule</a> --}}
                        {{-- </li> --}}
                        {{-- <li class="nav-item"> --}}
                        {{-- <a class="nav-link" href="sponsors.html">Sponsors</a> --}}
                        {{-- </li> --}}
                        {{-- <li class="nav-item dropdown"> --}}
                        {{-- <a class="nav-link" href="#!" data-toggle="dropdown">News <i class="fa fa-angle-down"></i> --}}
                        {{-- </a> --}}
                        {{-- <!-- Dropdown list --> --}}
                        {{-- <ul class="dropdown-menu"> --}}
                        {{-- <li><a class="dropdown-item" href="news.html">News without sidebar</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="news-right-sidebar.html">News with right sidebar</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="news-left-sidebar.html">News with left sidebar</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="news-single.html">News Single</a></li> --}}

                        {{-- <li class="dropdown dropdown-submenu dropleft"> --}}
                        {{-- <a class="dropdown-item dropdown-toggle" href="#!" id="dropdown0501" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sub Menu</a> --}}

                        {{-- <ul class="dropdown-menu" aria-labelledby="dropdown0501"> --}}
                        {{-- <li><a class="dropdown-item" href="index.html">Submenu 01</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="index.html">Submenu 02</a></li> --}}
                        {{-- </ul> --}}
                        {{-- </li> --}}
                        {{-- </ul> --}}
                        {{-- </li> --}}
                        {{-- <li class="nav-item"> --}}
                        {{-- <a class="nav-link" href="#">Contact</a> --}}
                        {{-- </li> --}}
                </ul>
                <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center  sm:pt-0">
                    @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                        @if ( Auth::user()->role_id == 1)
                        <a href="{{ url('/admin/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" id="signing">Home</a>
                        @elseif( Auth::user()->role_id == 2)
                        <a href="{{ url('/user/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" id="signing">Home</a>
                        @elseif( Auth::user()->role_id == 3)
                        <a href="{{ url('/merchant/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" id="signing">Home</a>
                        @else
                        <p>nothing</p>
                        @endif
                        @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" id="signing">Sign In</a>

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" id="signup">Sign
                            Up</a>
                        @endif
                        @endauth
                    </div>
                    @endif


                </div>

                {{-- <button class="  mr-2 " id="signing" type="button">Sign In</button>
            <button class=" " id="signup">Sign Up</button> --}}
                {{-- <a href="contact.html" class="ticket"> --}}
                {{-- <img src="{{asset('Landingpageimages/images/icon/ticket.png')}}" alt="ticket"> --}}
                {{-- <span>Sign up</span> --}}
                {{-- </a> --}}
            </div>
        </div>
    </nav>

    {{-- <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
    @else
    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

    @if (Route::has('register'))
    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
    @endif
    @endauth
    </div>
    @endif


    </div> --}}


    @yield('content')


    <!--====  End of Google Map  ====-->

    <!--============================
=            Footer            =
=============================-->

    <footer class="bg-img">
        <div class="container m-auto row ">

                <div class="col-lg-4 col-md-4 col-10 my-4 mx-auto mt-5 ">
                    <h5 class="text-primary">SHIP</h5>
                    <p class="text-dark mt-2">Ship a Packege</p>
                    <p class="text-dark mt-2">Generate Shipping Labels</p>
                    <p class="text-dark mt-2">Track & Marge Your Orders</p>
                    <p class="text-dark mt-2">Access Exclusive Carrier Rates</p>
                    <p class="text-dark mt-2">Ship Globally</p>
                    <p class="text-dark mt-2">Explore Our Open API</p>
                </div>
                <div class="col-lg-4 col-md-4 col-10 mt-5 m-auto  ">
                    {{-- <img class="w-75" src=" {{ asset('Landingpage/images/logo.png') }} " --}}
                    {{-- alt=""> --}}
                    <div class="m-auto">
                        <p class="text-white mt-4">Simplify and save with our all in
                            one shipping software
                        </p>
                        <div class="d-flex align-items-center  mt-2   ">
                            <input type="search" class="form-control m-auto bg-white rounded-pill" placeholder="Subscribe For Update...">
                            <Button type="submit" class="btn text-white  " style="background-color: rgb(10, 204, 10); height:40px; width:80px; margin-left: 6px;">GO</Button>
                        </div>
                        <p class="text-white mt-2">
                            Terms of Service | Privacy Policy
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-10 my-4 mt-5  ">

                        <h5 class="text-success text-md-right text-center ">COMPANY</h5>
                        <ul class=" text-md-right text-center ">
                            <li class="mb-3" style="list-style-type: none">
                                <a class="text-white " href="#">About Us</i></a>
                            </li>
                            <li class="mb-3" style="list-style-type: none">
                                <a class="text-white" href="#">What's New</i></a>
                            </li>

                            <li class="mb-3" style="list-style-type: none">
                                <a class="text-white" href="#">Careers</i></a>
                            </li>
                            <li class="mb-3" style="list-style-type: none">
                                <a class="text-white" href="#">Become An Affiliate</i></a>
                            </li>
                            <li class="mb-3" style="list-style-type: none">
                                <a class="text-white" href="#">Contact Us</i></a>
                            </li>
                        </ul>

                </div>

        </div>



            <div class="d-flex justify-content-between px-4 mt-5">
                <div>
                    <div class="d-flex text-center">
                        <select class=" border-0 text-white bg-transparent">
                            <option selected>Language</option>
                            <option class="text-dark" value="1">One</option>
                            <option class="text-dark" value="2">Two</option>
                            <option class="text-dark" value="3">Three</option>
                        </select>

                        <select class=" border-0 text-white bg-transparent mx-4">
                            <option selected>Country</option>
                            <option class="text-dark" value="1">One</option>
                            <option class="text-dark" value="2">Two</option>
                            <option class="text-dark" value="3">Three</option>
                        </select>

                    </div>
                </div>
                {{-- <div class="  w-100 ">
                    <div class="copyright-text ">
                        <p><a class="text-white" href="#">Aggregat</a> <span class="text-white">&copy; 2022,
                                Designed &amp; Developed by</span> <a class="text-white" href="#">Edesh
                                TechTeam</a></p>
                    {{-- </div>
                </div> --}}

                <div class=" ">

                        <ul class="social-links-footer list-inline  ">
                            <li class="list-inline-item mt-2 ">
                                <a class=" " href="#"><i class="fa fa-facebook rounded bg-transparent border border-white py-2 px-3 hover"></i></a>
                            </li>
                            <li class="list-inline-item mt-2 ">
                                <a class=" " href="#"><i class="fa fa-twitter rounded bg-transparent border border-white py-2 px-3 hover"></i></a>
                            </li>
                            <li class="list-inline-item mt-2">
                                <a class=" " href="#"><i class="fa fa-instagram rounded bg-transparent border border-white py-2 px-3 hover"></i></a>
                            </li>
                            <li class="list-inline-item mt-2">
                                <a class=" " href="#"><i class="fa fa-rss rounded bg-transparent border border-white py-2 px-3 hover"></i></a>
                            </li>
                            <li class="list-inline-item mt-2">
                                <a class=" " href="#"><i class="fa fa-vimeo rounded bg-transparent border border-white py-2 px-3 hover"></i></a>
                            </li>
                        </ul>

                </div>
            </div>
    </footer>


    <!-- Modal -->
    <div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tracking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="background: #e7f4f9">
                        <div class="container  py-5">
                            <h4>Order Tracking</h4>
                            <div class="text-dark parcel_container my-5">
                                <div class="row justify-content-between bg-white p-3">
                                    <div class="">Order Id </div>
                                    <div class="order_id">



                                    </div>
                                </div>

                                <div class="row justify-content-between bg-white p-3 mt-2">

                                    <div>
                                        <h4>Shipping Info</h4>
                                    </div>


                                    <div class="tracking_details">


                                    </div>
                                </div>

                                <div class="bg-transparent">
                                    <div class="my-4">
                                        <h4>Tracking Details</h4>
                                    </div>
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Order id</th>
                                                <th>Status Id</th>
                                                <th>Sub-Status Id</th>
                                                <th>Posted On</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tracking_table">

                                        </tbody>

                                    </table>
                                </div>

                                <div>
                                    <div class="display-4 p-3">

                                    </div>

                                    <p>In Transit</p>
                                </div>
                            </div>
                            <div class={outForDelivery}>
                                <div class="display-4 p-3">

                                </div>


                            </div>
                        </div>
                        <div>
                            <div class="display-4 p-3">

                            </div>
                            <div class="text-center">
                                <p class="d-inline " style="opacity: 0">
                                    -----
                                </p>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <footer class="subfooter">
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <div class="copyright-text">
                        <p><a href="#">Aggregat</a> &copy; 2022, Designed &amp; Developed by <a href="#">Edesh TechTeam</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <a href="#" class="to-top"><i class="fa fa-angle-up"></i></a>
                </div>
            </div>
        </div>
    </footer>




    <!-- JAVASCRIPTS -->
    <!-- jQuey -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ asset('Landingpage/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('Landingpage/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <!-- Shuffle -->
    <script src="{{ asset('Landingpage/plugins/shuffle/shuffle.min.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('Landingpage/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <!-- Slick Carousel -->
    <script src="{{ asset('Landingpage/plugins/slick/slick.min.js') }}"></script>
    <!-- SyoTimer -->
    <script src="{{ asset('Landingpage/plugins/syotimer/jquery.syotimer.min.js') }}"></script>
    <!-- Google Mapl -->
    <script src="{{ asset('https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU') }}">
    </script>
    <script src="{{ asset('Landingpage/plugins/google-map/gmap.js') }}"></script>
    <!-- Custom Script -->
    <script src="{{ asset('Landingpage/js/script.js') }}"></script>


    <script>
        // Wait for document to load
        $(document).ready(() => {

            $("#landingsearch").keypress(function(e) {
                if (e.keyCode == 13) {
                    let data = $(this).val();
                    $('#my-modal').modal('toggle');
                    $('.order_id').html('');
                    $('.tracking_details').html('');
                    $('.tracking_table').html('');


                    // console.log(data);

                    $.ajax({
                        type: "GET"
                        , url: `tracking/${data}`
                        , success: function(response) {
                            // console.log(response);
                            var reports =
                                `
                                <p class="d-inline pe-2  ">

                                    ${response.rootcategories.custom_order_id}
                                </p>
                            `;
                            var data = $('.order_id').append(reports);
                            var details =
                                `<p class="d-flex justify-content-between "><span class=" mr-4 text-info ">Customer
                                            Mobile Number : </span>${response.rootcategories.order.customer_mobile}</p>
                                    <p class="d-flex justify-content-between text-start">
                                        <span class=" mr-4 text-info ">Customer Name :
                                        </span>${response.rootcategories.order.customer_name}
                                    </p>

                                    <p class="d-flex justify-content-between text-start">
                                        <span class=" mr-4 text-info ">Delivery Location : </span>

                                        ${response.location.name}
                                    </p>
                                    <p class=" d-flex justify-content-between text-start"><span
                                            class=" mr-4 text-info ">Actual Amount :
                                        </span>${response.rootcategories.order.actual_amount}</p>
                                    <p class=" d-flex justify-content-between text-start"><span
                                            class=" mr-4 text-info ">Collected Amount :
                                        </span>${response.rootcategories.order.collection_amount}</p>

                            `;
                            var data1 = $('.tracking_details').append(details)

                            $.each(response.histories, function(index, value) {
                                var orders =
                                    `
                                <tr>
                                    <td>${value.custom_order_id}</td>
                                    <td>${value.substatus.status.name}</td>
                                    <td>${value.substatus.name}</td>
                                    <td>${value.posted_on}</td>
                                </tr>
                            `;
                                var data = $('.tracking_table').append(orders);

                            });

                        }
                    });

                }
            });


        });

    </script>


</body>

</html>

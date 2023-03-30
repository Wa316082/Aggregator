@extends('layouts.landinglayouts')
@section('title', 'Edesh Theke')
@section('content')

    <section class=" banner-body " id="overview">
        <div class="row ">
            <div class=" col-lg-6 col-md-8 col-10 m-auto p-0">
                <input class="w-100 p-2 shadow " type="text" id="landingsearch" placeholder="Track Your Parcel Here"/>
            </div>
        </div>
    </section>

    <section class=" mt-5 bg-gradient">
        <div class="container">
            <div class="row  ">
                <div class="col-lg-6 col-md-6 col-10 m-auto py-5 ">
                    <h1 class="text-success">Your Onestop
                        eCommerce Shipping
                        Solution</h1>
                    <h4 class="text-dark fs-4 pt-4">The all-in-one shipping management tool built for
                        your business
                    </h4>
                    <button class="button-primary mt-4">Get Started</button>
                </div>
                <div class="col-lg-6 col-md-6 col-10 mt-4 position-relative content-size mx-auto    ">

                    <div class="position-absolute box-1-position box-1 ">

                    </div>
                    <div class="position-absolute box-2-position  box-2  ">

                    </div>


                </div>

            </div>
            <div class="row py-5 ">
                <div class="col-lg-6 col-md-6  col-10 m-auto   ">
                    <img class="w-75  " src="{{ asset('Landingpage/images/image 2.jpg') }}" alt="image">
                </div>
                <div class="col-lg-6 col-md-6 col-10 mt-5 mt-sm-0 mx-auto     ">
                    <h2 class="text-success">Book your shipment in minutes</h2>
                    <p class="section-p ">Connecting with Easyship allows you to sync your orders, generate pre-filled
                        labels, and get automatically
                        updated tracking numbers in your store. We integrate directly with all major
                        eCommerce store platforms and there is no limit to how many stores you can connect.
                        <br> <br>
                        On your own platform or have custom requirements? <span class="text-success">Connect using our
                        powerful API.</span>

                    </p>
                </div>
            </div>


        </div>
    </section>

    <section class="card-div ">
        <div class="container">
            <div class="row  ">
                <div class="col-lg-6 col-md-6  col-10 m-auto  p-4">
                    <h2 class="text-success ">Access to all logistic services</h2>
                    <p class="mt-4">Gain access to 250+ shipping solutions , or take advantage of our hybrid solutions.
                        We have specialized options to serve every country in the world, and these are available the
                        second you sign up.</p>
                </div>

                <div class="col-lg-6 col-md-6  col-10 mx-auto  ">

                </div>
            </div>
            <div class="row mt-2 ">


                <div class="col-lg-6 col-md-6  col-10 m-auto">

                </div>

                <div class="col-lg-6 col-md-6  col-10 m-auto p-4">
                    <h2 class="text-success ">Get all inclusive shipping quotes</h2>
                    <p class="mt-4">25% of customers abandon their carts due to
                        unexpected shipping costs at checkout. Show accurate rates directly to your customers in
                        real-time with our Rates at Checkout.</p>
                </div>
            </div>

        </div>

    </section>

    <section class="banner-bg-color">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 py-5 col-10 mx-auto">
                    <h3>All this, tied together by our powerful</h3>
                    <h4 class="text-success">DASHBOARD</h4>
                </div>
                <div class="col-lg-6 col-md-6  col-10 py-5 mx-auto">
                    <img class="w-75" src=" {{asset('Landingpage/images/image 2.jpg')}} " alt="">
                </div>


            </div>

        </div>


    </section>
    <section class="banner-style banner-size-2 position-relative" id="background-wrap">
        <div class=" position-absolute  shape-1 ">

        </div>
        <div class="col-lg-8 col-md-8 col-10 text-center m-auto pt-5">
            <h3 class="text-success pt-5">100,000+ online sellers can’t be wrong
            </h3>
            <h4>Sign up for free and start shipping like a pro in minutes!</h4>
        </div>
        <div class="position-absolute  shape-2">

        </div>
    </section>
    <section class="card-div">
        <div class="container">
            <div class="py-5">
                <h3 class="text-success text-center pb-5">
                    Additional Resources
                </h3>
                <div class="row  ">
                    <div class="col-lg-4 col-md-6 col-10  mx-auto ">
                        <div class="card mb-4" style="width: 18rem;">
                            <div class="px-2">
                                <p class="card-text">Shipping tips & solution</p>
                                <h5 class="card-title text-primary">What's the Cheapest Way to Ship Pakeges in
                                    2022?</h5>
                            </div>
                            <div class="card-body px-0">
                                <img class="w-100" src="{{asset('Landingpage/images/bg-image1.jpg')}}">

                            </div>
                            <a href="#" class="text-primary px-2">Go somewhere</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-10  mx-auto ">
                        <div class="card mb-4" style="width: 18rem;">
                            <div class="px-2">
                                <p class="card-text">Shipping tips & solution</p>
                                <h5 class="card-title text-primary">What's the Cheapest Way to Ship Pakeges in
                                    2022?</h5>
                            </div>
                            <div class="card-body px-0">
                                <img class="w-100" src="{{asset('Landingpage/images/bg-image1.jpg')}}">

                            </div>
                            <a href="#" class="text-primary px-2">Go somewhere</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-10  mx-auto ">
                        <div class="card mb-4" style="width: 18rem;">
                            <div class="px-2">
                                <p class="card-text">Shipping tips & solution</p>
                                <h5 class="card-title text-primary">What's the Cheapest Way to Ship Pakeges in
                                    2022?</h5>
                            </div>
                            <div class="card-body px-0">
                                <img class="w-100" src="{{asset('Landingpage/images/bg-image1.jpg')}}">

                            </div>
                            <a href="#" class="text-primary px-2">Go somewhere</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-10  mx-auto ">
                        <div class="card mb-4" style="width: 18rem;">
                            <div class="px-2">
                                <p class="card-text">Shipping tips & solution</p>
                                <h5 class="card-title text-primary">What's the Cheapest Way to Ship Pakeges in
                                    2022?</h5>
                            </div>
                            <div class="card-body px-0">
                                <img class="w-100" src="{{asset('Landingpage/images/bg-image1.jpg')}}">

                            </div>
                            <a href="#" class="text-primary px-2">Go somewhere</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-10  mx-auto ">
                        <div class="card mb-4" style="width: 18rem;">
                            <div class="px-2">
                                <p class="card-text">Shipping tips & solution</p>
                                <h5 class="card-title text-primary">What's the Cheapest Way to Ship Pakeges in
                                    2022?</h5>
                            </div>
                            <div class="card-body px-0">
                                <img class="w-100" src="{{asset('Landingpage/images/bg-image1.jpg')}}">

                            </div>
                            <a href="#" class="text-primary px-2">Go somewhere</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-10  mx-auto ">
                        <div class="card mb-4" style="width: 18rem;">
                            <div class="px-2">
                                <p class="card-text">Shipping tips & solution</p>
                                <h5 class="card-title text-primary">What's the Cheapest Way to Ship Pakeges in
                                    2022?</h5>
                            </div>
                            <div class="card-body px-0">
                                <img class="w-100" src="{{asset('Landingpage/images/bg-image1.jpg')}}">

                            </div>
                            <a href="#" class="text-primary px-2">Go somewhere</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </section>

@endsection

@extends('layouts.landinglayouts')
@section('title', 'Edesh Theke')
@section('content')

    <section class=" banner-body " id="dashbord">
        <div class="row ">
            <div class=" col-lg-6 col-md-8 col-10 mx-auto p-0">
                <form action="" class="track">
                    <input class="w-100 p-2 shadow  " type="text" id="landingsearch" placeholder="Track Your Parcel Here"/>
                </form>
            </div>
        </div>
    </section>

    <section class=" mt-5 bg-gradient ">
        <div class="container position-relative">
            <div class="position-absolute box-2 position-1 m-auto  ">
            </div>
            <div class="position-absolute box-2 position-2 m-auto  ">
            </div>
            <div class="position-absolute box-2 position-3 m-auto  ">
            </div>
            <div class="row  ">
                <div class="col-lg-6 col-md-6 col-10 m-auto py-5 ">
                    <h4 class="text-success fs-3 ">Shipping Platform That Grows
                        Your Business & Optimized Cost</h4>
                    <p class="text-dark fs-4 pt-4">Grow your eCommerce business with our streamlined cloud-based
                        shipping tool. Save time with shipping automation. Save money with discounted rates. Start in
                        minutes.
                    </p>
                    <div class="mx-auto text-center">
                        <button class="button-primary mt-4 ">Ship Now</button>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-10 text-center mt-4  mx-auto     ">

                    <div class="w-100 text-center ">
                        <img class="w-75  " src="{{ asset('Landingpage/images/image 2.jpg') }}" alt="image">
                    </div>

                </div>

            </div>
            <div class="row py-5 ">

                <div class="col-lg-6 col-md-6 col-10 mt-5 mt-sm-0 mx-auto mb-5      ">
                    <h2 class="text-info  ">Shipping Done Right</h2>
                    <h5 class="text-info mt-3  ">All Your Shipments in One Place</h5>
                    <p class="mt-3">Manage orders and create shipments instantly in the Shipping Dashboard. Import
                        orders, upload CSVs, or sync directly from your eCommerce store. You’re ready in just a
                        click.</p>
                </div>
                <div class="col-lg-6 col-md-6  col-10 m-auto   ">
                    <!---->
                </div>
            </div>

        </div>
    </section>

    <section class=" bg-gradient-2">
        <div class="container ">

            <div class="row  ">
                <div class="col-lg-6 col-md-6 col-10 text-center mt-4 ">

                </div>
                <div class="col-lg-6 col-md-6 col-10 m-auto py-5 ">
                    <h4 class="text-success fs-3 ">Pick & Choose Your International
                        & Local Delivery Solution</h4>
                    <p class="text-dark fs-4 pt-4">Customize your shipping preferences and avoid wasting time on
                        repetitive, manual work. Set automation based on courier selection, delivery preference, package
                        size, product value, and more.
                    </p>

                </div>


            </div>
            <div class="row py-5 ">

                <div class="col-lg-6 col-md-6 col-10 mt-5 mt-sm-0 mx-auto mb-5      ">
                    <h4 class="text-success  ">Generate Labels & Shipping Docs</h4>
                    <p class="mt-3">Take the guesswork out of shipping documentation. Our shipping tool generates all
                        your shipping labels, packing slips and customs paperwork for you automatically. Print only what
                        you need.</p>
                </div>
                <div class="col-lg-6 col-md-6  col-10 m-auto   ">
                    <!---->
                </div>
            </div>

        </div>
    </section>

    <section class=" bg-light position-relative" style="overflow:hidden;">
        <div class="shape-3 position-absolute rounded-circle shape-3-position-1">

        </div>
        <div class="shape-3 position-absolute rounded-circle shape-3-position-2">

        </div>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-10  mt-4 m-auto text-center ">
                    <img class="w-75" src=" {{asset('Landingpage/images/S-B.jpg')}} " alt="">
                </div>
                <div class="col-lg-6 col-md-6 col-10 text-end mt-4 text-center mx-auto ">
                    <img class="w-75" src=" {{asset('Landingpage/images/aramex.jpg')}} " alt="">
                </div>

            </div>

            <div class="row mt-5">
                <div class="col-lg-6 col-md-6 col-10  mt-4 mx-auto lg-m-auto ">
                    <h4 class="text-info">Connect Your eCommerce Platforms</h4>
                    <p>Our automated shipping tool integrates in seconds with all top eCommerce platforms. This includes
                        software solutions like Shopify and Magento, crowdfunding sites like Indiegogo and Kickstarter,
                        plus Amazon and Etsy. Native integrates allow for seamless order syncs, inventory management,
                        and real-time analytics.</p>
                </div>
                <div class="col-lg-6 col-md-6 col-10  mt-4 mx-auto  ">
                    <h4 class="text-info">Get the Cheapest Shipping Rate, Guaranteed</h4>
                    <p>Instantly access the guaranteed cheapest rates from 250+ global shipping carriers on every
                        shipment. Our shipping platform is your “in” for pre-negotiated discount rates up to 91% off
                        retail, including for USPS and UPS shipping. Or link your courier account to use your own
                        rates</p>
                </div>

            </div>

        </div>

    </section>
    <section class="card-div bg-light ">

        <div class="container py-5">


            <div class="row my-5">
                <div class="col-lg-8 col-md-6 col-10  mt-4 mx-auto ">
                    <h3 class="text-success">Realtime Tracking & Returns</h3>
                    <h4>Best in Class Tracking</h4>
                    <p>Maintain visibility of packages with real time accurate tracking for all couriers. Share tracking
                        info on a dedicated
                        professional tracking page. Use our automated shipping tool to ensure a
                        flawless customer experience worth repeating.
                    </p>
                    <h4 class="mt-4">Manage COD With a Click</h4>
                    <p>Generating a return label? Done. Our shipping platform automatically emails the documents to your
                        customer
                        to save time (if you like).
                    </p>
                    <h4 class="mt-5 text-success">Learn More About Customer Journey</h4>
                </div>
                <div class="col-lg-4 col-md-6 col-10  mt-4  ">

                </div>

            </div>

        </div>

    </section>

   


@endsection

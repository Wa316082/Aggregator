@extends('layouts.landinglayouts')

@section('title','Edesh Theke')
@section('content')

    {{--bg-banner-one--}}
    <section class="banner " id="solution">
        <div class="container">
            <div class="row ">
                <div class=" col-lg-6 col-md-8 col-10 m-auto pb-5">
                    <input class="w-100 p-2 shadow " type="text" id="landingsearch"
                           placeholder="Track Your Parcel Here"/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-10 m-auto py-3">
                    <h1>Leading Shipping Platform to</h1>
                    <h4 class="banner-text">Enable your business reach internationally
                    </h4>
                    <p>Connect your business overseas utilizing our platform for worldwide shipping solutions. Have the ability
                        and flexibility to choose between different service providers at the same time having the ability to track
                        your shipment from pick-up to delivery.</p>
                    <button class="button-primary mt-4">Get Started For Free</button>
                </div>
                <div class="col-lg-6 col-md-6 col-10 mt-4 bg">

                    <div id="background-wrap">
                        <div id="background-wrap">

                            <div class="bubble x1 bg-primary d-flex justify-content-center ">
                                <div class="align-self-center text-dark">
                                    <h2>-65%</h2>
                                </div>
                            </div>

                            <div class="bubble x2 bg-primary d-flex justify-content-center">
                                <div class="align-self-center text-dark">
                                    <h2>-75%</h2>
                                </div>
                            </div>

                            <div class="bubble x3 bg-primary d-flex justify-content-center">
                                <div class="align-self-center text-dark">
                                    <h2>+25%</h2>
                                </div>
                            </div>

                            <div class="bubble x4 bg-primary d-flex justify-content-center">
                                <div class="align-self-center text-dark">
                                    <h2>05%</h2>
                                </div>
                            </div>

                            <div class="bubble x5 bg-primary d-flex justify-content-center">
                                <div class="align-self-center text-dark">
                                    <h2>05%</h2>
                                </div>
                            </div>

                            <div class="bubble x6 d-flex justify-content-center">
                                <div class="align-self-center text-dark">
                                    <h2>05%</h2>
                                </div>
                            </div>

                            <div class="bubble x7 d-flex justify-content-center">
                                <div class="align-self-center text-dark">
                                    <h2>05%</h2>
                                </div>
                            </div>

                            <div class="bubble x8 d-flex justify-content-center">
                                <div class="align-self-center text-dark">
                                    <h2>05%</h2>
                                </div>
                            </div>

                            <div class="bubble x9 d-flex justify-content-center ">
                                <div class="align-self-center text-dark">
                                    <h2>05%</h2>
                                </div>
                            </div>

                            <div class="bubble x10 d-flex justify-content-center ">
                                <div class="align-self-center text-dark">
                                    <h2>05%</h2>
                                </div>
                            </div>

                        </div>


                        <img class="w-100" src="{{asset('Landingpage/images/bg-image1.jpg')}}">
                        {{--                    <div class="img-banner">--}}

                        {{--                    </div>--}}
                    </div>

                </div>


            </div>
    </section>

    <section class="banner-cercle " id="features">
        <div class="container">
            <div class="row ">
                <div class=" col-lg-8 col-md-10 col-10 m-auto p-0 text-start">
                    <h2  class="banner-header-text">Amplify Your Reach.
                        Expand Worldwide Operations.</h2>

                </div>
            </div>

            <div class="row">

                <div class="col-lg-6 col-md-6 col-10 mt-4 rounded-circle">
                    <img class="w-50 h-100 rounded-border rounded-circle" src="{{asset('Admin/assets/images/important_error.jpg')}}">
                    {{--                    <div class="img-banner">--}}

                    {{--                    </div>--}}
                </div>

                <div class="col-lg-6 col-md-6 col-10 m-auto py-3">
                    <h4 class="banner-text">Supercharge Your Shipping.
                        Grow Business Internationally.</h4>

                    <p>Say Goodbye to the days of physically knocking on courier service providers doorsteps to be provided
                        rates for a shipment. You are a few clicks away from attaining rates to ship out for over 200++ counties
                        and get options of multiple courier companies such as DHL, FEDEX, UPS, BAEI Express and many more.
                        Pick the service that meets your requirement and have the flexibility to schedule pick-ups from the
                        comfort location of your own business or home!</p>

                </div>

            </div>
        </div>
    </section>


    <section class=" banner-body ">
        <div class="container">
            <div class="row ">
                {{--                <div class=" col-lg-6 col-md-8 col-10 m-auto p-0">--}}
                {{--                    <input class="w-100 p-2 shadow " type="text" id="landingsearch"--}}
                {{--                           placeholder="Track Your Parcel Here"/>--}}
                {{--                </div>--}}
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-10 m-auto py-3">
                    <h1 class="banner-header-text">Unlatch Global Growth</h1>
                    {{-- <h4 class="banner-text">Grow Business Internationally</h4> --}}
                    <p>Boost your revenue, customer reach and portfolio. The Integration of our platform with leading
                        international couriers and Customs databases allows us to provide you with an all-inclusive rate which
                        calculates taxes, duties, prepares the proper documentation required for your commodity for a
                        seamless clearance of your goods and delivery.</p>
                    {{--                    <button class="button-primary mt-4">Get Started For Free</button>--}}
                </div>
                <div class="col-lg-6 col-md-6 col-10 mt-4">
                    <img class="w-100" src="{{asset('Landingpage/images/image 1.jpg')}}">
                    {{--                    <div class="img-banner">--}}

                    {{--                    </div>--}}
                </div>

            </div>


        </div>
    </section>


    <section class="banner-body ">
        <div class="container">
            {{-- <div class="row ">
                <div class=" col-lg-8 col-md-10 col-10 m-auto p-0 text-center">
                    <h1>Supercharge Your Shipping. Grow Business Internationally.</h1>
                </div>
            </div> --}}

            <div class="row">

                <div class="col-lg-6 col-md-6 col-10 mt-4">
                    <img class="w-75" src="{{asset('Landingpage/images/gorup 15.jpg')}}">
                    {{--                    <div class="img-banner">--}}

                    {{--                    </div>--}}
                </div>

                <div class="col-lg-6 col-md-6 col-10 m-auto py-3">
                    <h2 class="banner-header-text">Expand Storage Space
                        Without Requiring Actual Space.</h2>
                    {{-- <h4 class="banner-text">Grow Business Internationally</h4> --}}
                    <p>Make it even easier for your clients to ship their products to their respective doorstep around the globe.
                        Integration with your website will allows us to display all our shipping methods with which your client
                        can pick the service according to their preference.</p>

                </div>

            </div>
        </div>
    </section>



    <section class="banner-body ">
        <div class="container">
            <div class="row ">
                <div class=" col-lg-6 col-md-8 col-10 m-auto p-0">
                    {{--                    <input class="w-100 p-2 shadow " type="text" id="landingsearch"--}}
                    {{--                           placeholder="Track Your Parcel Here"/>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-10 m-auto py-3">
                    <h3 class="banner-header-text">Focus on your business.
                        Let us streamline you transportation!</h3>
                    {{-- <h4 class="banner-text">Grow Business Internationally</h4> --}}
                    <p>Our Platform is the one stop solution to automate all your shipping needs. Have the ability to compare
                        rates, generate labels, schedule pick-ups, integrate your own website or platform, monitor finances
                        through our platform.</p>
                    {{--                    <button class="button-primary mt-4">Get Started For Free</button>--}}
                </div>
                <div class="col-lg-6 col-md-6 col-10 mt-4">
                    <img class="w-75" src="{{asset('Landingpage/images/image 1.jpg')}}">
                    {{--                    <div class="img-banner">--}}

                    {{--                    </div>--}}
                </div>

            </div>


        </div>
    </section>

    <section class="banner-body ">
        <div class="container">
            <div class="row ">

                <div class="col-lg-6 col-md-6 col-10 mt-2 mx-auto  ">
                    <img class="w-75  " src="{{asset('Landingpage/images/image 3.jpg')}}" alt="image">
                </div>
                <div class="col-lg-6 col-md-6 col-10 ">
                    <h4 class="banner-header-text">Scale your business worldwide, leverage
                        using our network of warehouse worldwide</h4>
                    <p class="mb-3">Have the option to improve transit times, lower your shipping cost by utilizing our own and partnered
                        warehouses available across the globe. Our team will customize and tailor a fulfilment strategy which
                        will work flawlessly for your business. Please connect to our team members to learn more about both
                        our network, and fulfilment services.</a>
                    </p>
                    {{-- <p>
                        Easyship is seamlessly integrated with leading eCommerce platforms and marketplaces.
                        You can manage all your shipments without writing a single line of code.
                    </p> --}}
                </div>


            </div>


        </div>
    </section>

    <section class="banner-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-10 ">
                    <h4>Gratify Your Client</h4>
                    <p>Exceed client expectations with curated delivery experiences. Stay on top of your customers with branded tracking pages &
                        emails, and custom packing slips for a personal touch. Learn a way to emblem your shipping experience.
                    </p>
                </div>

                <div class="col-lg-6 col-md-6 col-10 mt-4 m-auto">
                    <img class="w-75" src=" {{asset('Landingpage/images/image 4.jpg')}} " alt="">
                </div>
            </div>
        </div>
    </section>

    {{-- <section class=" banner-body">

        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-md-6 col-10 mt-2 mx-auto  ">
                    <img class="w-75  " src="{{asset('Landingpage/images/image 3.jpg')}}" alt="image">
                </div>

                <div class="col-lg-6 col-md-6 col-10 ">
                    <p> Access Our Network of Global Warehouses
                        Improving transit times, lowering shipping costs, and reducing tariff exposure
                        has never been easier than with our global network of 3PL partners. Our shipping consultants
                        will tailor a
                        fulfillment strategy perfect for your business. Learn more about our fulfillment network.
                    </p>
                </div>
            </div>
        </div>

    </section> --}}

    {{-- <section class="banner-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-10 m-auto">
                    <p>
                        Delight Your CustomersExceed <br> your customer’s expectations with a curated delivery
                        experience.
                        Keep your customers informed with shipment tracking pages and emails that match your branding,
                        and customized packing slips for a personal touch.
                        Learn how to brand your delivery experience.
                    </p>
                </div>

                <div class="col-lg-6 col-md-6 col-10 mt-4 m-auto">
                    <img class="w-75" src=" {{asset('Landingpage/images/image 5.jpg')}} " alt="">
                </div>

            </div>
        </div>

    </section> --}}


    <section class="">
        <div class="container">
            <div class="row corner-banner-1  " style="">
                <div class="col-lg-6 col-md-6 col-10 m-auto banner-height position-relative  ">
                    <img class="corner-image-2" src=" {{asset('Landingpage/images/Rectangle 10.jpg')}} " alt="">
                </div>
                <div class="col-lg-6 col-md-6 col-10position-relative text-start   "style="min-height: 30rem">
                   <div class="position-absolute py-2 " style="bottom: 0px">
                    <h3>About Us</h3>

                    <p class="text-dark">

                        E-desh Limited, a concern of Express Group started to engage in complete logistics services and solutions for e-commerce and online business industry to play an integral part of the booming growth with all the business and industry potentials for the upcoming years and decades. Express Group board consists of highly experienced Management staffs in various international logistics services to and from Bangladesh around the globe. We value every customer and understand that each project requires a unique solution. This individual and tailored approach rewards us the opportunities to provide top quality customized logistics solutions, every time.

                        E-desh Limited is the first company in Bangladesh that has the experience, capabilities, functional expertise, technological embedment for integrated logistics solutions or One Umbrella Solutions to the e-commerce industry.
                    </p>
                   </div>

                    {{-- <p class="text-dark">
                        E-desh Limited is the first company in Bangladesh that has the experience, capabilities,
                        functional expertise,
                        technological embedment for integrated logistics solutions or One Umbrella Solutions to the
                        e-commerce industry.
                    </p> --}}

                </div>
            </div>

        </div>

    </section>



    <section class="banner-body">

        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-md-6 col-10 m-auto  ">
                    <img class="w-75" src=" {{asset('Landingpage/images/image 6.jpg')}} " alt="">
                </div>

                <div class="col-lg-6 col-md-6 col-10 m-auto ">
                    <h3>You’re In Good Hands!!</h3>
                    <P>
                        With our highly trained Customer service team, get the support your business needs 24/7. The logistics
                        industry never sleeps. After you schedule a shipment our team works around the clock to make the
                        shipment gets delivered on time every time!
                    </P>


                </div>

            </div>

        </div>

    </section>



    <section class=" ">
        <div class="container">
            <div class="row corner-banner-2  " style="">

                <div class="col-lg-6 col-md-6 col-10 m-auto">
                    <h3 class="banner-text">Begin Shipping Immediately
                    </h3>
                    <p class="text-dark mt-3">You can try us for free. Everyone loves free.</p>
                    <button class="button-primary mt-4">Get Started For Free</button>
                    <p class="text-dark mt-3">
                        Already at scale? Our shipping and logistics experts can build the perfect global logistics setup for your needs.
                    </p>
                </div>

                <div class="col-lg-6 col-md-6 col-10 banner-height positon-relative ">
                    <img class="corner-image-1" src=" {{asset('Landingpage/images/Rectangle 9.jpg')}} " alt="">
                </div>
            </div>

        </div>

    </section>

@endsection

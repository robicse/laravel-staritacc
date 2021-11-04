@extends('frontend.layouts.master')
@section('title', 'Home')
@push('css')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Satisfy&display=swap');
        .homeService{
            -webkit-box-shadow: 0px 0px 6px 0px rgba(130,130,130,1);
            -moz-box-shadow: 0px 0px 6px 0px rgba(130,130,130,1);
            box-shadow: 0px 0px 6px 0px rgba(130,130,130,0.20);border-radius: 10px;
            background: azure;
        }
        .fa_color{
            color: #ed4095;
        }
        .short_title{
            color: #ed4095;
        }
        .add-section{
            display: none;r
        }
        @media only screen and (max-width:479px) {
            .add-section {
                display: block;
            }
        }
        #multiple-datasets .league-name {
            margin: 0 20px 5px 20px;
            padding: 3px 0;
            border-bottom: 1px solid #ccc;
        }
        input[type="search"]::placeholder {
            /* Firefox, Chrome, Opera */
            /*text-align: center;*/
        }
        .custom-list-group-item {
            position: relative;
            display: block;
            padding: 4px;
            background-color: #fff;
            border: 0px solid rgba(0,0,0,.125);
            border-bottom: 1px solid rgba(0,0,0,.125);
            /*border-radius: 30px;*/
        }
        .custom-header {
            background-color: #fff;
            color:#ed4095;
            padding: 6px;
            font-weight: bold;
            border: 1px solid #ed4095;
            /*border-radius: 30px;*/
        }
        .search-results-dropdown{
            width: 340px;
        }
    </style>
@endpush
@section('content')

    <!-- Home Banner -->
    <section class="section section-search">
        <div class="container-fluid">
            <div class="row mb-3 add-section" style="margin-top: -30px">
                <div class="col-md-12 text-center">
                    <div class="add">
                        <div><img src = "{{asset('frontend/img/add/add1.jpg')}}" alt = ""></div>
                        <div><img src = "{{asset('frontend/img/add/add1.jpg')}}" alt = ""></div>
                        <div><img src = "{{asset('frontend/img/add/add1.jpg')}}" alt = ""></div>
                    </div>
                </div>
            </div>
            <div class="banner-wrapper">
                <div class="banner-header text-center">
                    <h1>Search Doctor, Make an Appointment</h1>
                    <p>Discover the best doctors, test, product and service.</p>
                </div>
                <!-- Search -->
                <div class="search-box">
                    {{--                        <div class="form-group search-location">--}}
                    {{--                            <input type="text" class="form-control" placeholder="Search Location">--}}
                    {{--                            <span class="form-text">Based on your Location</span>--}}
                    {{--                        </div>--}}
                    <div class="form-group search-info text-center">
                        <input id="searchMain" class="form-control" name="serviceName" type="search" placeholder="Search Doctors, Service, Test..." autocomplete="off">
                        {{--                            <input type="text" class="form-control" placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc">--}}
                        <span class="form-text">Ex : oxygen cylinder etc</span>
                    </div>
                    {{--                        <button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i> <span>Search</span></button>--}}
                </div>
                <!-- /Search -->
            </div>
        </div>
    </section>
    <!-- /Home Banner -->

    <section class="section home-tile-section pt-5">
        <div class="container-fluid pt-5">
            <div class="row">
                <div class="col-md-12 m-auto">
                    {{--                    <div class="section-header text-center">--}}
                    {{--                        <h2>What are you looking for?</h2>--}}
                    {{--                    </div>--}}
                    <div class="row">
                        {{--                        <div class="col-lg-3 mb-3">--}}
                        {{--                            <div class="card text-center doctor-book-card">--}}
                        {{--                                <img src="{{asset('frontend/img/doctors/doctor-07.jpg')}}" alt="" class="img-fluid">--}}
                        {{--                                <div class="doctor-book-card-content tile-card-content-1">--}}
                        {{--                                    <div>--}}
                        {{--                                        <h3 class="card-title mb-0">Visit a Clinic</h3>--}}
                        {{--                                        <a href="{{route('clinic')}}" class="btn book-btn1 px-3 py-2 mt-3" tabindex="0">Find Now</a>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('clinic')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-h-square fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    {{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
                                    <h5 class="card-title mb-0">Visit a Hospital</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('doctor')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-female fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">Find A Doctor</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.caregivers')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-user-md fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">Find A Caregiver</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.house-keeping')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-home fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">House Keeping</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.corporate-service')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-building fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    {{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
                                    <h5 class="card-title mb-0">Corporate Service</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.home-aplliance')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-bed fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">Home Aplliance</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.moving-and-shifting')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-truck fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">Moving and Shifting</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.car-rental')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-car fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">Car Rental</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.it-service')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-info fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">IT Service</h5>
                                </div>
                            </a>
                        </div>
                        <div  class="col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.category')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-server fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    {{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
                                    <h5 class="card-title mb-0">All Service</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Clinic and Specialities -->
    <section class="section section-specialities py-5">
        <div class="container-fluid">
            <div class="section-header text-center mb-5">
                <h2>Recommended</h2>
                {{--                <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
            </div>
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <!-- Slider -->
                    <div class="specialities-slider slider">
                    @if(!empty($all_services))
                        @foreach($all_services as $service)
                            @php
                                $service_sub_category_slug = \App\ServiceSubCategory::where('id',$service->service_sub_category_id)->pluck('slug')->first();
                            @endphp
                            <!-- Slider Item -->
                                <div class="speicality-item text-center">
                                    <a href="{{url('service-sub-category/'.$service_sub_category_slug)}}">
                                        <div class="speicality-img" >
                                            @if(!empty($service->image))
                                                <img src="{{asset('uploads/services/'.$service->image)}}" class="img-fluid" alt="Speciality" style="border-radius: 10px;">
                                            @else
                                                <img src="{{asset('uploads/services/default.jpg')}}" class="img-fluid" alt="Speciality" style="border-radius: 10px;">
                                            @endif
                                            {{--                                            <span><i class="fa fa-circle" aria-hidden="true"></i></span>--}}
                                        </div>
                                        <p>{{$service->name}}</p>
                                    </a>
                                </div>
                                <!-- /Slider Item -->
                            @endforeach
                        @endif
                    </div>
                    <!-- /Slider -->
                </div>
            </div>
        </div>
    </section>
    <!-- Clinic and Specialities -->

    <!-- Popular Section -->
    <section class="section section-doctor">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-header ">
                        <h4 class="short_title">Best In Market</h4>
                        <h2 class="mt-2">Book Our Service.. </h2>
                    </div>
                    <div class="about-content">
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.</p>
                        <p>web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes</p>
                        {{--                        <a href="javascript:;">Read More..</a>--}}
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="doctor-slider slider">
                    @if(!empty($hot_services))
                        @foreach($hot_services as $service)
                            <!-- Doctor Widget -->
                                <div class="profile-widget">
                                    <div class="doc-img">
                                        <a href="javascript:void(0);">
                                            @if(!empty($service->image))
                                                <img class="img-fluid" alt="User Image" src="{{asset('uploads/services/'.$service->image)}}">
                                            @else
                                                <img class="img-fluid" alt="User Image" src="{{asset('uploads/services/default.jpg')}}">
                                            @endif
                                        </a>
                                        <a href="javascript:void(0)" class="fav-btn">
                                            <i class="far fa-bookmark"></i>
                                        </a>
                                    </div>
                                    <div class="pro-content">
                                        <h3 class="title">
                                            <a href="javascript:void(0);">{{$service->name}}</a>
                                            <i class="fas fa-check-circle verified"></i>
                                        </h3>
                                        <ul class="available-info">
                                            <li>
                                                <i class="far fa-money-bill-alt"></i> Tk. {{$service->price}}
                                            </li>
                                        </ul>
                                        <div class="row row-sm">
                                            <div class="col-12">
                                                {{--                                                <a href="bookingjavascript:void(0);" class="btn book-btn">Book Now</a>--}}
                                                @php
                                                    $cart=Cart::content() ;
                                                    $ser_id=$service->id;
                                                    $item=$cart->search(function ($cartItem, $rowId) use ($ser_id) {
                                                        return $cartItem->id === $ser_id;
                                                    });
                                                @endphp
                                                @if(Cart::count()==0)
                                                    <div class="cartbtn_{{$service->id}} ">
                                                        <button id="{{$service->id}}" class="ttm-textcolor-white cart_button float-right" style="padding: 3px 15px; background-color: #fff;border: 2px solid #ED4095;border-radius: 4px;color: #1b1e21" title="CLick To Add Cart">Add +</button>
                                                    </div>
                                                @elseif($item==false)
                                                    <div class="cartbtn_{{$service->id}}">
                                                        <button id="{{$service->id}}" class=" ttm-textcolor-white cart_button" style="padding: 6px 14px; background-color: #fff;border: 2px solid #0d71d5;border-radius: 10px;color: #1b1e21" title="CLick To Add Cart">Add +</button>
                                                    </div>
                                                @else
                                                    <h6 class="">Added</h6>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Doctor Widget -->
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Popular Section -->
    <!-- Why Choose Us -->
    <section class="section section-features">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="section-header">
                        <h4 class="short_title">Why Choose Us</h4>
                        <h2 class="mt-2">Because we care about your safety.. </h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-3 text-center" style="">
                            <div class="py-4 ">
                                <i class="fa fa-h-square fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                {{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
                                <h5 class="card-title mb-0">Prevent Care Guarantee</h5>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3 text-center" style="">
                            <div class="py-4 ">
                                <i class="fas fa-heart fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                {{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
                                <h5 class="card-title mb-0">Prevent Care Safe And Secure</h5>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3 text-center" style="">
                            <div class="py-4 ">
                                <i class="fas fa-allergies fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                {{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
                                <h5 class="card-title mb-0">24/7 Support</h5>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3 text-center" style="">
                            <div class="py-4 ">
                                <i class="fab fa-accessible-icon fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                {{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
                                <h5 class="card-title mb-0">Secure Payment Gateway</h5>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3 text-center" style="">
                            <div class="py-4 ">
                                <i class="fab fa-amazon-pay fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                {{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
                                <h5 class="card-title mb-0">Latest Price Guarantee</h5>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3 text-center" style="">
                            <div class="py-4 ">
                                <i class="fab fa-android fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                {{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
                                <h5 class="card-title mb-0">Ensuring Masks, Sanitizing, Hands And Globs</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 features-img">
                    <img src="{{asset('frontend/img/features/safety.jpg')}}" class="img-fluid" alt="Feature">
                </div>
            </div>
        </div>
    </section>
    <!-- /Why Choose Us -->

    <!-- How it works -->
    <section class="section section-doctor">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header">
                        <h4 class="short_title">How it works</h4>
                        <h2 class="mt-2">Easiest way to get a service... </h2>
                    </div>
                </div>
                <div class="col-md-6 features-img">
                    <iframe width="570" height="320" src="https://www.youtube.com/embed/rDYdeq3JW_E" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 10px"></iframe>
                </div>
                <div class="col-md-6 px-5">
                    <div class="row">
                        <div class="col-lg-12 mb-5" >
                            <div class="row">
                                <div class="col-md-1 mt-1">
                                    <h1 class="font-weight-bold short_title">1.</h1>
                                </div>
                                <div class="col-md-11">
                                    <h3>Select the Service</h3>
                                    <h6>Pick the service you are looking for- from the website or the app.</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-5" style="">
                            <div class="row">
                                <div class="col-md-1 mt-3">
                                    <h1 class="font-weight-bold short_title">2.</h1>
                                </div>
                                <div class="col-md-11">
                                    <h3>Pick your schedule</h3>
                                    <h6>Pick your convenient date and time to avail the service. Pick the service provider based on their rating.</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-5" style="">
                            <div class="row">
                                <div class="col-md-1 mt-3">
                                    <h1 class="font-weight-bold short_title">3.</h1>
                                </div>
                                <div class="col-md-11">
                                    <h3>Place Your Order & Relax </h3>
                                    <h6>Review and place the order. Now just sit back and relax. We’ll assign the expert service provider’s schedule for you. </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /How it works -->


    <!-- Availabe Features -->
    <section class="section section-features">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 features-img">
                    <img src="{{asset('frontend/img/features/category.jpg')}}" class="img-fluid" alt="Feature">
                </div>
                <div class="col-md-7">
                    <div class="section-header">
                        <h4 class="mt-2 short_title">Service Category</h4>
                        <h2 >Availabe Category in Our Services</h2>
                    </div>
                    <div class="features-slider slider">
                    @if(!empty($all_service_categories))
                        @foreach($all_service_categories as $all_service_category)
                            <!-- Slider Item -->
                                <div class="feature-item text-center">
                                    <a href="{{url('service-category/'.$all_service_category->slug)}}">
                                        @if($all_service_category->icon)
                                            <img src="{{asset('uploads/service-category/icon/'.$all_service_category->icon)}}" class="img-fluid" alt="Feature">
                                        @else
                                            <img src="{{asset('uploads/service-category/icon/default.png')}}" class="img-fluid" alt="Feature">
                                        @endif
                                        <p>{{$all_service_category->name}}</p>
                                    </a>
                                </div>
                                <!-- /Slider Item -->
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Availabe Features -->

    <!-- How it works -->
    <section class="section section-doctor">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header">
                        <h4 class="short_title">SOME HAPPY FACES</h4>
                        <h2 class="mt-2">Real Happy Customers, Real Stories... </h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="review">
                        <div><div class="row">
                                <div class="col-md-6">
                                    <div class="row p-5" >
                                        <div class="col-md-12">
                                            <p style="font-size: 25px;font-family: 'Satisfy', cursive;">
                                                Prevent Care services are very helpful for working women like me. They were on time as per the schedule to provide the service, and I’m very satisfied with their quality of service.
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <h4 class="float-right">-Ayesha Akhter</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <p class="float-right">IT Head</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 features-img text-center">
                                    <iframe width="560" height="310" src="https://www.youtube.com/embed/rDYdeq3JW_E" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 10px"></iframe>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row p-5" >
                                        <div class="col-md-12">
                                            <p style="font-size: 25px;font-family: 'Satisfy', cursive;">
                                                Prevent Care services are very helpful for working women like me. They were on time as per the schedule to provide the service, and I’m very satisfied with their quality of service.
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <h4 class="float-right">-Ayesha Akhter</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <p class="float-right">IT Head</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 features-img text-center">
                                    <iframe width="560" height="310" src="https://www.youtube.com/embed/rDYdeq3JW_E" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 10px"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /How it works -->

    <!-- app Download -->
    <section class="section section-features">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 features-img text-center">
                    <img src="{{asset('frontend/img/app-download.jpg')}}" class="img-fluid" alt="Feature" width="370px">
                </div>
                <div class="col-md-7 mt-5">
                    <div class="mb-4">
                        <h4 class="short_title">Download Our App</h4>
                        <h2 class="mt-2">Any Service, Any Time, Anywhere... </h2>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <a href = "#"><img src = "{{asset('frontend/img/play-store.png')}}" alt = "" width="200px"></a>
                        </div>
                        <div class="col-md-4">
                            <a href = "#"><img src = "{{asset('frontend/img/app-store.png')}}" alt = "" width="200px"></a>
                        </div>
                        <div class="col-lg-12 mt-5" style="">
                            <h2>Like Us on Facebook</h2>
                            <a style="font-size: 18px" href = "#">Prevent Care</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /app Download -->

    <!-- Blog Section -->
    <section class="section section-blogs">
        <div class="container-fluid">

            <!-- Section Header -->
            <div class="section-header text-center">
                <h2>Health Tips</h2>
                <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <!-- /Section Header -->


            <div class="row blog-grid-row">


                @foreach($all_health_tips as $health)
                    <div class="col-md-3 col-lg-3 col-sm-12">
                        <div class="blog grid-blog">
                            <div class="blog-image">
                                <a href="javascript:void(0);"><img class="img-fluid" src="{{asset('frontend/img/blog/blog-02.jpg')}}" alt="Post Image"></a>
                            </div>
                            <div class="blog-content">
                                <ul class="entry-meta meta-item">
                                    <li>
                                        <div class="post-author">
                                            <a href="javascript:void(0);"><img src="{{asset('frontend/img/doctors/doctor-thumb-02.jpg')}}" alt="Post Author"> <span>Dr. Darren Elder</span></a>
                                        </div>
                                    </li>
                                    <li><i class="far fa-clock"></i> 3 Dec 2019</li>
                                </ul>
                                <h3 class="blog-title"><a href="javascript:void(0);">What are the benefits of Online Doctor Booking?</a></h3>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                            </div>
                        </div>
                        <!-- Blog Post -->
                        <div class="blog grid-blog">
                            <div class="blog-image">
                                <a href="javascript:void(0);"><img class="img-fluid" src="{{asset('uploads/health-tips/'.$health->image)}}" alt="{{$health->image_alt}}"></a>
                            </div>
                            @php
                                $dc=\App\User::find($health->doctor_id);
                            @endphp
                            <div class="blog-content">
                                <ul class="entry-meta meta-item">
                                    <li>
                                        <div class="post-author">
                                            <a href="javascript:void(0);"><img src="{{asset('uploads/profile_pic/doctor/'.$dc->image)}}" alt="Post Author"> <span>{{ $dc->name }}</span></a>
                                        </div>
                                    </li>
                                    <li><i class="far fa-clock"></i>{{date('jS F, Y',strtotime($health->created_at))}}</li>
                                </ul>
                                {{--                            <div></div>--}}
                                <h3 class="blog-title"><a href="{{route('health_tips.details',$health->slug)}}">{{ $health->title }}</a></h3>
                                <div class="desc">
                                    {!! Str::limit($health->contents,40) !!}
                                </div>
                            </div>
                        </div>
                        <!-- /Blog Post -->
                    </div>
                @endforeach
                {{--                                <div class="col-md-6 col-lg-3 col-sm-12">--}}

                {{--                                    <!-- Blog Post -->--}}
                {{--                                    <div class="blog grid-blog">--}}
                {{--                                        <div class="blog-image">--}}
                {{--                                            <a href="javascript:void(0);"><img class="img-fluid" src="{{asset('frontend/img/blog/blog-02.jpg')}}" alt="Post Image"></a>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="blog-content">--}}
                {{--                                            <ul class="entry-meta meta-item">--}}
                {{--                                                <li>--}}
                {{--                                                    <div class="post-author">--}}
                {{--                                                        <a href="javascript:void(0);"><img src="{{asset('frontend/img/doctors/doctor-thumb-02.jpg')}}" alt="Post Author"> <span>Dr. Darren Elder</span></a>--}}
                {{--                                                    </div>--}}
                {{--                                                </li>--}}
                {{--                                                <li><i class="far fa-clock"></i> 3 Dec 2019</li>--}}
                {{--                                            </ul>--}}
                {{--                                            <h3 class="blog-title"><a href="javascript:void(0);">What are the benefits of Online Doctor Booking?</a></h3>--}}
                {{--                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <!-- /Blog Post -->--}}

                {{--                                </div>--}}
                {{--                                <div class="col-md-6 col-lg-3 col-sm-12">--}}

                {{--                                    <!-- Blog Post -->--}}
                {{--                                    <div class="blog grid-blog">--}}
                {{--                                        <div class="blog-image">--}}
                {{--                                            <a href="javascript:void(0);"><img class="img-fluid" src="{{asset('frontend/img/blog/blog-03.jpg')}}" alt="Post Image"></a>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="blog-content">--}}
                {{--                                            <ul class="entry-meta meta-item">--}}
                {{--                                                <li>--}}
                {{--                                                    <div class="post-author">--}}
                {{--                                                        <a href="javascript:void(0);"><img src="{{asset('frontend/img/doctors/doctor-thumb-03.jpg')}}" alt="Post Author"> <span>Dr. Deborah Angel</span></a>--}}
                {{--                                                    </div>--}}
                {{--                                                </li>--}}
                {{--                                                <li><i class="far fa-clock"></i> 3 Dec 2019</li>--}}
                {{--                                            </ul>--}}
                {{--                                            <h3 class="blog-title"><a href="javascript:void(0);">Benefits of consulting with an Online Doctor</a></h3>--}}
                {{--                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <!-- /Blog Post -->--}}

                {{--                                </div>--}}
                {{--                                <div class="col-md-6 col-lg-3 col-sm-12">--}}

                {{--                                    <!-- Blog Post -->--}}
                {{--                                    <div class="blog grid-blog">--}}
                {{--                                        <div class="blog-image">--}}
                {{--                                            <a href="javascript:void(0);"><img class="img-fluid" src="{{asset('frontend/img/blog/blog-04.jpg')}}" alt="Post Image"></a>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="blog-content">--}}
                {{--                                            <ul class="entry-meta meta-item">--}}
                {{--                                                <li>--}}
                {{--                                                    <div class="post-author">--}}
                {{--                                                        <a href="javascript:void(0);"><img src="{{asset('frontend/img/doctors/doctor-thumb-04.jpg')}}" alt="Post Author"> <span>Dr. Sofia Brient</span></a>--}}
                {{--                                                    </div>--}}
                {{--                                                </li>--}}
                {{--                                                <li><i class="far fa-clock"></i> 2 Dec 2019</li>--}}
                {{--                                            </ul>--}}
                {{--                                            <h3 class="blog-title"><a href="javascript:void(0);">5 Great reasons to use an Online Doctor</a></h3>--}}
                {{--                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <!-- /Blog Post -->--}}
                {{--                                </div>--}}
            </div>
            <div class="view-all text-center">
                <a href="{{route('health.tips.list')}}" class="btn btn-primary">View All</a>
            </div>
        </div>
    </section>
    <!-- /Blog Section -->
@stop
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script !src = "">
        jQuery(document).ready(function($) {
            var product = new Bloodhound({
                remote: {
                    url: '/search/product?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('serviceName'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });
            var doctor = new Bloodhound({
                remote: {
                    url: '/search/doctor?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('serviceName'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });
            var test = new Bloodhound({
                remote: {
                    url: '/search/test?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('serviceName'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $("#searchMain").typeahead({
                hint: true,
                highlight: true,
                minLength: 3
            }, {
                source: doctor.ttAdapter(),
                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'serviceList',
                display: 'name',
                // the key from the array we want to display (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Sorry,We could not find any Doctor.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown"> <div class="list-group-item custom-header">Doctor</div>'
                    ],
                    suggestion: function (data) {
                        return '<a href="doctor-details/'+data.slug+'" class="list-group-item custom-list-group-item">'+data.name+'</a>'
                    }
                }
            },{
                source: product.ttAdapter(),
                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'serviceList',
                display: 'name',
                // the key from the array we want to display (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Sorry,We could not find any Product.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item custom-header">Product</div>'
                    ],
                    suggestion: function (data) {
                        return '<a href="product/'+data.slug+'" class="list-group-item custom-list-group-item">'+data.name+'</a>'
                    }
                }
            },{
                source: test.ttAdapter(),
                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'serviceList',
                display: 'name',
                // the key from the array we want to display (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Sorry,We could not find any Lab Test.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item custom-header">Lab Test</div>'
                    ],
                    suggestion: function (data) {
                        return '<a href="test/lab/'+data.slug+'" class="list-group-item custom-list-group-item">'+data.name+'</a>'
                    }
                }
            });
        });
    </script>
    <script !src = "">
        $(document).ready(function(){
            $(".cart_button").click(function (e) {
                e.preventDefault();
                console.log(this.id);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('service.cart.add')}}',
                    method: 'post',
                    data: {
                        service_id:this.id,
                        type:"service",
                        _token: '{{csrf_token()}}',
                    },
                    success: function(data){
                        console.log(data);
                        if(data.check_service_category_type == false){
                            toastr.warning('Service not added in your cart, you did not added different category in same invoice <span style="font-size: 15px;">&#10084;&#65039;</span>');
                        }else{
                            toastr.success('Service added in your cart <span style="font-size: 15px;">&#10084;&#65039;</span>');
                            $('#number-cart').html(data.response['countCart']);
                            $('.cartbtn_'+data.response['id']).html('<h6>Added</h6>');
                            $('.service-details-cart').append(`<tr class="cart_item border-0">
                                                        <td class="product-name py-2 border-0">
                                                            <p style="font-size: 15px;color: #0c0c0c" class="mb-1">`+data.response['options'].service_sub_category_name+`</p>
                                                            `+data.response['name']+`
                                                            <strong class="product-quantity">× `+data.response['qty']+`</strong>
                                                        </td>
                                                        <td class="product-total border-0">
                                                                    <span class="Price-amount">
                                                                        <span class="Price-currencySymbol">৳</span>`+data.response['price']+`
                                                                    </span>
                                                        </td>
                                                    </tr>`);
                            $('.service-empty-cart').empty();
                        }

                    }
                });
            });

            $('.add').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });
            $('.review').slick();
        });
    </script>
@endpush

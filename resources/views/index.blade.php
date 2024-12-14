@extends('layouts.app')

@section('content')

@if(isset($banners) && count($banners) > 0)
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 wow fadeIn clearfix" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($banners as $key => $banner)
                    <div class="carousel-item @if($key == 0) active @endif">
                        <img class="w-100 d-none d-lg-block" src="{{ URL::asset('img/'.$banner->image) }}">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-start">
                                    <div class="col-lg-6">
                                        @if(!empty($banner->title))
                                        <p class="d-inline-block border border-warning rounded text-primary fw-semi-bold py-1 px-3 animated slideInDown"> {{$banner->title}}</p>
                                        @endif
                                        
                                        @if(!empty($banner->subtitle))
                                        <h1 class="display-1 mb-4 animated slideInDown">{{$banner->subtitle}}</h1>
                                        @endif

                                        @if(!empty($banner->desc))
                                        <p style="color: #555555;">{{$banner->desc}}</p>
                                        <!--<a href="" class="btn btn-primary py-3 px-5 animated slideInDown">Explore More</a>-->
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->
@endif


@if(isset($page[1]) || isset($page[2]) || isset($page[3]))
    <!-- About Start -->
    <div class="container-xxl py-5" id="about">
        <div class="container">
            <div class="row g-4 align-items-end mb-4">
                @if(isset($page[1]) && !empty($page[1]->image))
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid rounded" src="{{asset('img/'.$page[1]->image)}}">
                </div>
                @endif
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">About Us</p>
                    <h1 class="display-6 mb-4">Transforming Africa's Agrifood Sector</h1>
                    <p class="mb-4">
                        @if(isset($page[1]))
                            @php echo $page[1]->content; @endphp
                        @endif
                    </p>
                    <div class="border rounded p-4">
                        <nav>
                            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                <button class="nav-link fw-semi-bold active" id="nav-mission-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-mission" type="button" role="tab" aria-controls="nav-mission"
                                    aria-selected="false">Mission</button>
                                <button class="nav-link fw-semi-bold" id="nav-vision-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-vision" type="button" role="tab" aria-controls="nav-vision"
                                    aria-selected="false">Vision</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-mission" role="tabpanel"
                                aria-labelledby="nav-mission-tab">
                                @if(isset($page[2]))
                                    @php echo $page[2]->content; @endphp
                                @endif
                            </div>
                            <div class="tab-pane fade" id="nav-vision" role="tabpanel" aria-labelledby="nav-vision-tab">
                                @if(isset($page[3]))
                                    @php echo $page[3]->content; @endphp
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border rounded p-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row g-4">
                    <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                        <div class="h-100">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                    <i class="fa fa-users text-white"></i>
                                </div>
                                @if(isset($page[4]))
                                <div class="ps-3">
                                    <h4 class="text-success">@php echo $page[4]->name; @endphp</h4>
                                    <span>@php echo $page[4]->content; @endphp</span>
                                </div>
                                @endif
                                <div class="border-end d-none d-lg-block"></div>
                            </div>
                            <div class="border-bottom mt-4 d-block d-lg-none"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                        <div class="h-100">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                    <i class="fa fa-bolt text-white"></i>
                                </div>
                                @if(isset($page[5]))
                                <div class="ps-3">
                                    <h4 class="text-success">@php echo $page[5]->name; @endphp</h4>
                                    <span>@php echo $page[5]->content; @endphp</span>
                                </div>
                                @endif

                                <div class="border-end d-none d-lg-block"></div>
                            </div>
                            <div class="border-bottom mt-4 d-block d-lg-none"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                        <div class="h-100">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                    <i class="fa fa-certificate text-white"></i>
                                </div>
                                @if(isset($page[6]))
                                <div class="ps-3">
                                    <h4 class="text-success">@php echo $page[6]->name; @endphp</h4>
                                    <span>@php echo $page[6]->content; @endphp</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endif


    <!-- Facts Start -->
    <!--
    <div class="container-fluid facts my-5 py-5" id="about" style="background: #BF8328 !important;">
        <div class="container py-5">
            <h1 class="display-5 mb-4 text-white text-center mb-5">Our Impact In Numbers</h1>
            <div class="row g-5 mt-5">
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <i class="fa fa-users fa-3x text-white mb-3"></i>
                    <h1 class="display-4 text-white" data-toggle="counter-up">200</h1>
                    <span class="fs-5 text-white">Happy Clients</span>
                    <hr class="bg-white w-25 mx-auto mb-0">
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <i class="fa fa-users-cog fa-3x text-white mb-3"></i>
                    <h1 class="display-4 text-white" data-toggle="counter-up">125</h1>
                    <span class="fs-5 text-white">Smallholder Farmers Onboarded</span>
                    <hr class="bg-white w-25 mx-auto mb-0">
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <i class="fa fa-shopping-bag fa-3x text-white mb-3"></i>
                    <h1 class="display-4 text-white" data-toggle="counter-up">90000</h1>
                    <span class="fs-5 text-white">Metric Tonnes of Tomato PHLs Prevented</span>
                    <hr class="bg-white w-25 mx-auto mb-0">
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <i class="fa fa-award fa-3x text-white mb-3"></i>
                    <h1 class="display-4 text-white" data-toggle="counter-up">500</h1>
                    <span class="fs-5 text-white">Household served</span>
                    <hr class="bg-white w-25 mx-auto mb-0">
                </div>
            </div>
        </div>
    </div>
    -->
    <!-- Facts End -->


@if(isset($services) && count($services) > 0)
    <!-- Service Start -->
    <div class="container-xxl service py-5" id="service">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Our Services</p>
                <h1 class="display-6 mb-5">We Achieve Extraordinary Results Through</h1>
            </div>
            <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s" style="margin-bottom:120px;">
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="nav nav-pills d-flex justify-content-between w-100 h-100 me-4">
                        @foreach($services as $key=>$service)
                        <button class="nav-link w-100 d-flex align-items-center text-start border p-2 mb-4 @if($key == 0) active @endif"
                            data-bs-toggle="pill" data-bs-target="#tab-pane-{{$key}}" type="button">
                            <h5 class="m-0">
                                <div class="row">
                                    <div class="col-md-1 col-xs-2 col-sm-2 col-xl-2">
                                        <i class="fa fa-bars text-primary"></i>
                                    </div>
                                    <div class="col-md-11 col-xs-10 col-sm-10 col-xl-10">
                                        {{$service->title}}
                                    </div>
                                </div>
                            </h5>
                        </button>
                        @endforeach                        
                    </div>
                </div>
                <div class="col-lg-8 d-none d-lg-block">
                    <div class="tab-content w-100">

                        @foreach($services as $keyz=>$servicez)
                        <div class="tab-pane fade show @if($keyz == 0) active @endif" id="tab-pane-{{$keyz}}">
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <h3 class="mb-4" style="color: #BF8328;">{{$servicez->subtitle}}</h3>
                                    <p class="mb-4">@php echo $servicez->content; @endphp</p>

                                    @php $scontents = App\Http\Controllers\AdministratorController::getServicecontents($servicez->id); @endphp

                                    @if(isset($scontents) && count($scontents) > 0)
                                        @foreach($scontents as $scontent)
                                            <p><i class="fa fa-check text-primary me-3"></i> {{$scontent->content}}</p>
                                        @endforeach
                                    @endif
                                    <!--<a href="index.html" class="btn btn-primary py-3 px-5 mt-3">Read More</a>-->
                                </div>
                            </div>
                        </div>
                        @endforeach

                        
                    </div>
                </div>

            </div>

            <!--Mobile view services comes here-->
            <div class="d-block d-lg-none">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($services as $key=>$service)
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading{{$key}}">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}"  @if($key == 0) aria-expanded="true" @else aria-expanded="false" @endif aria-controls="collapse{{$key}}">
                                        {{$service->title}}
                                    </a>
                                </h4>
                            </div>
                        </div>
                        <div id="collapse{{$key}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$key}}">
                            <div class="panel-body">
                                <h3 class="mb-4" style="color: #BF8328; font-size: calc(1.0rem + .6vw);">{{$service->subtitle}}</h3>
                                <p class="mb-4">@php echo $service->content; @endphp</p>

                                @php $scontents = App\Http\Controllers\AdministratorController::getServicecontents($service->id); @endphp

                                @if(isset($scontents) && count($scontents) > 0)
                                    @foreach($scontents as $scontent)
                                        <p><i class="fa fa-check text-primary me-3"></i> {{$scontent->content}}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
            
            <hr>
        </div>
        
    </div>
    <!-- Service End -->
@endif

    <!-- Callback Start -->
    <!--
    <div class="container-fluid callback my-5 pt-5">
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="bg-white border rounded p-4 p-sm-5 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                            <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Get In Touch
                            </p>
                            <h1 class="display-5 mb-5">Request A Call-Back</h1>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="mail" placeholder="Your Email">
                                    <label for="mail">Your Email</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="mobile" placeholder="Your Mobile">
                                    <label for="mobile">Your Mobile</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message"
                                        style="height: 100px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-100 py-3" type="submit">Submit Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
    <!-- Callback End -->


    <!-- Projects Start -->
    <!--
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Our Projects</p>
                <h1 class="display-5 mb-5">We Have Completed Latest Projects</h1>
            </div>
            <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.3s">
                <div class="project-item pe-5 pb-5">
                    <div class="project-img mb-3">
                        <img class="img-fluid rounded" src="img/service-1.jpg" alt="">
                        <a href="index.html"><i class="fa fa-link fa-3x text-primary"></i></a>
                    </div>
                    <div class="project-title">
                        <h4 class="mb-0">Financial Planning</h4>
                    </div>
                </div>
                <div class="project-item pe-5 pb-5">
                    <div class="project-img mb-3">
                        <img class="img-fluid rounded" src="img/service-2.jpg" alt="">
                        <a href="index.html"><i class="fa fa-link fa-3x text-primary"></i></a>
                    </div>
                    <div class="project-title">
                        <h4 class="mb-0">Cash Investment</h4>
                    </div>
                </div>
                <div class="project-item pe-5 pb-5">
                    <div class="project-img mb-3">
                        <img class="img-fluid rounded" src="img/service-3.jpg" alt="">
                        <a href="index.html"><i class="fa fa-link fa-3x text-primary"></i></a>
                    </div>
                    <div class="project-title">
                        <h4 class="mb-0">Financial Consultancy</h4>
                    </div>
                </div>
                <div class="project-item pe-5 pb-5">
                    <div class="project-img mb-3">
                        <img class="img-fluid rounded" src="img/service-4.jpg" alt="">
                        <a href="index.html"><i class="fa fa-link fa-3x text-primary"></i></a>
                    </div>
                    <div class="project-title">
                        <h4 class="mb-0">Business Loans</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
    <!-- Projects End -->


@if(isset($teams) && !empty($teams))
    <!-- Team Start -->
    <div class="container-xxl py-5" id="team">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Our People & Leadership</p>
                <h6 class=" mb-5">We possess expertise in agrifood systems, food policy, sustainable agriculture, international development, and management consulting. Our team's extensive experience spans diverse regions across Africa.</h6>
            </div>
            <div class="row g-4">
                <div class="border rounded p-4 d-none d-lg-block">
                        <nav>
                            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">

                                @foreach($teams as $key=>$team)
                                <button class="nav-link fw-semi-bold @if($key == 0) active @endif" id="nav-{{$key}}-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-{{$key}}" type="button" role="tab" aria-controls="nav-{{$key}}"
                                    aria-selected="false">{{$team->name}}</button>
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">

                            @foreach($teams as $keyz=>$teamz)
                                <div class="tab-pane fade show @if($keyz == 0) active @endif" id="nav-{{$keyz}}" role="tabpanel"
                                    aria-labelledby="nav-{{$keyz}}-tab">
                                    
                                    <div class="row g-4">
                                        <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                            <div class="team-item">
                                                @if(empty($teamz->image))
                                                    <img class="img-fluid rounded" src="{{asset('img/teams/team.png')}}" alt="">
                                                @else
                                                    <img class="img-fluid rounded" src="{{ URL::asset('img/teams'.$teamz->image) }}">
                                                @endif
                                                <div class="team-text">
                                                    <h4 class="mb-5"> {{$teamz->name}}</h4>
                                                    <div class="team-social d-flex">
                                                        @if(!empty($teamz->fb))
                                                            <a class="btn btn-square rounded-circle mx-1" href="{{$teamz->fb}}"><i
                                                                    class="fab fa-facebook-f"></i></a>
                                                        @endif

                                                        @if(!empty($teamz->tw))
                                                            <a class="btn btn-square rounded-circle mx-1" href="{{$teamz->tw}}"><i class="fab fa-twitter"></i></a>
                                                        @endif

                                                        @if(!empty($teamz->ln))
                                                            <a class="btn btn-square rounded-circle mx-1" href="{{$teamz->ln}}"><i
                                                                    class="fab fa-instagram"></i></a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 wow fadeInUp" style="text-align:justify">
                                            <h3  class="mt-5" style="color: #BF8328;">{{$teamz->designation}}</h3>
                                            <p class="mb-4 mt-5">@php echo $teamz->content; @endphp</p>
                                            
                                        </div>
                                    </div>
                            
                            
                                </div>
                            @endforeach


                            
                        </div>
                </div>

                <!--Mobile view teams comes here-->
                <div class="border rounded p-4  d-block d-lg-none">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($teams as $keyz=>$teamz)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading{{$keyz}}">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$keyz}}"  @if($keyz == 0 ) aria-expanded="true" @else aria-expanded="false" @endif aria-controls="collapse{{$keyz}}">
                                            {{$teamz->name}}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                            <div id="collapse{{$keyz}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$keyz}}">
                                <div class="panel-body">
                                    <div class="row g-4">
                                        <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                            <div class="team-item">
                                                @if(empty($teamz->image))
                                                    <img class="img-fluid rounded" src="{{asset('img/teams/team.png')}}" alt="">
                                                @else
                                                    <img class="img-fluid rounded" src="{{ URL::asset('img/teams'.$teamz->image) }}">
                                                @endif
                                                <div class="team-text">
                                                    <h4 class="mb-5" style="font-size: calc(0.915rem + .3vw);"> {{$teamz->name}}</h4>
                                                    <div class="team-social d-flex">
                                                        @if(!empty($teamz->fb))
                                                            <a class="btn btn-square rounded-circle mx-1" style="width:28px; height: 28px;" href="{{$teamz->fb}}"><i
                                                                    class="fab fa-facebook-f"></i></a>
                                                        @endif

                                                        @if(!empty($teamz->tw))
                                                            <a class="btn btn-square rounded-circle mx-1" style="width:28px; height: 28px;" href="{{$teamz->tw}}"><i class="fab fa-twitter"></i></a>
                                                        @endif

                                                        @if(!empty($teamz->ln))
                                                            <a class="btn btn-square rounded-circle mx-1" style="width:28px; height: 28px;" href="{{$teamz->ln}}"><i
                                                                    class="fab fa-instagram"></i></a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 wow fadeInUp" style="text-align:left">
                                            <h3  class="mt-2" style="color: #BF8328; font-size: calc(1.0rem + .6vw);">{{$teamz->designation}}</h3>
                                            <p class="mb-4 mt-2">@php echo $teamz->content; @endphp</p>
                                            
                                        </div>
                                    </div>
                            
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            


                

                <!--<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <img class="img-fluid rounded" src="img/team-1.jpg" alt="">
                        <div class="team-text">
                            <h4 class="mb-5">John B. Babadara (Cofounder/Chair)</h4>
                            <div class="team-social d-flex">
                                <a class="btn btn-square rounded-circle mx-1" href="index.html"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square rounded-circle mx-1" href="index.html"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square rounded-circle mx-1" href="index.html"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>-->
                
            </div>
        </div>
    </div>
    <!-- Team End -->
@endif

    <!-- Testimonial Start -->
    <!--
    <div class="container-xxl py-5" id="testimonial">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Testimonial</p>
                <h1 class="display-5 mb-5">What Our Clients Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.3s">
                <div class="testimonial-item">
                    <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                        <div class="btn-square bg-white border rounded-circle">
                            <i class="fa fa-quote-right fa-2x text-primary"></i>
                        </div>
                        testimonal 1
                    </div>
                    <img class="rounded-circle mb-3" src="img/team.png" alt="">
                    <h4>Client Name</h4>
                    <span>Profession</span>
                </div>
                <div class="testimonial-item">
                    <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                        <div class="btn-square bg-white border rounded-circle">
                            <i class="fa fa-quote-right fa-2x text-primary"></i>
                        </div>
                        Testimonial 2
                    </div>
                    <img class="rounded-circle mb-3" src="img/team.png" alt="">
                    <h4>Client Name</h4>
                    <span>Profession</span>
                </div>
                <div class="testimonial-item">
                    <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                        <div class="btn-square bg-white border rounded-circle">
                            <i class="fa fa-quote-right fa-2x text-primary"></i>
                        </div>
                        Testimonial 3
                    </div>
                    <img class="rounded-circle mb-3" src="img/team.png" alt="">
                    <h4>Client Name</h4>
                    <span>Profession</span>
                </div>
                <div class="testimonial-item">
                    <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                        <div class="btn-square bg-white border rounded-circle">
                            <i class="fa fa-quote-right fa-2x text-primary"></i>
                        </div>
                        Testimonial 4
                    </div>
                    <img class="rounded-circle mb-3" src="img/team.png" alt="">
                    <h4>Client Name</h4>
                    <span>Profession</span>
                </div>
            </div>
        </div>
    </div>
    -->
    <!-- Testimonial End -->




@endsection
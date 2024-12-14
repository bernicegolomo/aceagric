@extends('layouts.app')

@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s" style="background: url(img/gallery.png) top left no-repeat;">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">Carrers</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Carrers</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <section id="sectionJobList" class="section section-job-list gradient-light--lean-left" style="background: #fcfdff;">
        <div class="container">

            <div class="row row-grid justify-content-center">

                <div class="col-md-8 col-lg-7 col-xl-6 text-center">
                    <h2 class="section__title mb-4">Jobs Openings at AceAgric</h2>

                    <p>We’re always searching for amazing people to join our team. Take a look at our current openings.</p>

                </div>

                @if(isset($careers) && count($careers) > 0)
                    <div class="col-md-10 mt-5">
                        <div class="job-list__wrapper mb-6">

                            @foreach($careers as $career)
                            <a href="" class="card p-0 mb-3 border-0 shadow-sm shadow--on-hover" style="color:#101f41 !important">
                                <div class="card-body">
                                    <span class="row justify-content-between align-items-center">
                                        <span class="col-md-5 color--heading">
                                            <span class="badge badge-circle background--danger text-white mr-3">--</span> {{$career->title}}
                                        </span>

                                        <span class="col-5 col-md-3 my-3 my-sm-0 color--text">
                                            <i class="fas fa-clock mr-1"></i> {{$career->type}}
                                        </span>

                                        <span class="col-7 col-md-3 my-3 my-sm-0 color--text">
                                            <i class="fas fa-map-marker-alt mr-1"></i> {{$career->location}}
                                        </span>

                                        <span class="d-none d-md-block col-1 text-center color--text">
                                            <small><i class="fas fa-chevron-right"></i></small>
                                        </span>
                                    </span>
                                    <hr>
                                    <p> @php echo $career->content; @endphp</p>
                                </div>
                            </a> <!-- Job Card -->
                            @endforeach

                            
                        </div>

                
                    </div>
                @else
                    <p class="mt-5 text-center">No career available</p>

                @endif

            </div>
        </div>
    </section>


@endsection
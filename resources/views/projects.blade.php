@extends('layouts.app')

@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s" style="background: url(img/gallery.png) top left no-repeat;">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">Projects</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Our Projects</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container mt-5">

        @if(isset($projects) && count($projects) > 0)
            <div class="row">
                @foreach($projects as $key=>$project)
                    <!-- Project Cards -->
                    <div class="col-md-3 mb-4">
                        <div class="card position-relative border border-warning box-shadow">
                            <img src="{{asset('img/projects/'.$project->image)}}" class="card-img-top">
                            <div class="card-img-overlay">
                                <a href="#" class="link-icon"  data-toggle="modal" data-target="#projectModal{{$key}}"><i class="fas fa-search-plus"></i></a>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title text-center text-primary fw-semi-bold">{{$project->title}}</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Add more project cards as needed -->


                    <!-- Project Modal 1 -->
                    <div class="modal fade" id="projectModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="projectModal{{$key}}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="projectModal{{$key}}Label">Project 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fa fa-window-close"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">                                
                                    <p>{{$project->title}}</p>
                                    @php
                                        $images = App\Http\Controllers\AdministratorController::getProjectImages($project->id);
                                    @endphp

                                    @if(isset($images) && count($images) > 0)
                                        <div class="row mt-3">
                                            @foreach($images as $image)
                                                <!-- Add more details or images here -->
                                                <div class="col-md-3">
                                                    <img src="{{asset('img/projects/'.$image->image)}}" class="img-fluid mb-3 border box-shadow">
                                                </div>
                                            @endforeach

                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary rounded animated slideInDown btn-small" data-dismiss="modal">Close</button>
                                    <!-- Add additional buttons if needed -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add more modals for each project as needed -->
                @endforeach

            </div>

        @else
            <div class="row">
                <div class="col-md-12">
                    <p class="text-danger text-center">No record found!</p>
                </div>
            </div>
        @endif
    </div>



    
@endsection
@extends('layouts.app')

@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s" style="background: url(img/gallery.png) top left no-repeat;">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">Gallery</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    @if(isset($galleries) && count($galleries) > 0)
        <div class="container">
            <div class="row" id="gallery">
                <!-- Gallery items -->
                @foreach($galleries as $gallery)
                <div class="col-md-4 gallery-item">
                    <a href="{{ URL::asset('img/gallery/'.$gallery->image) }}" class="image-link">
                        <img src="{{ URL::asset('img/gallery/'.$gallery->image) }}" class="img-fluid">
                    </a>
                </div>
                @endforeach
                
            
            </div>
        </div>
    @endif


@endsection
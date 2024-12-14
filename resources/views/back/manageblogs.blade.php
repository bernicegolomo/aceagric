@extends('back.layouts.app')

@section('content')


            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Manage Blog</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Articles</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="col-xxl-9 order-xxl-0 order-first">
                        <div class="d-flex flex-column h-100">
                            <div class="row h-100">
                                <div class="row">
                                    <div class="col-xs-12">
                                        @include('partials.errors') 
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1"></h4>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch form-switch-right form-switch-md">
                                                        <a  href="{{url('/addblog')}}" class="btn btn-success btn-label right rounded-pill" ><i class="ri-add-circle-line label-icon align-middle rounded-pill fs-16 ms-2"></i> Add Article</a>
                                                    </div>
                                                </div>
                                            </div><!-- end card header -->


                                            <div class="card-body">
                                                <div class="mb-5 mt-3">
                                                    <div class="live-preview">
                                                        @if(isset($blogs) && count($blogs) > 0)
                                                            @foreach($blogs as $blog)
                                                            <div class="col mb-5" >
                                                                <div class="card card-body">
                                                                    <div class="d-flex mb-4 align-items-center">
                                                                        <div class="flex-shrink-0">
                                                                            <img src="{{ URL::asset('assets/img/blog/'.$blog->image) }}" alt="" class="avatar-sm rounded-circle" />
                                                                        </div>
                                                                    </div>
                                                                    <blockquote class="card-blockquote mb-0">
                                                                        <p class="text-muted mb-2">{{$blog->title}}</p>
                                                                        <figure class="mb-0">
                                                                            <blockquote class="blockquote text-truncate" style="height:100px;">
                                                                                <p class="lead">"@php echo $blog->short_desc; @endphp"</p>
                                                                            </blockquote>
                                                                        </figure>
                                                                    </blockquote>
                                                                    <a href="{{url('/addblog', Illuminate\Support\Facades\Crypt::encrypt($blog->id))}}" class="btn btn-primary btn-sm mt-2">Manage</a>
                                                                    @if($blog->status == 0)
                                                                        <a href="{{url('/activateblog', Illuminate\Support\Facades\Crypt::encrypt($blog->id))}}" class="btn btn-success btn-sm mt-2">Activate</a>
                                                                    @else
                                                                        <a href="{{url('/deactivateblog', Illuminate\Support\Facades\Crypt::encrypt($blog->id))}}" class="btn btn-warning btn-sm mt-2">De-Activate</a>
                                                                    @endif
                                                                    <a href="{{url('/deleteblog', Illuminate\Support\Facades\Crypt::encrypt($blog->id))}}" class="btn btn-danger btn-sm mt-2">Delete</a>
                                                                </div>
                                                            </div><!-- end col -->
                                                            @endforeach
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- end row -->
                        </div>
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->




@endsection
@extends('back.layouts.app')

@section('content')


            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">{{$title}}</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{url('/allprojects')}}">Projects</a></li>
                                        <li class="breadcrumb-item active">{{$title}}</li>
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
                                            <div class="card-body">
                                                <div class="mb-5 mt-3">
                                                    <div class="live-preview">
                                                        <div class="table-responsive">
                                                            <form action="{{url('addproject')}}" method="POST"  enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body">

                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-xs-12">
                                                                            <div class="mb-4">
                                                                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" name="title" @if(isset($content)) value="{{$content->title}}" @endif required="">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-10 col-xs-12">
                                                                            <div class="mb-4">
                                                                                <label class="form-label">Featured Image @if(!isset($content)) <span class="text-danger">*</span> @endif</label>
                                                                                <input type="file" class="form-control" name="image" @if(!isset($content)) required="" @endif>
                                                                            </div>
                                                                        </div>
                                                                        @if(isset($content) && !empty($content->image))
                                                                            <div class="col-lg-2 col-xs-12">
                                                                                <div class="mt-4">
                                                                                <img src="{{asset('img/projects/'.$content->image)}}" style="height:50px" class="img-fluid d-block img-thumbanail">
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>

                                                                    @if(isset($content))
                                                                    <input type="hidden" class="form-control" name="id" value="{{$content->id}}" required="">
                                                                    @endif

                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-xs-12">
                                                                            <div class="mb-4">
                                                                                <label class="form-label">Content <span class="text-danger">*</span></label>
                                                                                <textarea class="form-control" id="editor1" name="content" required="" style="height:200px;"> @if(isset($content)) {{$content->content}} @endif</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    @if(isset($content))
                                                                        @if(isset($projectimages) && count($projectimages) > 0)
                                                                            <div class="row">
                                                                                @foreach($projectimages as $projectimage)
                                                                                    <div class="col-md-2 mb-4">
                                                                                        <img src="{{asset('img/projects/'.$projectimage->image)}}" style="height:50px" class=" img-thumbnail img-fluid d-block">
                                                                                        <span><a class="text-danger" href="{{url('/deleteprojectimage', Illuminate\Support\Facades\Crypt::encrypt($projectimage->id))}}"   onclick="return confirm(' Are you sure you want to delete this?');"> <i class=" ri-delete-bin-line align-bottom"></i>  Delete</a></span>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    <hr>
                                                                    <p><em>Enter project images.</em></p>
                                                                    <div class="row">
                                                                        <div class="col-md-11">
                                                                            <input type="file" name="images[]" class="form-control" multiple=""/></td>                                                                                      
                                                                        </div>
                                                                        <div class="col-md-1"></div>
                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                                <hr>
                                                                <div class="modal-footer mb-4">
                                                                    @if(isset($content))
                                                                        <button type="submit" name="update" value="1" class="btn btn-info me-2"><i class="bx bx-check-double font-size-16 align-middle"></i> Update </button>
                                                                    @else                                                                        
                                                                        <button type="submit" name="submit" value="1" class="btn btn-info me-2"><i class="bx bx-check-double font-size-16 align-middle"></i> Save </button>
                                                                    @endif
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bx bx-no-entry font-size-16 align-middle"></i> Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
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



@push('scripts')

@endpush
@stack('scripts')


@endsection



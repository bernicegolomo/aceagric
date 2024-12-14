@extends('back.layouts.app')

@section('content')


            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Article</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{url('/blogs')}}">Manage Blog</a></li>
                                        <li class="breadcrumb-item active">New Articles</li>
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
                                                        <div class="table-responsive">
                                                            <form action="{{url('addblog')}}" method="POST"  enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body">

                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-xs-12">
                                                                            <div class="mb-4">
                                                                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" name="title" @if(isset($blog)) value="{{$blog->title}}" @endif required="">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    @if(isset($blog))
                                                                    <input type="hidden" class="form-control" name="id" value="{{$blog->id}}" required="">
                                                                    @endif

                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-xs-12">
                                                                            <div class="mb-4">
                                                                                <label class="form-label">Short Description <span class="text-danger">*</span></label>
                                                                                <textarea class="form-control" id="editor1" name="short" required="" style="height:200px;"> @if(isset($blog)) {{$blog->short_desc}} @endif</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-xs-12">
                                                                            <div class="mb-4">
                                                                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                                                                <textarea class="form-control" id="editor" name="desc" style="height:300px;">@if(isset($blog)) {{$blog->desc}} @endif</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">                        
                                                                        <div class="col-lg-10 col-xs-10">
                                                                            <div class="mb-4">
                                                                                <label class="form-label">Featured Icon @if(!isset($blog)) <span class="text-danger">*</span> @endif</label>
                                                                                <input type="file" class="form-control" name="image" @if(!isset($blog))  required="" @endif>
                                                                            </div>
                                                                        </div>  
                                                                        @if(isset($blog) && !empty($blog->image))
                                                                            <div class="col-lg-2 col-xs-2 mt-4">
                                                                                <img class="img-thumbnail avatar-sm" src="{{ URL::asset('assets/img/blog/'.$blog->image) }}" data-holder-rendered="true">
                                                                            </div>                                                                        
                                                                        @endif
                                                                    </div>
                                                                    <hr>
                                                                    
                                                                    
                                                                </div>
                                                                <hr>
                                                                <div class="modal-footer mb-4">
                                                                    @if(isset($blog))
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





@endsection
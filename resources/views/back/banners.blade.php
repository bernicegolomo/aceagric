@extends('back.layouts.app')

@section('content')


            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Manage Banners</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Banners</li>
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
                                                        <a  data-bs-toggle="modal" data-bs-target=".bannerModal" class="btn btn-info btn-label right rounded-pill" ><i class="ri-add-circle-line label-icon align-middle rounded-pill fs-16 ms-2"></i> Add Banner</a>
                                                    </div>
                                                </div>
                                            </div><!-- end card header -->


                                            <div class="card-body">
                                                <div class="mb-5 mt-3">
                                                    <div class="live-preview">
                                                    <div class="table-responsive"  style="min-height:250px">
                                                            <table class="table align-middle table-bordered mb-0">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th scope="col">SNO.</th>
                                                                        <th scope="col" class="text-warp">Banners</th>
                                                                        <th scope="col" class="text-warp">Title</th>
                                                                        <th scope="col" class="text-warp">Sub Title</th>
                                                                        <th scope="col" class="text-warp">Description</th>
                                                                        <th scope="col">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if(isset($banners) && count($banners) > 0)
                                                                        @php $x=0; @endphp
                                                                        @foreach($banners as $banner)
                                                                            @php $x++; @endphp
                                                                            <tr>
                                                                                <td><span class="fw-medium text-primary"># {{ $x }}</span></td>
                                                                                <td class="wrap"  style="width:30px;">
                                                                                    <img class="img-thumbnail avatar-sm" src="{{ URL::asset('img/'.$banner->image) }}" data-holder-rendered="true">
                                                                                </td>
                                                                                <td class="wrap">{{ $banner->title }}</td>
                                                                                <td class="wrap">{{ $banner->subtitle }}</td>
                                                                                <td class="wrap">{{ $banner->desc }}</td>
                                                                                <td>
                                                                                    <div class="btn-group">
                                                                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                            Action
                                                                                        </button>
                                                                                        <div class="dropdown-menu">
                                                                                            <div class="dropdown-divider"></div>
                                                                                            <a class="dropdown-item" href="{{url('deletebanner', Illuminate\Support\Facades\Crypt::encrypt($banner->id))}}" onclick="return confirm(' Are you sure you want to delete this banner?');" >Delete Banner</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @else
                                                                        <tr>
                                                                            <td colspan="8" class="text-center">No data found</td>
                                                                        </tr>
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                            <!-- end table -->
                                                        </div>
                                                        <!-- end table responsive -->
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


            <!-- Start Upload Banner Modal -->
            <div class="modal fade bannerModal" tabindex="-1" role="dialog" aria-labelledby="bannerModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="bannerModalLabel">Upload Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <form action="{{url('banners')}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <hr>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div class="mb-4">
                                    <label class="form-label">Title  <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required="" name="title">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div class="mb-4">
                                    <label class="form-label">Sub Title </label>
                                    <input type="text" class="form-control" name="subtitle">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div class="mb-4">
                                    <label class="form-label">Description </label>
                                    <textarea class="form-control" name="desc"> </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">                        
                            <div class="col-lg-12 col-xs-12">
                                <div class="mb-4">
                                    <label class="form-label">Upload Banner <span class="text-danger">*</span> </label>
                                    <input type="file" class="form-control" name="banner" required="">
                                </div>
                            </div>   
                        </div>
                    </div>
                    <hr>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-info"><i class="bx bx-check-double font-size-16 align-middle"></i> Upload</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bx bx-no-entry font-size-16 align-middle"></i> Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- end upload exam stamp modal -->





@endsection
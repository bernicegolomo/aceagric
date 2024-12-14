@extends('back.layouts.app')

@section('content')


            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Manage NewsLetters</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Subscriptions</li>
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
                                                        
                                                    </div>
                                                </div>
                                            </div><!-- end card header -->


                                            <div class="card-body">
                                                <div class="mb-5 mt-3">
                                                    <div class="live-preview">
                                                        <div class="table-responsive">
                                                            <table class="table align-middle table-nowrap mb-0">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th scope="col">SNO.</th>
                                                                        <th scope="col" class="text-warp">Email</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if(isset($newsletters) && !empty($newsletters))
                                                                        @php $x = 0; @endphp
                                                                        @foreach($newsletters as $key=>$newsletter)
                                                                            @php $x++; @endphp
                                                                            <tr>
                                                                                <td><span class="fw-medium text-primary"># {{ $x }} </span></td>
                                                                                <td>{{ $newsletter->email }}</td> 
                                                                            </tr>
                                                                        @endforeach
                                                                    @else
                                                                        <tr>
                                                                            <td colspan="4" class="text-center">No data found</td>
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



            <!-- Start Add User Modal -->
            <div class="modal fade addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Administrator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <form action="{{url('/createadministrator')}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <hr>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div class="mb-4">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div class="mb-4">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter " required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div class="mb-4">
                                    <label class="form-label" for="password-input">Password</label>
                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                        <input type="password" name="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input">
                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    <hr>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-info"><i class="bx bx-check-double font-size-16 align-middle"></i> Submit</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bx bx-no-entry font-size-16 align-middle"></i> Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- end add user modal -->




@endsection
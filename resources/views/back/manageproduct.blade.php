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
                                        <li class="breadcrumb-item"><a href="{{url('/products')}}">Manage Products</a></li>
                                        <li class="breadcrumb-item active">New Product</li>
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
                                                            <form action="{{url('addproduct')}}" method="POST"  enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body">

                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-xs-12">
                                                                            <div class="mb-4">
                                                                                <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" name="name" @if(isset($product)) value="{{$product->name}}" @endif required="">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    @if(isset($product))
                                                                    <input type="hidden" class="form-control" name="id" value="{{$product->id}}" required="">
                                                                    @endif

                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-xs-12">
                                                                            <div class="mb-4">
                                                                                <label class="form-label">Product Size <span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" name="size" @if(isset($product)) value="{{$product->size}}" @endif required="">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-xs-12">
                                                                            <div class="mb-4">
                                                                                <label class="form-label">Price <span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" name="amount" @if(isset($product)) value="{{$product->amount}}" @endif required="">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">                        
                                                                        <div class="col-lg-10 col-xs-10">
                                                                            <div class="mb-4">
                                                                                <label class="form-label">Featured Image @if(!isset($product)) <span class="text-danger">*</span> @endif</label>
                                                                                <input type="file" class="form-control" name="image" @if(!isset($product))  required="" @endif>
                                                                            </div>
                                                                        </div>  
                                                                        @if(isset($product) && !empty($product->file))
                                                                            <div class="col-lg-2 col-xs-2 mt-4">
                                                                                <img class="img-thumbnail avatar-sm" src="{{ URL::asset('assets/img/product/'.$product->file) }}" data-holder-rendered="true">
                                                                            </div>                                                                        
                                                                        @endif
                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                                <hr>
                                                                <div class="modal-footer mb-4">
                                                                    @if(isset($product))
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
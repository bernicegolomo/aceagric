@extends('back.layouts.app')

@section('content')


            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Our Gallery</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Gallery</li>
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
                                            <div class="card-header border-0">
                                                <div class="row g-4">
                                                    <div class="col-sm-auto">
                                                        <div>
                                                            <a  data-bs-toggle="modal" data-bs-target=".galleryModal" class="btn btn-info btn-label right rounded-pill me-2" ><i class="ri-add-circle-line label-icon align-middle rounded-pill fs-16 ms-2"></i> Add Gallery</a>
                                            
                                                        </div>
                                                    </div>
                                                    <!--
                                                    <div class="col-sm">
                                                        <div class="d-flex justify-content-sm-end">
                                                            <div class="search-box ms-2">
                                                                <input type="text" class="form-control" id="searchProductList" placeholder="Search Products...">
                                                                <i class="ri-search-line search-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    -->
                                                </div>
                                            </div>

                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#productnav-all" role="tab" aria-selected="true">
                                                                    All <span class="badge badge-soft-danger align-middle rounded-pill ms-1">{{count($galleryz)}}</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="card-body">

                                                <div class="tab-content text-muted">
                                                    <div class="tab-pane active" id="productnav-all" role="tabpanel">
                                                        <div id="table-product-list-all" class="table-card gridjs-border-none">
                                                            <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                                                                <div class="gridjs-wrapper" style="height: auto;">
                                                                    <table role="grid" class="gridjs-table" style="height: auto;">
                                                                        <thead class="gridjs-thead">
                                                                            <tr class="gridjs-tr">
                                                                                <th data-column-id="#" class="gridjs-th text-muted" style="width: 40px;">
                                                                                    <div class="gridjs-th-content">#</div>
                                                                                </th>
                                                                                <th data-column-id="product" class="gridjs-th gridjs-th-sort text-muted" tabindex="0" style="width: 360px;">
                                                                                    <div class="gridjs-th-content">Image</div>
                                                                                </th>
                                                                                <th data-column-id="action" class="gridjs-th text-muted" style="width: 80px;">
                                                                                    <div class="gridjs-th-content">Action</div>
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="gridjs-tbody">
                                                                            @if(isset($galleryz) && count($galleryz))
                                                                                @php  $x = 0; @endphp
                                                                                @foreach($galleryz as $gallery)
                                                                                    @php $x++; @endphp
                                                                                    <tr class="gridjs-tr">
                                                                                        <td data-column-id="#" class="gridjs-td">
                                                                                            {{$x}}
                                                                                        </td>
                                                                                        <td class="gridjs-td">
                                                                                            <img src="{{ URL::asset('img/gallery/'.$gallery->image) }}" alt="" class="avatar-sm img-responsive img-thumbnail" />
                                                                                        </td>
                                                                                        <td data-column-id="action" class="gridjs-td">
                                                                                            <span>
                                                                                                <div class="dropdown">
                                                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                                        <i class="ri-more-fill"></i>
                                                                                                    </button>
                                                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                                                        
                                                                                                        <li>
                                                                                                            <a class="dropdown-item edit-list"  href="{{url('/deletegallery', Illuminate\Support\Facades\Crypt::encrypt($gallery->id))}}"   onclick="return confirm(' Are you sure you want to delete image?');">
                                                                                                                <i class=" ri-delete-bin-line align-bottom me-2 text-muted"></i> Delete
                                                                                                            </a>
                                                                                                        </li>

                                                                                                    </ul>
                                                                                                </div>
                                                                                            </span>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            @endif
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <!-- end tab pane -->

                                                    

                                                    
                                                </div>
                                                <!-- end tab content -->

                                                <div class="row">
                                                    <div class="col-lg-12 mt-3 ">
                                                            @if(isset($query))
                                                                {{ $galleryz->appends($query)->links('pagination::bootstrap-5') }}
                                                            @else
                                                                {{ $galleryz->withQueryString()->links('pagination::bootstrap-5') }}
                                                            @endif
                                                    </div>
                                                </div>
                                                <!-- end row -->

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



            

            <!-- Start Add Gallery Level Modal -->
            <div class="modal fade galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalLabel">Add Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <form action="{{url('gallery')}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <hr>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div class="mb-4">
                                    <label class="form-label">Images <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="images[]" multiple="" required="">
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    <hr>
                    <div class="modal-footer mb-4">
                      <button type="submit" name="submit" value="1" class="btn btn-info me-2"><i class="bx bx-check-double font-size-16 align-middle"></i> Submit</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bx bx-no-entry font-size-16 align-middle"></i> Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- end add gallery modal -->




@endsection
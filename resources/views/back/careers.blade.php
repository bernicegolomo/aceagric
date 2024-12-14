@extends('back.layouts.app')

@section('content')


            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Careers</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
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
                                            <div class="card-header border-0">
                                                <div class="row g-4">
                                                    <div class="col-sm-auto">
                                                        <div>
                                                            <a href="{{url('/addcareer')}}" class="btn btn-success" id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Add Career</a>
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
                                                                    All <span class="badge badge-soft-danger align-middle rounded-pill ms-1">{{count($careers)}}</span>
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
                                                                                    <div class="gridjs-th-content">Title</div>
                                                                                </th>
                                                                                <th data-column-id="product" class="gridjs-th gridjs-th-sort text-muted" tabindex="0" style="width: 360px;">
                                                                                    <div class="gridjs-th-content">Type</div>
                                                                                </th>
                                                                                <th data-column-id="product" class="gridjs-th gridjs-th-sort text-muted" tabindex="0" style="width: 360px;">
                                                                                    <div class="gridjs-th-content">Location</div>
                                                                                </th>
                                                                                <th data-column-id="action" class="gridjs-th text-muted" style="width: 80px;">
                                                                                    <div class="gridjs-th-content">Action</div>
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="gridjs-tbody">
                                                                            @if(isset($careers) && count($careers))
                                                                                @php  $x = 0; @endphp
                                                                                @foreach($careers as $content)
                                                                                    @php $x++; @endphp
                                                                                    <tr class="gridjs-tr">
                                                                                        <td data-column-id="#" class="gridjs-td">
                                                                                            {{$x}}
                                                                                        </td>
                                                                                        <td class="gridjs-td">{{ $content->title}} </td>
                                                                                        <td class="gridjs-td">{{$content->type}} </td>
                                                                                        <td class="gridjs-td">{{$content->location}} </td>
                                                                                        <td data-column-id="action" class="gridjs-td">
                                                                                            <span>
                                                                                                <div class="dropdown">
                                                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                                        <i class="ri-more-fill"></i>
                                                                                                    </button>
                                                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                                                        <li>
                                                                                                            <a class="dropdown-item edit-list"  href="{{url('/addcareer', Illuminate\Support\Facades\Crypt::encrypt($content->id))}}">
                                                                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
                                                                                                            </a>
                                                                                                        </li>
                                                                                                        
                                                                                                        <li>
                                                                                                            <a class="dropdown-item edit-list"  href="{{url('/deletecareer', Illuminate\Support\Facades\Crypt::encrypt($content->id))}}"   onclick="return confirm(' Are you sure you want to delete this career?');">
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
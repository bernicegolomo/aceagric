@extends('back.layouts.app')

@section('content')


            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Manage Orders</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Orders</li>
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
                                                            <table class="table align-middle table-nowrap mb-0 table-bordered">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th scope="col">SNO.</th>
                                                                        <th scope="col" class="text-warp">Buyer Details</th>
                                                                        <th scope="col" class="text-warp">Address</th>
                                                                        <th scope="col" class="text-warp">Items</th>
                                                                        <th scope="col" class="text-warp">Status</th>
                                                                        <th scope="col" class="text-warp">Order Date</th>
                                                                        <th scope="col" class="text-warp">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if(isset($orders) && !empty($orders))
                                                                        @php $x = 0; @endphp
                                                                        @foreach($orders as $key=>$order)
                                                                            @php $x++; @endphp
                                                                            <tr>
                                                                                <td><span class="fw-medium text-primary"># {{ $x }} </span></td>
                                                                                <td>
                                                                                    <p>
                                                                                        <strong>Fullname: </strong>
                                                                                        {{ strtoupper($order->fullname) }}
                                                                                    </p>
                                                                                    
                                                                                    <p>
                                                                                        <strong>Email: </strong>
                                                                                        {{ $order->email }}
                                                                                    </p>
                                                                                    
                                                                                    <p>
                                                                                        <strong>Phone No.: </strong>
                                                                                        {{ $order->phone }}
                                                                                    </p>
                                                                                </td> 
                                                                                <td>
                                                                                    <p>{{ $order->address }}</p>
                                                                                    <p>{{ $order->state }}</p>
                                                                                    <p>{{ $order->country }}</p>
                                                                                </td>
                                                                                <td>
                                                                                    @php 
                                                                                        $serialitems = $order->items; 
                                                                                        $items = json_decode($serialitems , true); 
                                                                                         
                                                                                    @endphp
                                                                                    
                                                                                    @if(isset($items) && is_array($items) && count($items) > 0 )
                                                                                    @php $total = 0;  @endphp
                                                                                    @foreach($items as $key=>$item)
                                                                                        @php $total = $total + ($item['price'] * $item['qty']); @endphp
                                                                                        
                                                                                        <p>
                                                                                            {{$item['name']}}
                                                                                        </p>
                                                                                        <p>
                                                                                            Unit Price: &#8358; {{number_format($item['price']) }}
                                                                                        </p>
                                                                                        <p>
                                                                                            Qty: {{$item['qty']}}
                                                                                        </p>
                                                                                        
                                                                                        <p>
                                                                                            Total: &#8358;{{number_format($item['price'] * $item['qty'])}}
                                                                                        </p>
                                        
                                                                                    @endforeach
                                                                                    
                                                                                    <p><strong>Grand Total: &#8358; {{number_format($total,2)}}</strong></p>
                                                                                                  
                                                                                                                            
                                                                                        
                                                                                @endif
                                                                
                                                                                </td>   
                                                                                <td> 
                                                                                    @if($order->status == "Pending Payment") 
                                                                                        <span class="bg-danger p-2 text-white">
                                                                                            {{$order->status}}
                                                                                        </span>
                                                                                    @elseif($order->status == "Payment Successful")
                                                                                        <span class="bg-primary p-2 text-white">
                                                                                            {{$order->status}}
                                                                                        </span>
                                                                                    @elseif($order->status == "Payment Successful | Order Processed")
                                                                                        <span class="bg-success p-2 text-white">
                                                                                            {{$order->status}}
                                                                                        </span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ $order->date }}</td> 
                                                                                <td>
                                                                                    @if($order->status == "Payment Successful")
                                                                                    <a href="{{url('/processorder', Illuminate\Support\Facades\Crypt::encrypt($order->id))}}" class="btn btn-primary" onclick="return confirm(' Are you sure you want to process this order? By clicking on the OK button, order will be updated and shown that it has been delivered to customer.');" >Process Order</a>
                                                                                    @endif
                                                                                </td>
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
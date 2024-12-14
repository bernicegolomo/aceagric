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
                                        <li class="breadcrumb-item"><a href="{{url('/services')}}">Services</a></li>
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
                                                            <form action="{{url('addservice')}}" method="POST"  enctype="multipart/form-data">
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
                                                                        <div class="col-lg-12 col-xs-12">
                                                                            <div class="mb-4">
                                                                                <label class="form-label">Sub Title </label>
                                                                                <input type="text" class="form-control" name="subtitle" @if(isset($content)) value="{{$content->subtitle}}" @endif>
                                                                            </div>
                                                                        </div>
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
                                                                        @if(isset($servicecontents) && count($servicecontents) > 0)
                                                                            @foreach($servicecontents as $servicecontent)
                                                                            <p>
                                                                                <span>{{$servicecontent->content}}</span>
                                                                                <span><a class="text-danger" href="{{url('/deleteservicecontent', Illuminate\Support\Facades\Crypt::encrypt($servicecontent->id))}}"   onclick="return confirm(' Are you sure you want to delete this?');"> <i class=" ri-delete-bin-line align-bottom"></i>  Delete</a></span>
                                                                            </p>

                                                                            @endforeach
                                                                        @endif
                                                                    @endif
                                                                    <hr>
                                                                    <p><em>Enter bullent points for services.</em></p>
                                                                    <div class="row">
                                                                        <div class="col-md-11">
                                                                            <div class="form-group">
                                                                                <table class="table table-bordered table-hover" id="dynamic_field">
                                                                                    <tr>
                                                                                        <td><input type="text" name="servicetitle[]" placeholder="Enter Service Point" class="form-control"/></td>
                                                                                        <td><button type="button" name="add" id="add" class="btn btn-primary" >Add More</button></td>  
                                                                                    </tr>
                                                                                </table>                                                                            
                                                                            </div>
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
<script>

$(document).ready(function(){

    var i = 1;
    var length;
    $("#add").click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="servicetitle[]" placeholder="Enter Service Point" class="form-control"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
    });
    
    $(document).on('click', '.btn_remove', function(){ 
        var button_id = $(this).attr("id");     
        $('#row'+button_id+'').remove();  
    });
        
});
</script>
@endpush
@stack('scripts')


@endsection



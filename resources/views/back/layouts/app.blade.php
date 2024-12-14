<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

<meta charset="utf-8" />
    <title>
        @isset($title)
            {{ $title }} | 
        @endisset
        {{ config('app.name') }}
    </title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Tomatrix offers premium, preservative-free tomato puree, embodying sustainability and wholesome nutrition. Discover our commitment to quality and community impact, transforming meals with the essence of Tomatrix." name="description" />
    <!-- App favicon -->
    
    
    <link rel="icon" type="image/png" href="{{asset('img/logo.png')}}">

    <link href="{{asset('back/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('back/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" />

    <!-- Layout config Js -->
    <script src="{{asset('back/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('back/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('back/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    
    <!-- App Css-->
    <link href="{{asset('back/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('back/css/custom.min.css')}}" rel="stylesheet" type="text/css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf.js"></script>

    
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{url('/dashboard')}}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('assets/img/logo/logo.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('assets/img/logo/logo.png')}}" alt="" height="17">
                        </span>
                    </a>

                    <a href="{{url('/dashboard')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('assets/img/logo/logo.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('assets/img/logo/logo.png')}}" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>
                
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{asset('back/images/users/user.jpg')}}">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{$user->name}}</span>

                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">
                                    Administrator
                                </span>
                                
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="{{url('/dashboard')}}"><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Profile</span></a>
                        
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url('logout')}}"><i
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background:#fff;">
                <!-- Dark Logo-->
                <a href="{{url('/dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('img/logo.png')}}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('img/logo.png')}}" alt="" height="50">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{url('/dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('img/logo.png')}}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('img/logo.png')}}" alt="" height="50">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>

                                    
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/dashboard')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/users')}}">
                                <i class="ri-team-fill"></i> <span data-key="t-users">Manage Users</span>
                            </a>
                        </li> <!-- end Users Menu -->
                        

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/banners')}}">
                                <i class="ri-image-add-fill"></i> <span data-key="t-banners">HomePage Sliders</span>
                            </a>
                        </li> <!-- end Banners Menu -->

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/services')}}">
                                <i class="ri-newspaper-line"></i> <span data-key="t-blog">Manage Services</span>
                            </a>
                        </li> <!-- end Services Menu -->

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/allprojects')}}">
                                <i class="ri-projector-line"></i> <span data-key="t-blog">Manage Projects</span>
                            </a>
                        </li> <!-- end Projects Menu -->


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/our-team')}}">
                                <i class="ri-group-2-fill"></i> <span data-key="t-orders">Manage Teams</span>
                            </a>
                        </li> <!-- end Our Teams Menu -->

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/gallery')}}">
                                <i class="ri-gallery-fill"></i> <span data-key="t-numbers">Our Gallery</span>
                            </a>
                        </li> <!-- end Gallery Menu -->

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/cms')}}">
                                <i class="ri-profile-fill"></i> <span data-key="t-blog">Page Content</span>
                            </a>
                        </li> <!-- end Page Content Menu -->

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/allcareers')}}">
                                <i class="ri-briefcase-line"></i> <span data-key="t-blog">Manage Careers</span>
                            </a>
                        </li> <!-- end Careers Menu -->

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/newsletters')}}">
                                <i class="ri-todo-fill"></i> <span data-key="t-newletter">NewsLetters</span>
                            </a>
                        </li> <!-- end NewsLetter Menu -->
                          
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('logout')}}">
                                <i class="ri-logout-box-r-line"></i> <span data-key="t-logout">Logout</span>
                            </a>
                        </li> <!-- end Logout Menu -->


                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('content')

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <script>document.write(new Date().getFullYear())</script> Powered by eLED Global Services
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>


    

    <!-- JAVASCRIPT -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script src="{{asset('back/js/jquery.min.js')}}"></script>
    <script src="{{asset('back/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('back/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('back/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('back/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('back/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('back/js/plugins.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{asset('back/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Swiper Js -->
    <script src="{{asset('back/libs/swiper/swiper-bundle.min.js')}}"></script>

    <!-- CRM js -->
    <script src="{{asset('back/js/pages/dashboard-crypto.init.js')}}"></script>

    <!-- form wizard init -->
    <script src="{{asset('back/js/pages/form-wizard.init.js')}}"></script>
    <script src="{{asset('back/js/pages/form-wizard-1.init.js')}}"></script>
    <script src="{{asset('back/js/pages/form-wizard-2.init.js')}}"></script>

    
    <!-- password-addon init -->
    <script src="{{asset('back/js/pages/password-addon.init.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('back/js/app.js')}}"></script>

    <!--select2 cdn-->
    
    <script src="{{asset('back/js/select2.min.js')}}"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->

    <script src="{{asset('back/js/pages/select2.init.js')}}"></script>

    

    <script>
        function onlyNumberKey(evt) {

            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
    </script>
    
    <script type="text/javascript">
      $( document ).ready(function() {
          $(".js-example-basic-multiple").select2({
            
          });
      });
    </script>

    <script>

        $(document).ready(function() {
            $("#select2insidemodal").select2({
                dropdownParent: $(".classModal")
            });
            
        });


    </script>

    <script>
         /**
         * Check if passed value is a string
         */
        function isString(arg) {
        		if (typeof arg == 'string' || arg instanceof String) {
        				return true;
        		} else {
        				return false;
        		}
        }
        
        /**
         * Enable Check All Functionality
         * @param  {string} element - ID or class of table
         * @return {[none]}         none
         */
        function enableCheckAll(element) {
        		var $table = $(element),
        	  	  $notCheckAllCheckbox = $table.find(':checkbox').not('.checkAll');
        
        		// "check all" checkbox functionality
        		$table.find('.checkAll').click(function() {
        				$notCheckAllCheckbox.prop('checked', this.checked);
        		});
        
        		/* The "check all" checkbox is only checked if all rows are checked */
        		$notCheckAllCheckbox.change(function() {
        				var numOfChecked = $notCheckAllCheckbox.filter(':checked').length,
        						numOfCheckboxes = $notCheckAllCheckbox.length,
        						isAllChecked = numOfChecked === numOfCheckboxes;
        				$table.find('.checkAll').prop('checked', isAllChecked);
        		});
        }
        
        var table2 = $('#table2');
        enableCheckAll('#table'); // passing in a string
        enableCheckAll(table2); // passing in an object
    </script>

    
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>





    

<style>
    .examtable>:not(caption)>*>* {
        padding: 2px;
    }
</style>


    
@stack('scripts')
</body>

</html>
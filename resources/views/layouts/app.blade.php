<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>
        @if(isset($title))
            {{$title}} |
        @endif
        {{ config('app.name') }}
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Agritech consulting, Food systems development, Agricultural transformation, Africa agrifood sector, Management consulting, Rural development initiatives, Sustainable growth, Agricultural policy advocacy, Technology in agriculture, Collaboration in agrifood sector" name="keywords">
    <meta content="Transforming Africa's agrifood sector through innovative solutions and strategic partnerships – join AceAgric for sustainable growth, rural development, and positive change." name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('img/logo.png')}}">
        

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- Magnific Popup CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" rel="stylesheet">
  
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">-->
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <!--<div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <small><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</small>
                <small class="ms-4"><i class="fa fa-clock text-primary me-2"></i>9.00 am - 9.00 pm</small>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small><i class="fa fa-envelope text-primary me-2"></i>info@example.com</small>
                <small class="ms-4"><i class="fa fa-phone-alt text-primary me-2"></i>+012 345 6789</small>
            </div>
        </div>-->

        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="{{url('/')}}" class="navbar-brand ms-4 ms-lg-0">
                <!--<h1 class="display-5 text-primary m-0">Finanza</h1>-->
                <img src="{{asset('img/logo.png')}}" height="120px">
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="{{url('/')}}" class="nav-item nav-link active">Home</a>
                    <a href="{{url('/')}}#about" class="nav-item nav-link">About</a>
                    <a href="{{url('/')}}#service" class="nav-item nav-link">Services</a>
                    <a href="{{url('/projects')}}" class="nav-item nav-link">Projects</a>
                    <a href="{{url('/')}}#team" class="nav-item nav-link">Our Team</a>
                    <!--<a href="{{url('/')}}#testimonial" class="nav-item nav-link">Testimonial</a>  -->                      
                    <!--<a href="{{url('/our-gallery')}}" class="nav-item nav-link">Gallery</a>  -->
                    <a href="{{url('/contact-us')}}" class="nav-item nav-link">Contact</a>
                </div>
                <div class="d-none d-lg-flex ms-2">
                    @if(isset($page[7]) && !empty($page[7]->content))
                        <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="@php echo $page[7]->content; @endphp">
                            <small class="fab fa-facebook-f text-primary"></small>
                        </a>
                    @endif
                    @if(isset($page[9]) && !empty($page[9]->content))
                        <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="@php echo $page[9]->content; @endphp">
                            <small class="fab fa-twitter text-primary"></small>
                        </a>
                    @endif
                    @if(isset($page[10]) && !empty($page[10]->content))
                        <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="@php echo $page[10]->content; @endphp">
                            <small class="fab fa-linkedin-in text-primary"></small>
                        </a>
                    @endif
                    @if(isset($page[8]) && !empty($page[8]->content))
                        <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="@php echo $page[8]->content; @endphp">
                            <small class="fab fa-instagram text-primary"></small>
                        </a>
                    @endif
                    @if(isset($page[11]) && !empty($page[11]->content))
                        <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="@php echo $page[11]->content; @endphp">
                            <small class="fab fa-whatsapp text-primary"></small>
                        </a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    @yield('content')


    


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4" style="font-size:12px;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-12 text-left text-md-start">     
                    <a href="{{url('/carrers')}}" class="border-bottom"> Carrers</a> | 
                    <a href="{{url('/our-gallery')}}" class="border-bottom"> Gallery</a>
                </div>

                <div class="col-md-8 col-xs-12 text-right text-md-end mb-3 mb-md-0">
                    Copyright &copy; AceAgric Agritech & Food Systems Innovation, All Right Reserved. |
                    Designed By <a class="border-bottom" href="#">eLED Global Services</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="{{url('/')}}#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('lib/counterup/counterup.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>

    <!-- Magnific Popup JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
        // Initialize Magnific Popup
        $('.image-link').magnificPopup({
            type: 'image',
            gallery:{
            enabled:true
            }
        });
        });
    </script>

    <script>

        const cards = document.querySelectorAll(".grid-item");
            cards.forEach((item) => {
            item.addEventListener("mouseover", () => {
                cards.forEach((el) => el.classList.remove("active"));
                item.classList.add("active");
            });
        });
    </script>

    <style>
        /* Style for gallery items */
        .gallery-item {
            margin-bottom: 20px;
        }
        /* Style for lightbox */
        .mfp-iframe-holder .mfp-content {
            max-width: 800px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        @media (max-width: 480px) {
            .carousel-caption {
                /* Styles for smaller screens */
                top:200px;
                left:40px;
            }
            .display-1 {
                font-size: calc(0.625rem + 4.5vw);
            }

            #header-carousel .carousel-item{
                min-height:500px;
            }


            .panel-default > .panel-heading {
                color: var(--primary) !important;
                background-color: #e4e5e7;                
                border-color: #e4e5e7;
                padding: 0;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .panel-default > .panel-heading a {
                display: block;
                padding: 5px 10px;
                color: var(--primary) !important;
            }

            .panel-default > .panel-heading a:after {
                content: "";
                position: relative;
                top: 1px;
                display: inline-block;
                font-style: normal;
                font-weight: 400;
                line-height: 1;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                float: right;
                transition: transform 0.25s linear;
                -webkit-transition: -webkit-transform 0.25s linear;
            }

            .panel-default > .panel-heading a[aria-expanded="true"] {
                background-color: var(--primary) !important;
                color: #fff !important;
            }

            .panel-default > .panel-heading a[aria-expanded="true"]:after {
                content: "\2212";
                -webkit-transform: rotate(180deg);
                transform: rotate(180deg);
            }

            .panel-default > .panel-heading a[aria-expanded="false"]:after {
                content: "\002b";
                -webkit-transform: rotate(90deg);
                transform: rotate(90deg);
            }

            .panel-title{
                font-size: calc(0.800rem + .3vw) !important;
            }

        }

        .nav-link h5{
            font-size: 1.15rem;
        }

        .color--heading {
            color: #101f41 !important
        }

        .color--text {
            color: #4f5464 !important
        }


        .badge-circle {
            border-radius: 50%;
            height: 2.5rem;
            width: 2.5rem;
            font-size: 1rem;
            line-height: 2.5rem;
            padding: 0
        }

        .background--white,
        .bg-white {
            background-color: #fff !important
        }

        .background--brand,
        .background--primary,
        .bg-brand,
        .bg-primary {
            background-color: #4d5bed !important;
            color: #fff
        }

        .background--dark,
        .bg-dark {
            background: #0c2050 !important;
            color: #939eb8
        }

        .background--secondary,
        .bg-secondary {
            background-color: #939eb8 !important
        }

        .background--tertiary,
        .bg-tertiary {
            background-color: #9779e3 !important
        }

        .background--danger,
        .bg-danger {
            background-color: #f53d55 !important
        }

        .background--success,
        .bg-success {
            background-color: #66df7c !important
        }

        .background--warning,
        .bg-warning {
            background-color: #f6c460 !important
        }

        .background--warning2,
        .bg-warning2 {
            background-color: #f89c59 !important
        }

        .background--info,
        .bg-info {
            background-color: #52bbd3 !important
        }

        .background--light,
        .bg-light {
            background-color: #f6f8fb !important
        }

        .box-shadow{
            box-shadow: 0px 5px 8px 0px #bfbfbf;
        }


        
        /* Hover effect */
    .card-img-overlay {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      opacity: 0;
      background-color: rgba(1,124,56,0.5);
      transition: opacity 0.3s ease;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card:hover .card-img-overlay {
      opacity: 1;
    }

    /* Link icon styles */
    .link-icon {
      color: #fff;
      font-size: 44px;
    }

    .link-icon:hover {
      color: #fff;
    }

    /* Modal styles */
    .modal-content {
      background-color: #f8f9fa;
      border-radius: 0;
    }

    .modal-header {
      border-bottom: none;
    }

    .modal-title {
      color: #333;
      font-weight: bold;
    }

    .modal-body {
      color: #555;
    }

    .modal-footer {
      border-top: none;
    }

        

    </style>
</body>

</html>
<!doctype html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images')}}/shorticon.jpg"/>
    <!-- Bootstrap and other CSS -->
    <link rel="stylesheet" href="{{asset('css')}}/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('css')}}/vendor/fonts/circular-std/style.css"  />
    <link rel="stylesheet" href="{{asset('css')}}/library-layout.css" />
    <link rel="stylesheet" href="{{asset('css')}}/library/library.css" />
    <link rel="stylesheet" href="{{ asset('css')}}/jquery-ui.css" />
    <link rel="stylesheet" href="{{asset('css')}}/vendor/fonts/fontawesome/css/fontawesome-all.css" />

    <meta name="csrf-token" content="{{ csrf_token() }}" />

@yield('css')
<!-- Java Scripts File -->
    <!-- bootstap bundle js -->

    <script src="{{asset('js')}}/ajax/jquery.min.js"></script>
    <script src="{{asset('js')}}/bootstrap.min.js"></script>
    <script src="{{asset('js')}}/ajax/jquery.validate.min.js"></script>
    <script src="{{asset('js')}}/jquery-ui.js"></script>

    <!-- main js -->
    <script src="{{asset('js')}}/library.js"></script>


@yield('js')
    <title>@yield('title')</title>
</head>

<body id="body">
<!-- ============================================================== -->
<!-- main wrapper -->
<!-- ============================================================== -->
<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
@if(Session::has('adminLogin'))
    <div class="container-fluid p-0">
        <div class="row edumaster-top">
            <div class="col-md-2 edumaster-top-logo">
                <a href="{{route('admin.index')}}"><img class="img-fluid" src="{{asset('images')}}/library3.jpg" alt="" style="height: 58px;"></a>
            </div>
            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 edumaster-top-bar">
                <nav class="navbar navbar-expand-lg bg-white">
                    <div class="col-md-8 m-t-10 m-l-15 float-left">
                        <h4 style="margin-bottom: 5px; font-size: 25px;">{{$admin->admin_name}}</h4>
                        <p style="font-size: 12px;">{{$admin->designation}}</p>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-right-top">
                            <li class="nav-item dropdown nav-user">
                                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('images/admin')}}/{{$admin->admin_image}}" alt="" class="user-avatar-md rounded-circle"></a>
                                <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                    <div class="nav-user-info">
                                        <h5 class="mb-0 text-white nav-user-name">{{$admin->admin_name}}</h5>
                                    </div>
                                    <a class="dropdown-item" href="{{route('admin.adminProfile')}}"><i class="fas fa-user mr-2"></i>Account</a>
                                    <a class="dropdown-item" href="{{route('admin.adminLogout')}}"><i class="fas fa-power-off mr-2"></i>Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row" style="min-height: 100%; height: auto;">
            <div class="col-md-2 edumaster-middle-left-menu">
                <div class="accordion nav-left-sidebar sidebar-dark" id="accordionExample">
                    <div class="menu-list">
                        <nav class="navbar navbar-expand-lg navbar-light" id="sidebar">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><img src="{{asset('images/icons')}}/School.svg" style="max-width: 35px;" alt=""><b>M E N U</b></a>

                                        <div>
                                            <ul class="nav flex-column" id="child-ul">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{route('library.bookCategoryIndex')}}" id="active"><i class="fas fa-chevron-right"></i>Book Category</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{route('library.bookWriter')}}" id="active"><i class="fas fa-chevron-right"></i>Book Writer</a>
                                                </li>   
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{route('library.bookpublishers')}}" id="active"><i class="fas fa-chevron-right"></i>Publishers</a>
                                                </li>  
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{route('library.bookDonators')}}" id="active"><i class="fas fa-chevron-right"></i>Book Donators</a>
                                                </li> 
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{route('library.bookManagementList')}}" id="active"><i class="fas fa-chevron-right"></i>Library Books</a>
                                                </li>  
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{route('library.LibrarySelf')}}" id="active"><i class="fas fa-chevron-right"></i>Self</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{route('library.bookSelfIndex')}}" id="active"><i class="fas fa-chevron-right"></i>Book Self</a>
                                                </li> 
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{route('library.bookIssueIndex')}}" id="active"><i class="fas fa-chevron-right"></i>Book Issue</a>
                                                </li>  <li class="nav-item">
                                                    <a class="nav-link" href="{{route('library.BookIssueHistory')}}" id="active"><i class="fas fa-chevron-right"></i>Book Issue History</a>
                                                </li>
                                                </li>  <li class="nav-item">
                                                    <a class="nav-link" href="{{route('library.bookReturnIndex')}}" id="active"><i class="fas fa-chevron-right"></i>Book Return</a>
                                                </li>  
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-10 edumaster-middle-container">
                <div class="dashboard-edumaster">
                    @yield('container')
                </div>
            </div>
        </div>
    </div>
@endif
<!-- footer -->
    <div class="footer">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="container-fluid p-0">
                        <div class="text-center">
                            <p>&copy <a href="https://www.gmail.com">alamincse039@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end footer -->
</div>
<script>
    jQuery(function ($) {
        $("ul .nav-link")
            .click(function(e) {
                var link = $(this);

                var item = link.parent("li");

                if (item.hasClass("edumaster-active")) {
                    item.removeClass("edumaster-active").children(".nav-link").removeClass("edumaster-active");
                } else {

                }

                if (item.children("ul").length > 0) {
                    var href = link.attr("href");
                    link.attr("href", "#");
                    setTimeout(function () {
                        link.attr("href", href);
                    }, 300);
                    e.preventDefault();
                }
            })
            .each(function() {
                var link = $(this);
                if (link.get(0).href === location.href) {
                    link.addClass("edumaster-active");
                    link.addClass("show").parents(".submenu").addClass("show");
                    return false;
                }
            });
        });


</script>
</body>
</html>

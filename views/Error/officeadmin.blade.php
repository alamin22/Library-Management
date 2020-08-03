<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images')}}/shorticon.jpg"/>
    <!-- Bootstrap and other CSS -->
    <link rel="stylesheet" href="{{asset('css')}}/vendor/bootstrap/css/bootstrap.min.css">
    <link href="{{asset('css')}}/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css')}}/errorpage.css">
    <link rel="stylesheet" href="{{asset('css')}}/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('css')}}/Chart.min.css">
    <link rel="stylesheet" href="{{asset('css')}}/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="{{asset('css')}}/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="{{asset('css')}}/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="{{asset('css')}}/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{asset('css')}}/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="{{asset('css')}}/vendor/fonts/flag-icon-css/flag-icon.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

@yield('css')
<!-- Java Scripts File -->

    <!-- bootstap bundle js -->
    <script src="{{asset('js')}}/ajax/jquery.min.js"></script>
    <script src="{{asset('css')}}/vendor/bootstrap/js/popper.min.js"></script>
    <script src="{{asset('js')}}/bootstrap.min.js"></script>
    <script src="{{asset('js')}}/ajax/jquery.validate.js"></script>
    <script src="{{asset('js')}}/ajax/jquery.validate.min.js"></script>

    <!-- slimscroll js -->
    <script src="{{asset('css')}}/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="{{asset('js')}}/main-js.js"></script>
    <script src="{{asset('js')}}/school.js"></script>
    <script src="{{asset('js')}}/Chart.min.js"></script>
    <script src="{{asset('js')}}/jquery-ui.min.js"></script>
    @yield('js')
    <title>@yield('title')</title>
</head>
<body>
<div class="text-center">
    <img class="m-t-60" src="{{asset('images')}}/EdumasterLogo.svg" height="34px">
</div>
<div class="container">
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <img src="{{asset('images/')}}/bowing.png">
                    <div class="error-details">
                        Sorry, An Error has been occured, We will get back to You soon!
                    </div>
                    <div class="error-actions">
                        <a href="{{route('admin.index')}}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                            Take Me Home </a><a href="#" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-envelope"></span> Contact Support </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

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
    <link rel="stylesheet" href="{{asset('css')}}/admin-layout.css">
    <link rel="stylesheet" href="{{asset('css')}}/admin/adminstyle.css">
    <link rel="stylesheet" href="{{asset('css')}}/admin/adminlogin.css">
    <link rel="stylesheet" href="{{asset('css')}}/jquery-ui.css">
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
    <script src="{{asset('js')}}/library.js"></script>
    <!-- sparkline js -->
    <script src="{{asset('css')}}/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- chart c3 js -->
    <script src="{{asset('css')}}/vendor/charts/c3charts/c3.min.js"></script>
    <script src="{{asset('css')}}/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="{{asset('css')}}/vendor/charts/c3charts/C3chartjs.js"></script>
</head>
<body>
<!-- Modal HTML -->
<div id="myModal" class="modal" id="myModal">
    <div class="modal-dialog modal-login modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="avatar" style="background: #70b370;border: none;">
                    <img src="{{asset('images')}}/avatar-placeholder.png" alt="Avatar">
                </div>
                <h4 class="modal-title" style="font-family:fantasy;color: #618061">ADMIN LOGIN</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('adminlogin.loginAdminVerify')}}" id="adminlogin" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="login-btn">LOGIN</button>
                    </div>
                </form>
            </div>
            @if(session('message1'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Congrats !</strong> {{session('message1')}}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('message2'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Woops !</strong> {{session('message2')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="modal-footer">
                <a href="#">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>

@if($errors->any())
    @foreach($errors->all() as $erroor)
        <li>{{$erroor}}</li>
    @endforeach
@endif
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
    $('#myModal').modal({backdrop: 'static', keyboard: false})
</script>
</body>
</html>

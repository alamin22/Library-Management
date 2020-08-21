@extends('Layouts.library-index')
@section('title')
    Account Settings
@endsection
@section('container')
    <!-- ============================================================== -->
    <!-- end pageheader  -->
    <!-- ============================================================== -->
    <div class="library-widget">
        @if(session('message1'))
            <div class="alert">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Congrats !</strong> {{session('message1')}}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @endif
        @if(session('message2'))
            <div class="alert">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Woops !</strong> {{session('message2')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <style>
            #inputfile{
                display: none;
            }
            .btn-rounded {
                border-radius: 10em;
            }
            .btn-mdb-color{
                background-color: #dadae0;
            }
        </style>
        <!--Update School Admin-->
        <!-- ============================================================== -->
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="bg-white">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-2 text-left">
                                        <a href="{{route('admin.index')}}" class="pull-right one-back-button"><i class="fas fa-arrow-circle-left fa-3x"></i></a>
                                    </div>
                                    <div class="col-md-8 text-center">
                                        <h2>Update Profile Settings</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="card-body">
                                    <form method="post" action="{{route('admin.adminProfileUpdate')}}" name="adminForm" id="adminForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row d-flex">
                                            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 col-12">
                                                <div class="card" style="min-height: 63vh;">
                                                    <div class="card-header">
                                                        <div class="card-body">
                                                            <div class="col-md-12 text-center">
                                                                <div class="my-4">
                                                                    <!--Grid row-->
                                                                    <div class="row">
                                                                        <!--Grid column-->
                                                                        <div class="col-md-12 mb-4">
                                                                                <img class="rounded-circle" alt="100x100" width="120" height="120" src="{{asset('images')}}/avatar-placeholder.png"
                                                                                     data-holder-rendered="true" id="image">
                                                                                <input type='file' name='image' id='inputfile'>
                                                                        </div>
                                                                        <div class="col text-center">
                                                                            <input type="button" class="btn btn-dark btn-sm" id="get_file" value="Update Profile">
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="designation" class="col-sm-4 col-form-label">Designation</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="designation" id="designation" required=>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="admin_username" class="col-sm-4 col-form-label">Username</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="admin_username" id="admin_username" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="admin_password" class="col-sm-4 col-form-label">Password</label>
                                                            <div class="col-sm-8">
                                                                <input type="password" class="form-control" name="admin_password" placeholder="password minimum length 6" id="admin_password" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password</label>
                                                            <div class="col-sm-8">
                                                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="admin_email" class="col-sm-4 col-form-label">Email</label>
                                                            <div class="col-sm-8">
                                                                <input type="email" class="form-control" name="admin_email" id="admin_email" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="admin_phone" class="col-sm-4 col-form-label">Contact Number</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="admin_contact" id="admin_phone" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-success float-right m-t-5 m-r-10" id="submitButton">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#inputfile").change(function() {
            readURL(this);

        });
    </script>
    <script>
        document.getElementById('get_file').onclick = function() {
            var name = document.getElementById('inputfile').click();
            console.log(name);
        };
    </script>
    <script>
        $(document).ready(function () {
            $("#get_file").click(function () {
                $("#Create").show();
            });
        });
    </script>

{{--    School Image --}}

    <script>
        function readURLOne(input_one) {
            if (input_one.files && input_one.files[0]) {
                var reader_one = new FileReader();

                reader_one.onload = function(e) {
                    $('#image_one').attr('src', e.target.result);
                }

                reader_one.readAsDataURL(input_one.files[0]);
            }
        }

        $("#inputfile_one").change(function() {
            readURLOne(this);

        });
    </script>
    <script>
        document.getElementById('school_btn').onclick = function() {
            var name_one = document.getElementById('inputfile_one').click();
            console.log(name_one);
        };
    </script>
    <script>
        $(document).ready(function () {
            $("#school_btn").click(function () {


                $("#Create").show();
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.alert').slideDown(200).delay(10000).slideUp(300);
        })

</script>

@endsection


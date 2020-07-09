@extends('Layouts.library-index')
@section('title')
New Book Donator
@endsection
@section('container')
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
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 nopadding">
           <div class="card">
            <div class="card-header">
                    <div class="row">
                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1 text-left">
                                <a href="{{ route('library.bookDonators')}}" class="pull-right one-back-button"><i class="fas fa-arrow-circle-left fa-3x"></i></a>
                            </div>
                        <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11 mt-3">
                            <h3>New Book Donator</h3>
                        </div>
                    </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row form-group">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                            <label for="donator_name">Donator Name</label>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                            <input type="text" class="form-control" id="donator_name" name="donator_name">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                            <label for="donator_phone"> Phone Number</label>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                            <input type="text" id="donator_phone" name="donator_phone" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mt-2"><level for="address">Address</label></div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                            <input type="text" name="address" id="address" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 nopadding">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                           <button type="submit" class="btn btn-success" onclick="insertBookDonator()">Save</button>
                        </div>
                        <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                           <h5 id="message"></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function insertBookDonator(){
            var donator_name=$("#donator_name").val();
            var donator_phone=$("#donator_phone").val();
            var address=$("#address").val();
            $.ajax({
                url:"{{route('library.addDonatorsStore')}}",
                type:"POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                    donator_name:donator_name,
                    donator_phone:donator_phone,
                    address:address
                },
                datatype:"json",
                success:function(data){
                    
                    var message='';
                        $('#message').html('<div class="alert alert-success" role="alert">'+data.message+'</div>');
                        $('#message').show(function () {
                        setTimeout(function(){$('#message').html('');},5000);});
                        window.location=('/school/library/book/donators');

                },
               error:function(data){
                    console.log(data);
                },
            });
        }
    </script>
@endsection
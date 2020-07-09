@extends('Layouts.library-index')
@section('title')
Book Publisher Update
@endsection

@section('container')
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card pb-0">
            <div class="card-header">
                <div class="row">
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 m-t-10">
                        <h3>Book Publisher Update</h3>
                    </div>
                </div>

            </div>
       <!--  <form action="{{route('library.bookpublishersedit',['id'=>$data->book_publishers_id])}}" method="post">
            {{csrf_field()}}
            <div class="card-body">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 row">
                        <label for="name">{{__('underLibrary.Publisher_Name')}}</label>
                        <input type="text" name="name" id="" class="form-control" value="{{$data->book_publishers_name}}">
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 row">
                        <label for="address">{{__('underLibrary.Address')}}</label>
                        <input type="text" name="address" id="" class="form-control" value="{{$data->book_publishers_address}}">
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 row">
                        <label for="phone_number">{{__('underLibrary.Publisher_Phone')}}</label>
                        <input type="text" name="phone_number" id="" class="form-control" value="{{$data->book_publishers_phone_number}}">
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-success">{{__('underLibrary.Save')}}</button>
            </div>
        </form> -->
        <div class="card-body">
            <div class="form-group">
                <div class="row form-group">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                        <label for="name">Publisher Name</label>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                        <input type="text" value="{{$data->book_publishers_name}}" class="form-control" id="name" name="name">
                        <input type="hidden" value="{{$data->book_publishers_id}}" id="hidden_id" name="hidden_id">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                        <label for="phone_number">Phone Number</label>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                        <input type="text" value="{{$data->book_publishers_phone_number}}" id="phone_number" name="phone_number" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mt-2"><level for="address">Address</label></div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                        <input type="text" value="{{$data->book_publishers_address}}" name="address" id="address" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 nopadding">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                       <button type="submit" class="btn btn-success" onclick="updateBookPublisher()">Save</button>
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
       function updateBookPublisher(){
            var name=$("#name").val();
            var phone_number=$("#phone_number").val();
            var address=$("#address").val();
            var hidden_id=$("#hidden_id").val();
            $.ajax({
                url:"{{route('library.bookpublisherseditStore')}}",
                type:"POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                    name:name,
                    phone_number:phone_number,
                    address:address,
                    hidden_id:hidden_id,
                },
                datatype:"json",
                success:function(data){
            
                    var message='';
                        $('#message').html('<div class="alert alert-success" role="alert">'+data.message+'</div>');
                        $('#message').show(function () {
                        setTimeout(function(){$('#message').html('');},5000);});
                        window.location=('/school/library/book/publishers');

                },
               error:function(data){
                    console.log(data);
                },
            });
        }
    </script>
@endsection
@extends('Layouts.library-index')
@section('title')
Update Book Self
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
                                <a href="{{ route('library.bookSelfIndex')}}" class="pull-right one-back-button"><i class="fas fa-arrow-circle-left fa-3x"></i></a>
                            </div>
                        <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11 mt-3">
                            <h3>Update Book Self</h3>
                        </div>
                    </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row form-group">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                            <label for="book_name">Book Name</label>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                        	<select class="custom-select" id="book_name">
                        		<option value="" >Select</option>
                    			@foreach($getBookName as $eachData)
               					@if($eachData->book_category_id==$book_In_self->book_id)
                        		 <option value="{{$eachData->book_category_id}}" selected>{{$eachData->category_name}}</option>
                        		@else
                        		<option value="{{$eachData->book_category_id}}">{{$eachData->category_name}}</option>
                        		@endif
                        		@endforeach
                        	</select>  
                        	<input type="hidden" value="{{$book_In_self->book_self_id}}" id="hidden_id" name="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                            <label for="self_name">Self Name</label>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                            <select class="custom-select" id="self_name">
                        		<option value="" >Add Book Self</option>
               					@foreach($self as $eachData)
               					@if($eachData->library_self_id==$book_In_self->self_id)
                        		 <option value="{{$eachData->library_self_id}}" selected>{{$eachData->library_self_self_number}}</option>
                        		@else
                        		<option value="{{$eachData->library_self_id}}">{{$eachData->library_self_self_number}}</option>
                        		@endif
                        		@endforeach
                        	</select>  
                    	</div>
           			</div>
           			<div class="row form-group">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                            <label for="quantity">Quantity</label>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                            <input type="number" value="{{$book_In_self->quantity}}" class="form-control" id="quantity" name="quantity">
                    	</div>
           			</div>
            <div class="card-footer">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 nopadding">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                           <button type="submit" class="btn btn-success" onclick="insertBookInSalf()">Save</button>
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
        function insertBookInSalf(){
            var book_name=$("#book_name").val();
            var self_name=$("#self_name").val();
            var quantity=$("#quantity").val();
            var hidden_id=$("#hidden_id").val();
            $.ajax({
                url:"{{route('library.updateStore')}}",
                type:"POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                    book_name:book_name,
                    self_name:self_name,
                    quantity:quantity,
                    hidden_id:hidden_id
                },
                datatype:"json",
                success:function(data){
                    
                    var message='';
                        $('#message').html('<div class="alert alert-success" role="alert">'+data.message+'</div>');
                        $('#message').show(function () {
                        setTimeout(function(){$('#message').html('');},5000);});
                        window.location=('/school/library/book/Self');

                },
               error:function(data){
                    console.log(data);
                },
            });
        }
    </script>
@endsection
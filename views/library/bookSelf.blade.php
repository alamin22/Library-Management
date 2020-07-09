@extends('Layouts.library-index')
@section('title')
    Book Self
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
    	<div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 mt-3">
                        <h3>Book Self</h3>
                    </div>
                   <!--  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 m-t-10">
                        <a class="float-right one-back-button text-warning" data-toggle="modal" data-target="#bookSelf" id="add"><i class="fas fa-plus-circle fa-3x"></i></a>
                    </div> -->
                </div>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                            <label for="donator_name">Book Self</label>
                            <select class="custom-select" id="bookself">
                            	<option value="">Select Book Self</option>
                            	@foreach($self as $eachData)
                        		 <option value="{{$eachData->library_self_id
                                 }}">{{$eachData->library_self_self_number}}</option>
                        		@endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2" style="margin-top: 26px">
                            <button class="btn btn-primary" onclick="getBookSelf()"><i class="fas fa-search"></i>Search</button>
                        </div>
                         <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2" style="margin-top: 26px">
                                <a class="btn btn-brand" href="{{route('library.bookSelfPage')}}">Add Book Self</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <table class="table table-bordered text-center" id="table_id">

                    </table>
                </div>
            </div>
        </div>   
	</div>
    <script type="text/javascript">
    function getBookSelf(){
        var bookself=$("#bookself").val();
        $.ajax({
            url:"{{route('library.getBookSelfData')}}",
            type:"GET",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                bookself:bookself,
            },
            beforeSend:function(){
                    $('#table_id').html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
                },
            success:function(data){
            	console.log(data);
               var html='';
               var json_data=data.Data;
               var count=0;
            if(json_data.length>0){
                html+='<thead style="background-color:#f15922"><tr>';
                html+='<th>#</th>';
                html+='<th>Book Name</th>';
                html+='<th>Self Name</th>';
                html+='<th>Quantity</th>';
                html+='<th>Edit</th>';
                html+='<th>Delete</th>';
                html+='</tr></thead><tbody>';
                for(var i=0;i<json_data.length;i++){
                    count++;
                    var arrayData=json_data[i];
                    var id=arrayData.id;
                    html+='<tr id = "data_row_'+id+'">';
                    html+='<td>'+count+'</td>';
                    html+='<td><input type="hidden" id="form_sell_id" value="'+id+'" name="form_sell_id">'+arrayData.name+'</td>';
                    html+='<td>'+arrayData.self_name+'</td>';
                    html+='<td>'+arrayData.quantity+'</td>';
                    html+='<td><a href="/school/library/book/self/update/'+id+'" class="text-primary" style="margin-right:20px"><i class=" fas fa-edit"></i></a></td>';
                    html+='<td><a onclick="DeleteDonator('+id+')" id="delete_button" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>';
                    html+='</tr>';
                }
                html+='<tbody>';

                $("#table_id").html(html);
            }else{
                html+='<div class="alert alert-danger">No Data Found</div>';
                $("#table_id").html(html);
            }
               

            },
           error:function(data){
           	console.log(data);
            },
        });
    }
     function DeleteDonator(id) {
            ConfirmDialog('Are you sure you want to delete the selected record?',id);
        }
    
    function ConfirmDialog(message,id) {

        $('<div></div>').appendTo('body')
            .html('<div><h6>'+message+'?</h6></div>')
            .dialog({
                modal: true, title: 'Delete message', zIndex: 10000, autoOpen: true,
                width: 'auto', resizable: false,
                buttons: {
                    Yes: function () {
                        delete_donator(id);

                        $(this).dialog("close");
                    },
                    No: function () {
                        $(this).dialog("close");
                    }
                },
                open: function(event, ui) {
                    $('.ui-widget-overlay').css({ opacity: '.8' });
                },
                close: function (event, ui) {
                    $(this).remove();
                }
            });
    }
    
    function delete_donator(id){
       var id=id;
       console.log(id);
        $.ajax({
            method:'POST',
            url:"{{route('library.bookSelfDataDelete')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{id:id},
            dataType:"JSON",
            success:function(result){
                console.log(result);
                if(result['status'] == 'success') {
                    $("#data_row_"+id).remove();
                } else if(result['status'] == 'FAILED') {
                    console.log(result);
                }
            },
            error: function(data){
                console.log(data);
            },
        });
    }
</script>	
    
@endsection
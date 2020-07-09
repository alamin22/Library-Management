@extends('Layouts.library-index')
@section('title')
    Book Return
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
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card-header">
                    <h3>Book Return</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                <label for="issue_id">Issue Id</label>
                                <input type="text" class="form-control" id="issue_id" name="issue_id">
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                <label for="subject_code">Subject Code</label>
                                <input type="text" class="form-control" id="subject_code" name="subject_code">
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                <label for="writer">Title</label>
                                <input type="text" class="form-control" id="writer" name="writer">
                            </div>
                            <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2" style="margin-top: 26px">
                                <button class="btn btn-primary" onclick="getBookReturnData()"><i class="fas fa-search"></i>Search</button>
                            </div>
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

<!--     insert Modal -->
<div class="modal fade" id="bookReturnStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Book Return</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label>Return Date</label>
            <input type="date" value="{{date('Y-m-d')}}" class="form-control" id="return_date">
           <input type="hidden" id="set_id">
            <label>Quantity</label>
            <input type="text" class="form-control" id="return_quantity"><span class="error_message text-danger"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="returnBookStore()" class="btn btn-success">Save</button>
          </div>
        </div>
      </div>
    </div>

<!-- renew modal -->
    <div class="modal fade" id="bookRenew" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Book Renew</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label>Return Date</label>
            <input type="date" value="{{date('Y-m-d')}}" class="form-control" id="return_update_date">
            <input type="hidden" id="upate_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="bookRenew()" class="btn btn-success">Save</button>
          </div>
        </div>
      </div>
    </div>

    <!-- view return history modal -->
    <div class="modal fade" id="returnHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Book Return History</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="show_history">
                
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
     function getBookReturnData(){
        var issue_id=$("#issue_id").val();
        var subject_code=$("#subject_code").val();
        var writer=$("#writer").val();
        $.ajax({
            url:"{{route('library.getBookReturnData')}}",
            type:"GET",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                issue_id:issue_id,
                subject_code:subject_code,
                writer:writer,
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
                html+='<th>Book Title</th>';
                html+='<th>Issue Date</th>';
                html+='<th>Issue Quantity</th>';
                html+='<th>Return Quantity</th>';
                html+='<th>Return History</th>';
                html+='<th style="width:25%;">Action</th>';
                html+='</tr></thead><tbody>';
                for(var i=0;i<json_data.length;i++){
                   
                    var arrayData=json_data[i];
                    var id=arrayData.id;
                    
                    if(arrayData.issue_quantity != arrayData.return_quantity){
                         count++;
                        html+='<tr id = "data_row_'+id+'">';
                        html+='<td>'+count+'</td>';
                        html+='<td>'+arrayData.title+'</td>';
                        html+='<td>'+arrayData.issue_date+'</td>';
                        html+='<td>'+arrayData.issue_quantity+'<input type="hidden" id="issue_quantity" value="'+arrayData.issue_quantity+'"></td>';
                        html+='<td>'+arrayData.return_quantity+'</td>';
                        html+='<td><a class="btn btn-primary" onclick="seeReturnHistory('+arrayData.issue_id+')"><i class="fas fa-eye"></i></a></td>'; 
                        html+='<td><a class="btn btn-success" style="margin-right:20px" onclick="updateId('+id+')">Renew</a>&nbsp;<a onclick="getId('+id+')" class="btn btn-warning" style="margin-right:20px">Return</a></td>';
                        html+='</tr>';

                    }
                    html+='<tbody>';

                    $("#table_id").html(html);
                        }
                   
             
            }else{
                html+='<div class="alert alert-danger">No Data Found !</div>';
                $("#table_id").html(html);
            }
               

            },
           error:function(data){
            console.log(data);
            },
        });
    }

    function returnBookStore(){
        var return_date=$("#return_date").val();
        var return_quantity=$("#return_quantity").val();
        var issue_id=$("#set_id").val();

                $.ajax({
                    url:"{{route('library.bookReturnStore')}}",
                    type:"POST",
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{
                        'return_date':return_date,
                        'return_quantity':return_quantity,
                        'id':issue_id
                    },
                    datatype:"JSON",
                    success:function(data){
                        console.log(data);
                        if(data.status=="success"){
                            $("#bookReturnStore").modal('hide');
                            $(".error_message").html('');
                        
                        }
                        if(data.status=='error'){
                            $(".error_message").html(data.message);
                        }
                    },
                    error:function(data){
                        console.log(data);
                    }
                });
           
       
    }

    function getId(id){
        $("#bookReturnStore").modal('show');
        $("#set_id").val(id);
    }
    function updateId(id){
        $("#bookRenew").modal('show');
        $("#upate_id").val(id);
    }

    function bookRenew(){
        var update_date=$("#return_update_date").val();
        var upate_id=$("#upate_id").val();
        $.ajax({
            url:"{{route('library.bookRenew')}}",
            type:"POST",
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                'update_date':update_date,
                'upate_id':upate_id
            },
            datatype:"JSON",
            success:function(data){
                console.log(data);
                if(data.status=="success"){
                    $("#bookRenew").modal('hide');
                    window.location=("/school/library/book/Return");
                }
            },
            error:function(data){
                console.log(data);
            }
        });
    }

    function seeReturnHistory(issue_id){
        $("#returnHistory").modal('show');
         $.ajax({
            url:"{{route('library.bookReturnView')}}",
            type:"GET",
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                'issue_id':issue_id,
            },
            datatype:"JSON",
            success:function(data){
                console.log(data);
                var html='';
                var num=0;
                var view_json_data=data.viewData;
                if(view_json_data.length>0){
                    html+='<table class="table table-bordered text-center"><thead style="background-color:#f15922"><tr>';
                    html+='<th>#</th>';
                    html+='<th>Return Date</th>';
                    html+='<th>Quantity</th>';
                    html+='</tr></thead><tbody>';
                    for(var j=0;j<view_json_data.length;j++){
                        num++;
                        var array_data=view_json_data[j];
                        html+='<tr>';
                        html+='<td>'+num+'</td>';
                        html+='<td>'+array_data.return_date+'</td>';
                        html+='<td>'+array_data.return_quantity+'</td>';
                        html+='</tr>';
                        
                    }
                    html+='</tbody>';
                    html+='</table>';
                    $("#show_history").html(html);
                }else{
                    html+='<h3>No Data Available</h3>';
                    $("#show_history").html(html);
                }
         
            },
            error:function(data){
                console.log(data);
            }
        });

    }

</script>

@endsection
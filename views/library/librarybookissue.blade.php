@extends('Layouts.library-index')
@section('title')
    Library Book Issue
@endsection
@section('container')
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 m-t-10">
                                        <h3>Library Book Issue</h3>
                                        <input type="hidden" name="delete_id" id="delete_id">
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12 mt-3">
                                    <label>Title</label>
                                    <input type="text" name="" id="title" class="form-control">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12 mt-3">
                                    <label>Subject Code</label>
                                    <input type="text" name="" id="subject_code" class="form-control">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12 mt-3">
                                    <label>Publisher Name</label>
                                    <input type="text" placeholder="Publisher Name" name="" id="pub_name" class="form-control"> 
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12 col-12" style="margin-top: 39px">
                                    <button onclick="searchBookIssue();" class="btn btn-primary col-md-6">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="table-responsive mt-4" id="result">
                                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal -->
    <div class="modal fade" id="bookIssueModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Book Issue</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 col-xl-12">
                    <div class="row">
                        <label>Index Number</label>
                        <input type="text" name="" id="index_number" class="form-control">
                        <input type="hidden" class="form-control" id="book_id"> 
                    </div>
                     <div class="row">
                        <label>Issue Type</label>
                        <select id="issue_type_id" class="form-control">
                            <option value="">Select</option>
                            <option value="1">Student</option>
                            <option value="2">Teacher</option>
                        </select>
                    </div>
                    <div class="row">
                        <label>Issue Quantity</label>
                        <input type="text" name="" id="issue_quantity" class="form-control">
                        <span class="text-danger" id="error_msg"></span>  
                    </div>
                    <div class="row">
                        <label>Issue Date</label>
                        <input type="date" value="{{date('Y-m-d')}}" name="" id="issue_date" class="form-control">
                    </div>
                    <div class="row">
                        <label>Return Date</label>
                        <input type="date" value="{{date('Y-m-d')}}" name="" id="return_date" class="form-control">
                    </div>
                </div>
            </div>
            

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="bookIssueInsert()" class="btn btn-success">Save</button>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
    function searchBookIssue(){
        var title=$("#title").val();
        var subject_code=$("#subject_code").val();
        var pub_name=$("#pub_name").val();
        $.ajax({
            url:"{{route('library.searchBookIssue')}}",
            type:"GET",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                title:title,
                subject_code:subject_code,
                pub_name:pub_name
            },
            datatype:"JSON",
            beforeSend:function(){
                $('#result').html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
            },
            success:function(data){
                console.log(data);
                var html='';
                var count=0;
                var json_data=data.data;
                if(json_data.length>0){
                    html+='<table class="table table-bordered text-center">';
                    html+='<thead style="background:orangered">';
                    html+='<tr>';
                    html+='<th>#</th>';
                    html+='<th>Title</th>';
                    html+='<th>Category Name</th>';
                    html+='<th>Publisher Name</th>';
                    html+='<th>Available</th>';
                    html+='<th>Book Issue</th>';
                    html+='</tr>';
                    html+='</thead>';
                    html+='</tbody>';
                    for(var i=0;i<json_data.length;i++){
                        count++;
                        var data_element=json_data[i];
                        html+='<tr>';
                        html+='<td>'+count+'</td>';
                        html+='<td>'+data_element.title+'</td>';
                        html+='<td>'+data_element.category_name+'</td>';
                        html+='<td>'+data_element.publishers_name+'</td>';
                        html+='<td>'+data_element.entry_quantity+'</td>';
                        html+='<td class=""><i class="btn btn-success fas fa-bars" onclick="bookIssueModal('+data_element.id+')"></i></td>';
                        html+='</tr>';
                    }

                    $("#result").html(html);
                }
                else{
                    html+='<div class="alert alert-danger text-center">No Data Found !</div>';
                    $("#result").html(html);
                }
                
            },
            error:function(data){
                console.log(data);
            }
        });
    }

    function bookIssueModal(id){
        $("#bookIssueModal").modal('show');
        var book_id=$("#book_id").val(id);
    }

    function bookIssueInsert(){
        var book_id=$("#book_id").val();
        var index_number=$("#index_number").val();
        var issue_type_id=$("#issue_type_id").val();
        var issue_quantity=$("#issue_quantity").val();
        var issue_date=$("#issue_date").val();
        var return_date=$("#return_date").val();
        $.ajax({
            url:"{{route('library.bookIssueInsert')}}",
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                book_id:book_id,
                index_number:index_number,
                issue_type_id:issue_type_id,
                issue_quantity:issue_quantity,
                issue_date:issue_date,
                return_date:return_date,
            },
            datatype:"JSON",
            success:function(data){
                console.log(data);
                if(data.Status=='Success'){
                    $("#bookIssueModal").modal('hide');
                    $("#error_msg").html('');
                }
                if(data.error=='warning'){
                    $("#error_msg").html('Invalid Issue Number');
                }
            },
            error:function(data){
                console.log(data);
            }
        });
    }
</script>
       
@endsection

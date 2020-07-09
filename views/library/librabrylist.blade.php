@extends('Layouts.library-index')
@section('title')
    Librabry Book List
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
    <!-- ============================================================== -->
    <!-- end pageheader  -->
    <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 m-t-10">
                                        <h3>Librabry Book List</h3>
                                        <input type="hidden" name="delete_id" id="delete_id">
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                        <a href="{{route('school.bookManagemenAdd')}}" class="float-right one-back-button"><i class="fas fa-plus-circle fa-3x"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-3">
                                    <label>Title</label>
                                    <input type="text" name="" id="title" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-3 mt-3">
                                    <label>Subject Code</label>
                                    <input type="text" name="" id="subject_code" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-3 mt-3">
                                    <label>Publisher Name</label>
                                    <input type="text" placeholder="Search for Publisher" name="pub_name" id="pub_name" class="form-control">
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 mt-3">
                                    <br>
                                    <button onclick="searchLibraryBooks();" class="btn btn-primary"><i class="fas fa-search"></i>Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-4">
            <div id="show">

            </div>
        </div>

<!--     modal for book self -->

    <div class="modal fade" id="bookInSelf" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Book In Self</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label>Self Name</label>
            <select id="self_name" class="form-control">
                <option value="" >Select</option>
            </select>
            <input type="hidden" id="hidden_id" >
            <label>Quantity</label>
            <input type="number" class="form-control" id="quantity">
          </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="bookInSelf()" class="btn btn-success">Save</button>
            </div>
         </div>
      </div>
    </div>
<script type="text/javascript">
    function searchLibraryBooks(){
        var title=$('#title').val();
        var subject_code=$('#subject_code').val();
        var pub_name=$('#pub_name').val();
        $.ajax({
            method:"GET",
            url:"{{route('library.searchBookCategory')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                title:title,
                subject_code:subject_code,
                pub_name:pub_name
            },
            beforeSend:function(){
                $('#show').html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
            },
            success:function(data){
                console.log(data);
                var html='';
                var jsonData=data.data;
                var count=0;
                if(jsonData.length>0){
                    html+='<table class="table table-bordered text-center"><thead style="background-color:#f15922"><tr>';
                    html+='<th>#</th>';
                    html+='<th>Title</th>';
                    html+='<th>Subject Code</th>';
                    html+='<th>Category</th>';
                    html+='<th>Publisher</th>';
                    html+='<th>Volume Name</th>';
                    html+='<th>Entry Date</th>';
                    html+='<th>Book In Self</th>';
                    html+='<th>Edit</th>';
                    html+='<th>Delete</th>';
                    html+='</tr></thead><tbody>';

                    for(var i=0;i<jsonData.length;i++){
                        count++;
                        var arrayValue=jsonData[i];
                        html+='<tr id="value'+arrayValue.id+'">';
                        html+='<td>'+count+'</td>';
                        html+='<td>'+arrayValue.title+'</td>';
                        html+='<td>'+arrayValue.sub_code+'</td>';
                        html+='<td>'+arrayValue.category_name+'</td>';
                        html+='<td>'+arrayValue.publisher_name+'</td>';
                        html+='<td>'+arrayValue.volume_name+'</td>';
                        html+='<td>'+arrayValue.entry_date+'</td>';
                        html+='<td><a onclick="addBookSelf('+arrayValue.id+')" class="text-success"><i class="fas fa-plus-circle fa-2x"></i></a></td>';
                        html+='<td><a href="/school/library/bookLibraryEdit/'+arrayValue.id+'" class="text-primary"><i class="fas fa-edit"></i></a></td>';
                        html+='<td><a onclick="DeleteWriter('+arrayValue.id+')"><i class="fas fa-trash-alt"></i></a></td>';
                        html+='</tr>';
                    }
                    html+='</tbody></table>';

                    $("#show").html(html);
                }
                else{
                    html+='<div class="alert alert-danger text-center">No Data Found</div>';
                    $("#show").html(html);
                }
            },
            error:function(data){
                console.log(data);
            }
        });
    }

    function DeleteWriter(id){
            ConfirmDialog("Are you sure to delete this data",id);
        }
        function ConfirmDialog(message, id) {

            $('<div></div>').appendTo('body')
                .html('<div><h6>'+message+'?</h6></div>')
                .dialog({
                    modal: true, title:'Delete Message', zIndex: 10000, autoOpen: true,
                    width: 'auto', resizable: false,
                    buttons: {
                        Yes: function () {
                            delete_data(id);
                            $(this).dialog("close");
                        },
                        No: function () {
                            console.log("Confirm Dialog NO");
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
        function delete_data(id){
            $.ajax({
                method:'GET',
                url:"{{route('library.bookLibraryDelete')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{id:id},
                dataType:"JSON",
                success:function(result){
                    if(result['status'] == 'success') {
                        $("#value" + id).remove();
                        console.log("Success Delete");                    } 
                },
                error: function(data){
                    console.log(data);
                },
            });
        }

        function addBookSelf(book_id){
            $("#bookInSelf").modal('show');
            $("#hidden_id").val(book_id);
        }
</script>
    
@endsection

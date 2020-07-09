@extends('Layouts.library-index')
@section('title')
    Book Category List
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
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 m-t-10">
                                        <h3>Book Category List</h3>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                        <a class="float-right one-back-button text-warning " onclick="openModal()"><i class="fas fa-plus-circle fa-3x"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered text-center">
                                    <thead style="background-color:#f15922">
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label>Category Name</label>
            <input type="text" class="form-control" id="name">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="addCategory()">Save</button>
          </div>
        </div>
      </div>
    </div>

<script type="text/javascript">
    function openModal(){
        $("#addCategoryModal").modal("show");    
    }
    function addCategory(){
        var name=$("#name").val();
        $.ajax({
            url:"{{route('library.addCategory')}}",
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                name:name
            },
            datatype:"json",
            success:function(data){
                console.log(data);
                $("#addCategoryModal").modal("hide");
                location.reload();
            },
            error:function(data){
                console.log(data);
            }
        });
    } 
    $(document).ready(function(){
        getCategory();

    });
    function getCategory(){
        $.ajax({
            url:"{{route('library.getCategory')}}",
            type:"GET",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
            },
            datatype:"json",
            success:function(data){
                console.log(data);
                var html='';
                var count=0;
                var jsonData=data.data;
                if(jsonData.length>0){
                    for(var i=0;i<jsonData.length;i++){
                        count++;
                        var arrayData=jsonData[i];
                        html+='<tr id="category'+arrayData.book_category_id+'">';
                        html+='<td>'+count+'</td>';   
                        html+='<td>'+arrayData.category_name+'</td>'; 
                        html+='<td><a onclick="DeleteCategory('+arrayData.book_category_id+')"><i class="fa fa-trash-alt"></i><a></td>'; 
                        html+='</tr>';  
                    }
                    $("#tbody").html(html);     
                }
                else{
                    html+='<div class="alert alert-danger text-center">Data Not Fount</div>'; 
                    $("#tbody").html(html);  
                }
            
            },
            error:function(data){
                console.log(data);
            }
        });
    }

    function DeleteCategory(id){
            ConfirmDialog("Are you sure to delete this Category?",id);
        }
        function ConfirmDialog(message, id) {

            $('<div></div>').appendTo('body')
                .html('<div><h6>'+message+'?</h6></div>')
                .dialog({
                    modal: true, title: 'Delete success', zIndex: 10000, autoOpen: true,
                    width: 'auto', resizable: false,
                    buttons: {
                        Yes: function () {
                            delete_category(id);
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
        function delete_category(id){
            $.ajax({
                method:'post',
                url:"{{route('library.categorydelete')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{id:id},
                dataType:"JSON",
                success:function(result){
                    if(result['status'] == 'SUCCESS') {
                        $("#category" + id).remove();
                    }
                },
                error: function(data){
                    console.log(data);
                },
            });
        }
</script>

@endsection

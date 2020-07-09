@extends('Layouts.library-index')
@section('title')
Library Self
@endsection

@section('container')
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">

                <div class="row">
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 m-t-10">
                        <h3>Library Self</h3>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                        <a  onclick="showModal();" class="float-right one-back-button text-warning"><i class="fas fa-plus-circle fa-3x"></i></a>
                    </div>
                </div>

            </div>
            <div class="card-body" id="result">

            </div>
        </div>
    </div>


<!-- Add Modal -->
    <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Self</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label for="self_number">Self Name</label>
                                <input type="text" name="self_number" class="form-control" id="self_number">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="insertSelf()">Save</button>
                </div>
            </div>
        </div>
    </div>


<!-- edit Modal -->
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Self</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <input type="hidden" name="hihhen" id="hidden_id">
                                <label for="self_number">Self Number</label>
                                <input type="text" class="form-control" id="self">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="updateStore()">Save</button>
                </div>
            </div>
        </div>
    </div>



<script type="text/javascript">
    function showModal(){
        $("#add_modal").modal('show');
    }

    function insertSelf(){
        var self_number=$("#self_number").val();
        $.ajax({
            url:"{{route('library.LibrarySelfadd')}}",
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                self_number:self_number,
            },
            datatype:"json",
            success:function(data){
                
                $("#add_modal").modal('hide');

            },
           error:function(data){
                console.log(data);
            },
        });
    }

    $(document).ready(function () {
        getall();
       // location.reload();
    });

    function getall(){
        $.ajax({
            method:'get',
            url:"{{ route('library.LibrarySelfShow') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function (data) {

                var html='';
                html+='<table class="table table-bordered text-center"><thead style="background-color:#f15922"><tr><th>#</th><th>Self Number</th><th class="text-center">Add Self</th><th class="text-center">Edit</th><th class="text-center">Delete</th></tr></thead><tbody>';
                var json_data=data.data;
                var j=0;
                if (json_data.length >0){
                    for (var i = 0; i <json_data.length; i++) {
                        j++;
                        var arraydata=json_data[i];
                        html+='<tr id="self'+arraydata.library_self_id+'">';
                        html+='<td>'+j+'</td>';
                        html+='<td>'+arraydata.library_self_self_number+'</td>';
                        html+='<td class="text-center"><button class="btn btn-success" onclick="addSelf('+arraydata.library_self_id+');"><i class="fas fa-bars"></i></button></td>';
                        html+='<td class="text-center text-primary"><a onclick="edit('+arraydata.library_self_id+');"><i class="fas fa-edit"></i></a></td>';
                        html+='<td class="text-center"><a onclick="Deleteself('+arraydata.library_self_id+');"><i class="fas fa-trash-alt"></i></a></td>';
                        html+='</tr>';
                    }
                }else{

                    html+='<tr>';
                    html+='<td colspan="5"><div class="alert alert-danger" role="alert">Sorry No Data found!</div></td>';
                    html+='</tr>';
                }
                html+='</tbody></table>';
                $('#result').html(html);
            },
            error(data){
                console.log(data);
            }
        })
    }

    function edit(id) {
        $('#hidden_id').val(id);
        $("#edit_modal").modal('show');
    }

    function updateStore(){
        var hidden_id=$("#hidden_id").val();
        var self_number=$("#self").val();
        $.ajax({
            method:'post',
            url:"{{ route('library.LibrarySelfedit') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                hidden_id:hidden_id,
                self_number:self_number
            },
            datatype:'json',
            success:function (data) {

               $("#edit_modal").modal('hide');
            },
            error:function (error) {
                console.log(error)
            }
        });

    }


    function Deleteself(id){
        ConfirmDialog("Are you sure to delete this Self",id);
    }
    function ConfirmDialog(message, id) {

        $('<div></div>').appendTo('body')
            .html('<div><h6>'+message+'?</h6></div>')
            .dialog({
                modal: true, title: '{{__('notice.modaltitle')}}', zIndex: 10000, autoOpen: true,
                width: 'auto', resizable: false,
                buttons: {
                    Yes: function () {
                        delete_self(id);
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
    function delete_self(id){
        $.ajax({
            method:'post',
            url:"{{route('library.LibrarySelfdelete')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{id:id},
            dataType:"JSON",
            success:function(result){
                if(result['status'] == 'SUCCESS') {
                    console.log("Success Delete");
                    getall();
                } else if(result['status'] == 'FAILED') {

                }
            },
            error: function(data){
                console.log(data);
            },
        });
    }
    </script>
@endsection
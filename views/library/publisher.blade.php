@extends('Layouts.library-index')
@section('title')
    Book Publishers
@endsection

@section('container')
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 m-t-10">
                        <h3>Book Publishers</h3>
                    </div>
                </div>
            </div>
            <div class="card-header">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 nopadding">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                            <label for="writer_name">Publisher Name</label>
                            <input type="text" class="form-control" id="publisher_name">
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                            <label for="writer_name">Publisher Phone</label>
                            <input type="tel" class="form-control" id="publisher_phone">
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <button class="btn btn-primary mt-4" id="searchbtn"><i class="fas fa-search"></i>Search</button>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2" style="margin-top: 26px">
                            <a class="btn btn-brand" href="{{route('library.bookpublishersadd')}}">New Publisher</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" id="result">

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#searchbtn').click(function(){
            var name=$('#publisher_name').val();
            var phone=$('#publisher_phone').val();
            $.ajax({
                method:'post',
                url:"{{ route('library.bookpublisherssearch') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                    name:name,
                    phone:phone

                },
                beforeSend:function(){
                    $('#result').html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
                },
                success:function(data){
                    console.log(data);
                    var html='';
                    var json_data=data.Data;
                    var j=0;
                    if (json_data.length>0) {
                    html+='<table class="table table-bordered text-center"><thead style="background-color:#f15922"><tr><th>#</th><th>Name</th><th>Publisher Phone</th><th>Address</th><th class="text-center">Edit</th><th class="text-center">Delete</th></tr></thead><tbody>';
                    
                        for (var i = 0; i < json_data.length; i++) {
                            j++;
                            const element = json_data[i];

                            html+='<tr id="publisher'+element.book_publishers_id+'">';
                            html+='<td>'+j+'</td>';
                            html+='<td>'+element.book_publishers_name+'</td>';
                            html+='<td>'+element.book_publishers_phone_number+'</td>';
                            html+='<td>'+element.book_publishers_address+'</td>';
                            html+='<td class="text-center"><a class="edit" href="/school/library/book/publishers/edit/'+element.book_publishers_id+'"><i class="fas fa-edit"></i></a></td>';
                            html+='<td class="text-center"><a onclick="DeleteWriter('+element.book_publishers_id+')" ><i class="fas fa-trash-alt"></i></a></td>';
                            html+='</tr>';

                        }
                        html+='</tbody></table>';
                    }
                    else {
                         html+='<div class="alert alert-danger text-center">No Data Found</div>';
                        $("#result").html(html);
                    }

                    $('#result').html(html);
                },error:function(error){
                    console.log(error);
                }
            });
        });

        function DeleteWriter(id){
            ConfirmDialog("Are you sure to delete this Publisher",id);
        }
        function ConfirmDialog(message, id) {

            $('<div></div>').appendTo('body')
                .html('<div><h6>'+message+'?</h6></div>')
                .dialog({
                    modal: true, title: '{{__('notice.modaltitle')}}', zIndex: 10000, autoOpen: true,
                    width: 'auto', resizable: false,
                    buttons: {
                        Yes: function () {
                            delete_publisher(id);
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
        function delete_publisher(id){
            $.ajax({
                method:'post',
                url:"{{route('library.bookpublishersdelete')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{id:id},
                dataType:"JSON",
                success:function(result){
                    if(result['status'] == 'SUCCESS') {
                        $("#publisher" + id).remove();
                        console.log("Success Delete");
                        successfully_delete();
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

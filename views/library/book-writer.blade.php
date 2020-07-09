@extends('Layouts.library-index')
@section('title')
    Book Writers
@endsection

@section('container')
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 m-t-10">
                        <h3> Book Writers </h3>
                    </div>
                </div>
            </div>
                <div class="card-header">
            	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 nopadding">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <label for="writer_name">Writer Name</label>
                            <input type="text" class="form-control" id="writer_name">
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <button class="btn btn-primary mt-4" id="searchbtn"><i class="fas fa-search"></i>Search</button>
                        </div>
                         <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2" style="margin-top: 26px">
                            <a class="btn btn-brand" href="{{route('library.bookWriteradd')}}">New Writer</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" id="result">

            </div>
        </div>
    </div>
    
<script>
    $('#searchbtn').click(function(){
        var name=$('#writer_name').val();
        $.ajax({
            method:'GET',
            url:"{{ route('library.bookWritersearch') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                name:name
            },
            beforeSend:function(){
                $('#result').html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
            },
            success:function(data){
                console.log(data);
                var html='';
                var json_data=data.data;
                var j=0;
                if (json_data.length>0) {
                html+='<table class="table table-bordered text-center"><thead style="background-color:#f15922"><tr><th>#</th><th>Name</th><th>Working Place</th><th>Designation</th><th>Address</th><th class="text-center">Edit</th><th class="text-center">Delete</th></tr></thead><tbody>';
                
                    for (var i = 0; i < json_data.length; i++) {
                        j++;
                        const element = json_data[i];
                        html+='<tr id="write'+element.writer_id+'">';
                        html+='<td>'+j+'</td>';
                        html+='<td>'+element.write_name+'</td>';
                        html+='<td>'+element.writer_working_place+'</td>';
                        html+='<td>'+element.writer_designation+'</td>';
                        html+='<td>'+element.writer_address+'</td>';
                        html+='<td class="text-center"><a class="edit" href="/school/library/book/writer/edit/'+element.writer_id+'"><i class="fas fa-edit"></i></a></td>';
                        html+='<td class="text-center"><a onclick="DeleteWriter('+element.writer_id+')" ><i class="fas fa-trash-alt"></i></a></td>';
                        html+='</tr>';

                    }
                    html+='</tbody></table>';
                } else {
                    html+='<div class="alert alert-danger text-center" role="alert">No Data Found</div>';
                }

                $('#result').html(html);
            },error:function(error){
                console.log(error);
            }
        });
    });



    function DeleteWriter(id){
            ConfirmDialog("Are you sure to delete this Writer",id);
        }
        function ConfirmDialog(message, id) {

            $('<div></div>').appendTo('body')
                .html('<div><h6>'+message+'?</h6></div>')
                .dialog({
                    modal: true, title: '{{__('notice.modaltitle')}}', zIndex: 10000, autoOpen: true,
                    width: 'auto', resizable: false,
                    buttons: {
                        Yes: function () {
                            // $(obj).removeAttr('onclick');
                            // $(obj).parents('.Parent').remove();

                            //$('body').append('<h1>Confirm Dialog Result: <i>Yes</i></h1>');
                            //console.log("Confirm Dialog Result");
                            delete_Writer(id);

                            $(this).dialog("close");
                        },
                        No: function () {
                            //$('body').append('<h1>Confirm Dialog Result: <i>No</i></h1>');
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
        function delete_Writer(id){
            $.ajax({
                method:'post',
                url:"{{route('library.bookWriterdelete')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{id:id},
                dataType:"JSON",
                success:function(result){
                    if(result['status'] == 'SUCCESS') {
                        $("#write" + id).remove();
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

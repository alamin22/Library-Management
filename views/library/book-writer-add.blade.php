@extends('Layouts.library-index')
@section('title')
    Book Writer Add
@endsection

@section('container')
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">

                <div class="row">
                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-1 text-left">
                        <a href="{{ route('library.bookWriter') }}" class="float-left one-back-button"><i class="fas fa-arrow-circle-left fa-3x"></i></a>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 m-t-10">
                        <h3>Book Writer Add</h3>
                    </div>
                </div>

            </div>
                <div class="card-header">
            	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 nopadding">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label for="writer_name">Writer Name</label>
                            <input type="text" name="writer_name" id="writer_name" class="form-control">
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label for="Writer_address">Address</label>
                            <input type="text" name="Writer_address" id="Writer_address" class="form-control">
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label for="Working_Place">Working Place</label>
                            <input type="text" name="Working_Place" id="Working_Place" class="form-control">
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label for="writer_designation">Designation</label>
                            <input type="text" name="writer_designation" id="writer_designation" class="form-control">
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label for="writer_present_education_qualification">Education Qualification</label>
                            <input type="text" name="writer_present_education_qualification" id="writer_present_education_qualification" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 nopadding">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                           <button type="submit" class="btn btn-success" onclick="insertBookWrites()">Save</button>
                        </div>
                        <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                           <h5 id="message"></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function insertBookWrites(){
        var writer_name=$("#writer_name").val();
        var Writer_address=$("#Writer_address").val();
        var Working_Place=$("#Working_Place").val();
        var writer_designation=$("#writer_designation").val();
        var writer_present_education_qualification=$("#writer_present_education_qualification").val();
        $.ajax({
            url:"{{route('library.bookWriteradd')}}",
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                writer_name:writer_name,
                Writer_address:Writer_address,
                Working_Place:Working_Place,
                writer_designation:writer_designation,
                writer_present_education_qualification:writer_present_education_qualification
            },
            datatype:"json",
            success:function(data){
                console.log(data);
                var message='';
                    $('#message').html('<div class="alert alert-success" role="alert">'+data.message+'</div>');
                    $('#message').show(function () {
                    setTimeout(function(){$('#message').html('');},5000);});
                    window.location=('/school/library/book/writer');

            },
           error:function(data){
                console.log(data);
            },
        });
    }
</script>
@endsection

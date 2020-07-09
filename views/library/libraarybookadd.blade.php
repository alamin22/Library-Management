@extends('Layouts.library-index')
@section('title')
    Librabry Book Add
@endsection
@section('container')
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">

                <div class="row">
                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1 text-left">
                        <a href="{{ route('library.bookManagementList') }}" class="float-left one-back-button"><i class="fas fa-arrow-circle-left fa-3x"></i></a>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 m-t-10">
                        <h3>Librabry Book Add</h3>
                    </div>
                </div>
            </div>
            <div class="card-header">
            	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 nopadding">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label for="subject_code">Subject Code</label>
                            <input type="text" name="subject_code" id="subject_code" class="form-control">
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label for="publisher_id">Publisher Name</label>
                            <select class="form-control" name="publisher_id" id="publisher_id" >
                                <option value="0">Select</option>
                                @foreach($BookPublishers as $eachPublisher)
                                <option value="{{$eachPublisher->book_publishers_id}}">{{$eachPublisher->book_publishers_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label for="entry_date">Entry Date</label>
                            <input type="date" name="entry_date" id="entry_date" class="form-control" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label for="category_id">Category Name</label>
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="">Select</option>
                                @foreach($LibraryBookCategory as $eachLibraryBookCategory)
                                <option value="{{$eachLibraryBookCategory->book_category_id}}">{{$eachLibraryBookCategory->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label for="entry_quantity">Quantity</label>
                            <input type="text" name="entry_quantity" class="form-control" id="entry_quantity">
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label for="buy_donatation_id">Donor Name</label>
                            <select class="form-control" name="buy_donatation_id" id="buy_donatation_id">
                                <option value="0">Select</option>
                                @foreach($BookDonator as $eachBookDonator)
                                <option value="{{$eachBookDonator->book_donars_id}}">{{$eachBookDonator->book_donars_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label for="library_book_volume">Volume</label>
                            <input type="text" name="library_book_volume" id="library_book_volume" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
        <div class="card-footer">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 nopadding">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                       <button type="submit" class="btn btn-success" onclick="insertLibraryBooks()">Save</button>
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
    function insertLibraryBooks(){
        var title=$("#title").val();
        var subject_code=$("#subject_code").val();
        var publisher_id=$("#publisher_id").val();
        var entry_date=$("#entry_date").val();
        var category_id=$("#category_id").val();
        var entry_quantity=$("#entry_quantity").val();
        var buy_donatation_id=$("#buy_donatation_id").val();
        var library_book_volume=$("#library_book_volume").val();
        $.ajax({
            url:"{{route('school.bookManagemenAddStore')}}",
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                title:title,
                subject_code:subject_code,
                publisher_id:publisher_id,
                entry_date:entry_date,
                category_id:category_id,
                entry_quantity:entry_quantity,
                buy_donatation_id:buy_donatation_id,
                library_book_volume:library_book_volume
            },
            datatype:"json",
            success:function(data){
                console.log(data);
                var message='';
                    $('#message').html('<div class="alert alert-success" role="alert">'+data.message+'</div>');
                    $('#message').show(function () {
                    setTimeout(function(){$('#message').html('');},5000);});
                  //  window.location=('/school/library/book/publishers');

            },
           error:function(data){
                console.log(data);
            },
        });
    }
</script>
@endsection

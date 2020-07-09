@extends('Layouts.library-index')
@section('title')
    Book Issue History
@endsection

@section('container')
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 m-t-10">
                        <h3>Book Issue History</h3>
                    </div>
                </div>
            </div>
            <div class="card-body" id="result">

            </div>
        </div>
    </div>
 <script type="text/javascript">
 	$(document).ready(function(){
 		getAllData();
 	});
 	function getAllData(){
        $.ajax({
            method:"GET",
            url:"{{route('library.getData')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{

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
                    html+='<th>Index Number</th>';
                    html+='<th>Issue Date</th>';
                    html+='<th>Return Date</th>';
                    html+='</tr></thead><tbody>';

                    for(var i=0;i<jsonData.length;i++){
                        count++;
                        var arrayValue=jsonData[i];
                        html+='<tr id="value'+arrayValue.id+'">';
                        html+='<td>'+count+'</td>';
                        html+='<td>'+arrayValue.title+'</td>';
                        html+='<td>'+arrayValue.subject_code+'</td>';
                        html+='<td>'+arrayValue.user_index+'</td>';
                        html+='<td>'+arrayValue.issue_date+'</td>';
                        html+='<td>'+arrayValue.return_date+'</td>';
                        html+='</tr>';
                    }
                    html+='</tbody></table>';

                    $("#result").html(html);
                }
                else{
                    html+='<div class="alert alert-danger text-center">No Data Found</div>';
                    $("#result").html(html);
                }
            },
            error:function(data){
                console.log(data);
            }
        });
    }
 </script>
@endsection

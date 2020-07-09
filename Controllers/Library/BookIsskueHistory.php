<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\adminTable;
use App\model\LibraryBook;
use App\model\LibraryBookIssue;
use App\model\BookWriters;
use App\model\BookReturn;
use DB;

class BookIsskueHistory extends Controller
{
    public function index(Request $request){
    	try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            return view('library.bookIssueHistory')
                ->with('admin',$admins);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function getData(Request $request){
    	$sql="SELECT 
		    title,
		    subject_code,
		    issue_date,
		    return_date,
		    index_number
		FROM
		    librarymanagement.library_book
        LEFT JOIN
		    library_book_issu ON library_book_issu.issue_book_id = library_book.library_id;";
	    $getAllData=DB::select($sql);

	    $arratData=array();
	    foreach($getAllData as $eachData){
	    	$arratData[]=array(
	    		'title'=>$eachData->title,
	    		'subject_code'=>$eachData->subject_code,
	    		'user_index'=>$eachData->index_number,
	    		'issue_date'=>$eachData->issue_date,
	    		'return_date'=>$eachData->return_date,
	    	);
	    }
	    return response()->json(array('status'=>'success','data'=>$arratData));
    }

}

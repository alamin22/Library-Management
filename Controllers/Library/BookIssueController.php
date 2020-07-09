<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\adminTable;
use App\model\LibraryBookCategory;
use App\model\BookWriters;
use App\model\BookPublishers;
use App\model\LibraryBookIssue;
use App\model\LibraryBook;

class BookIssueController extends Controller
{
    public function bookIssueIndex(Request $request)
    {
    	try{

            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
			$datas =LibraryBookCategory::All();
            $bookWriters=BookWriters::All();
            $bookPublisher=BookPublishers::All();
            return view('library.librarybookissue')
                ->with('bookPublisher',$bookPublisher)
				->with('datas', $datas)
				->with('bookWriters', $bookWriters)
                ->with('admin',$admins);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function searchBookIssue(Request $request)
    {
    	$title=$request->title;
    	$subject_code=$request->subject_code;
    	$pub_name=$request->pub_name;
    	if(empty($title) && empty($subject_code) && empty($pub_name)){
    		$datas=LibraryBook::leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
    			->leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
    			->get();
    	}
    	else if(!empty($title) && empty($subject_code) && empty($pub_name)){
    		$datas=LibraryBook::leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
    			->leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
    			->where('title','LIKE','%'.$title.'%')
    			->get();
    	}
    	else if(empty($title) && !empty($subject_code) && empty($pub_name)){
    		$datas=LibraryBook::leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
    			->leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
    			->where('subject_code','LIKE','%'.$subject_code.'%')
    			->get();
    	}
    	else if(empty($title) && empty($subject_code) && !empty($pub_name)){
    		$datas=LibraryBook::leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
    			->leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
    			->where('book_publishers_name','LIKE','%'.$pub_name.'%')
    			->get();
    	}
    	else if(!empty($title) && !empty($subject_code) && empty($pub_name)){
    		$datas=LibraryBook::leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
    			->leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
    			->where('subject_code','LIKE','%'.$subject_code.'%')
    			->where('title','LIKE','%'.$title.'%')
    			->get();
    	}
    	else if(empty($title) && !empty($subject_code) && !empty($pub_name)){
    		$datas=LibraryBook::leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
    			->leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
    			->where('subject_code','LIKE','%'.$subject_code.'%')
    			->where('book_publishers_name','LIKE','%'.$pub_name.'%')
    			->get();
    	}
    	else if(!empty($title) && !empty($subject_code) && !empty($pub_name)){
    		$datas=LibraryBook::leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
    			->leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
    			->where('subject_code','LIKE','%'.$subject_code.'%')
    			->where('book_publishers_name','LIKE','%'.$pub_name.'%')
    			->where('title','LIKE','%'.$title.'%')
    			->get();
    	}
    	$data_array=array();
    	foreach($datas as $eachData){
    		$data_array[]=array(
    			'id'=>$eachData->library_id,
    			'title'=>$eachData->title,
    			'subject_code'=>$eachData->subject_code,
    			'entry_quantity'=>$eachData->entry_quantity,
    			'publishers_name'=>$eachData->book_publishers_name,
    			'category_name'=>$eachData->category_name,
    			'entry_date'=>$eachData->entry_date,
    		);
    	}
    	return response()->json(array(
    		'status'=>'success',
    		'data'=>$data_array,
    	));
    }


    public function bookIssueInsert(Request $request)
    {
    	try{
    		$book_id=$request->book_id;
	    	$index_number=$request->index_number;
	    	$issue_type_id=$request->issue_type_id;
	    	$issue_quantity=$request->issue_quantity;
	    	$issue_date=$request->issue_date;
	    	$return_date=$request->return_date;
	    	$getQuantity=LibraryBook::where('library_id','=',$book_id)
	    		->first();
	    		if($getQuantity->entry_quantity>=$issue_quantity){
	    			$data=new LibraryBookIssue();
			    	$data->index_number=$index_number;
			    	$data->issue_book_id=$book_id;
			    	$data->issue_type_id=$issue_type_id;
			    	$data->issue_quantity=$issue_quantity;
			    	$data->issue_date=$issue_date;
			    	$data->return_date=$return_date;
			    	$data->save();
			    	return response()->json(array('Status'=>'Success'));
	    		}else{
	    			return response()->json(array('error'=>'warning'));
	    		}
	    	
    	}
    	catch(Exception $e){
    		return $e->getMessage();
    	}
    	
 
    }
}

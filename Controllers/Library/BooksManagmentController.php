<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\adminTable;
use App\model\LibraryBook;
use App\model\BookPublishers;
use App\model\LibraryBookCategory;
use App\model\BookDonator;

class BooksManagmentController extends Controller
{
    public function bookManagementList(Request $request)
    {
    	try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            return view('library.librabrylist')	
                ->with('admin',$admins);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function bookManagemenAdd(Request $request)
    {
    	try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            $BookDonator=BookDonator::All();
            $BookPublishers=BookPublishers::All();
            $LibraryBookCategory=LibraryBookCategory::All();

            return view('library.libraarybookadd')
                ->with('LibraryBookCategory',$LibraryBookCategory)
                ->with('BookPublishers',$BookPublishers)
                ->with('BookDonator',$BookDonator)
                ->with('admin',$admins);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function bookManagemenAddStore(Request $request)
    {
    	try{
    		$data=new LibraryBook();
	    	$data->title=$request->title;
	    	$data->subject_code=$request->subject_code;
	    	$data->publisher_id=$request->publisher_id;
	    	$data->entry_date=$request->entry_date;
	    	$data->category_id=$request->category_id;
	    	$data->entry_quantity=$request->entry_quantity;
	    	$data->buy_donatation_id=$request->buy_donatation_id;
	    	$data->library_book_volume=$request->library_book_volume;
	    	$data->save();

	    	return response()->json(array('message'=>'Data Save Successfully'));
	    	
    	}
    	catch(Exception $e){
    		return $e->getMessage();
    	}	
    }
    public function searchBookCategory(Request $request)
    {
        $title=$request->title;
        $subject_code=$request->subject_code;
        $pub_name=$request->pub_name;
        if(empty($title) && empty($subject_code) && empty($pub_name))
        {
            $datas=LibraryBook::leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
                ->leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
                ->get();
        }
        else if(!empty($title) && empty($subject_code) && empty($pub_name))
        {
            $datas=LibraryBook::leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
                ->leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
                ->where('library_book.title','LIKE','%'.$title.'%')
                ->get();
        }
        else if(empty($title) && !empty($subject_code) && empty($pub_name))
        {
            $datas=LibraryBook::leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
                ->leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
                ->where('library_book.subject_code','LIKE','%'.$subject_code.'%')
                ->get();
        }
        else if(empty($title) && empty($subject_code) && !empty($pub_name))
        {
            $datas=LibraryBook::leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
                ->leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
                ->where('library_book_publishers.book_publishers_name','LIKE','%'.$pub_name.'%')
                ->get();
        }
        else if(!empty($title) && !empty($subject_code) && empty($pub_name))
        {
            $datas=LibraryBook::leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
                ->leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
                ->where('library_book.title','LIKE','%'.$title.'%')
                ->where('library_book.subject_code','LIKE','%'.$subject_code.'%')
                ->get();
        }
        else if(empty($title) && !empty($subject_code) && !empty($pub_name))
        {
            $datas=LibraryBook::leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
                ->leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
                ->where('library_book.subject_code','LIKE','%'.$subject_code.'%')
                ->where('library_book_publishers.book_publishers_name','LIKE','%'.$pub_name.'%')
                ->get();
        }
        else if(!empty($title) && !empty($subject_code) && !empty($pub_name))
        {
            $datas=LibraryBook::leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
                ->leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
                ->where('library_book.title','LIKE','%'.$title.'%')
                ->where('library_book.subject_code','LIKE','%'.$subject_code.'%')
                ->where('library_book_publishers.book_publishers_name','LIKE','%'.$pub_name.'%')
                ->get();
        }
        $arrayData=array();
        foreach($datas as $eachData){
            $arrayData[]=array(
                'id'=>$eachData->library_id,
                'title'=>$eachData->title,
                'sub_code'=>$eachData->subject_code,
                'publisher_name'=>$eachData->book_publishers_name,
                'entry_date'=>$eachData->entry_date,
                'category_name'=>$eachData->category_name,
                'volume_name'=>$eachData->library_book_volume
            );
        }
        return response()->json(array('status'=>'success','data'=>$arrayData));
    }

    public function bookLibraryDelete(Request $request){
        $id=$request->id;
        LibraryBook::find($id)->delete();
        return response()->json(array('status'=>'success'));
    }

    public function bookLibraryEdit(Request $request,$id)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            $datas=LibraryBook::leftjoin('library_book_publishers','library_book_publishers.book_publishers_id','library_book.publisher_id')
                ->leftjoin('library_book_category','library_book_category.book_category_id','library_book.category_id')
                ->leftjoin('library_book_donars','library_book_donars.book_donars_id','library_book.buy_donatation_id')
                ->where('library_book.library_id','=',$id)
                ->first();
            $BookDonator=BookDonator::All();
            $BookPublishers=BookPublishers::All();
            $LibraryBookCategory=LibraryBookCategory::All();

            return view('library.librarybookedit')
                ->with('LibraryBookCategory',$LibraryBookCategory)
                ->with('BookPublishers',$BookPublishers)
                ->with('BookDonator',$BookDonator)
                ->with('data',$datas)
                ->with('admin',$admins);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function bookLibraryUpdate(Request $request)
    {
        $id=$request->hidden_id;
        try{
            $data=LibraryBook::find($id);
            $data->title=$request->title;
            $data->subject_code=$request->subject_code;
            $data->publisher_id=$request->publisher_id;
            $data->entry_date=$request->entry_date;
            $data->category_id=$request->category_id;
            $data->entry_quantity=$request->entry_quantity;
            $data->buy_donatation_id=$request->buy_donatation_id;
            $data->library_book_volume=$request->library_book_volume;
            $data->save();

            return response()->json(array('message'=>'Data Updated Successfully'));

        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
    
}

<?php

namespace App\Http\Controllers\Library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\adminTable;
use App\model\LibraryBookIssue;
use App\model\BookDonator;
use App\model\BookReturn;
use DB;

class bookReturnController extends Controller
{
   public function index(Request $request)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))
            	->first();
            return view('library.bookReturn')
	            ->with('admin',$admins);
        }catch(Exception $e){
                return $e->getMessage();
        }
    }
    public function getBookReturnData(Request $request){
   		    $issue_id=$request->issue_id;
			$subject_code=$request->subject_code;
			$writer=$request->writer;
   			$admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            if(empty($issue_id) && empty($subject_code) && empty($writer)){
                $sql="
                    SELECT 
                        *
                    FROM
                        library_book_issu
                            LEFT JOIN
                        library_book ON library_book_issu.issue_book_id = library_book.library_id
                            LEFT JOIN
                        library_book_return ON library_book_return.book_issu_id = library_book_issu.library_book_issu_id
                        ;
                ";
                $book_return=DB::select($sql);
            }
            else if(!empty($issue_id) && empty($subject_code) && empty($writer)){
                $sql="
                    SELECT 
                        *
                    FROM
                        library_book_issu
                            LEFT JOIN
                        library_book ON library_book_issu.issue_book_id = library_book.library_id
                            LEFT JOIN
                        library_book_return ON library_book_return.book_issu_id = library_book_issu.library_book_issu_id
                        where
                           library_book_issu_id=".$issue_id." 
                        ;
                ";
                $book_return=DB::select($sql);
            }
            else if(empty($issue_id) && !empty($subject_code) && empty($writer)){
                 $sql="
                    SELECT 
                        *
                    FROM
                        library_book_issu
                            LEFT JOIN
                        library_book ON library_book_issu.issue_book_id = library_book.library_id
                            LEFT JOIN
                        library_book_return ON library_book_return.book_issu_id = library_book_issu.library_book_issu_id
                        where
                           subject_code=".$subject_code." 
                        ;
                ";
                $book_return=DB::select($sql);
            }else if(empty($issue_id) && empty($subject_code) && !empty($writer)){
                $sql="
                    SELECT 
                        *
                    FROM
                        library_book_issu
                            LEFT JOIN
                        library_book ON library_book_issu.issue_book_id = library_book.library_id
                            LEFT JOIN
                        library_book_return ON library_book_return.book_issu_id = library_book_issu.library_book_issu_id
                        where
                           title LIKE'%$writer%' 
                        ;
                ";
                $book_return=DB::select($sql);
            }else if(!empty($issue_id) && !empty($subject_code) && empty($writer)){
                 $sql="
                    SELECT 
                        *
                    FROM
                        library_book_issu
                            LEFT JOIN
                        library_book ON library_book_issu.issue_book_id = library_book.library_id
                            LEFT JOIN
                        library_book_return ON library_book_return.book_issu_id = library_book_issu.library_book_issu_id
                        where
                           library_book_issu_id=".$issue_id."
                           AND
                           subject_code=".$subject_code."
                        ;
                ";
                $book_return=DB::select($sql);
            }else if(empty($issue_id) && !empty($subject_code) && !empty($writer)){
                $sql="
                    SELECT 
                        *
                    FROM
                        library_book_issu
                            LEFT JOIN
                        library_book ON library_book_issu.issue_book_id = library_book.library_id
                            LEFT JOIN
                        library_book_return ON library_book_return.book_issu_id = library_book_issu.library_book_issu_id
                        where
                           subject_code=".$subject_code."
                           AND
                           title LIKE'%$writer%'
                        ;
                ";
                $book_return=DB::select($sql);
            }else if(!empty($issue_id) && !empty($subject_code) && !empty($writer)){
                $sql="
                    SELECT 
                        *
                    FROM
                        library_book_issu
                            LEFT JOIN
                        library_book ON library_book_issu.issue_book_id = library_book.library_id
                            LEFT JOIN
                        library_book_return ON library_book_return.book_issu_id = library_book_issu.library_book_issu_id
                        where
                           library_book_issu_id=".$issue_id." 
                           AND
                           subject_code=".$subject_code."
                           AND
                           title LIKE'%$writer%'
                        ;
                ";
                $book_return=DB::select($sql);
            }
            

            $data_rocord=array();
            foreach($book_return as $each_data){
            	$data_rocord[]=array(
            		'id'=>$each_data->library_book_issu_id,
            		'title'=>$each_data->title,
            		'issue_date'=>$each_data->issue_date,
            		'return_date'=>$each_data->return_date,
                    'issue_id'=>$each_data->library_book_issu_id,
                    'issue_quantity'=>$each_data->issue_quantity,
                    'return_quantity'=>$each_data->quantity,
                    //'return_quantity'=>$each_data->total_return,
            	);
            }
            return response()->json(array('status'=>'success','Data'=>$data_rocord));
   } 

   public function bookReturnView(Request $request)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))
                ->first();
             $sql="
                    SELECT 
                        *
                    FROM
                        library_book_issu
                            LEFT JOIN
                        library_book ON library_book_issu.issue_book_id = library_book.library_id
                            LEFT JOIN
                        library_book_return ON library_book_return.book_issu_id = library_book_issu.library_book_issu_id
                        ;
                ";
            $book_return=DB::select($sql);
            $data_view_record=array();
            foreach($book_return as $each_data){
                $data_view_record[]=array(
                    'id'=>$each_data->library_book_issu_id,
                    'title'=>$each_data->title,
                    'issue_date'=>$each_data->issue_date,
                    'return_date'=>$each_data->return_date,
                    'issue_id'=>$each_data->library_book_issu_id,
                    'issue_quantity'=>$each_data->issue_quantity,
                    'return_quantity'=>$each_data->quantity,
                );
            }

            return response()->json(array('status'=>'success','viewData'=>$data_view_record));
        }catch(Exception $e){
                return $e->getMessage();
        }
    } 

    public function bookReturnStore(Request $request)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))
                ->first();
            $return_quantity=$request->return_quantity;
            $return_date=$request->return_date;
            $id=$request->id;
            $returnQuantityTotal=BookReturn::where('book_issu_id','=',$id)
                ->sum('quantity');
            $total=$returnQuantityTotal+$return_quantity;
            $book_issue_id=LibraryBookIssue::where('library_book_issu_id','=',$id)
                ->first();
            if($book_issue_id->issue_quantity>=$total){
                $data=new BookReturn();
                $data->quantity=$return_quantity;
                $data->return_date=$return_date;
                $data->book_issu_id=$id;
                $data->save();
                return response()->json(array('status'=>'success','message'=>'Data Save Successfully')); 
            }
            else{
                return response()->json(array('status'=>'error','message'=>'Invalid Return Quantity !')); 
            }  
        }
        catch(Exception $e){
                return $e->getMessage();
        }
    } 
    public function bookRenew(Request $request)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))
                ->first();
            $update_date=$request->update_date;
            $upate_id=$request->upate_id;
           	$data=LibraryBookIssue::find($upate_id);
           	$data->return_date=$update_date;
           	$data->save();
           	return response()->json(array('status'=>'success','message'=>'Data Save Successfully'));
        }
        catch(Exception $e){
                return $e->getMessage();
        }
    }

}

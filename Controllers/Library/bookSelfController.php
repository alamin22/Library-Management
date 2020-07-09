<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\adminTable;
use App\model\LibrarySelf;
use App\model\LibraryBookCategory;
use App\model\BookSelf;
use DB;

class bookSelfController extends Controller
{

    public function index(Request $request)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            $self = LibrarySelf::All();
            return view('library.bookSelf')
            ->with('self',$self)
            ->with('admin',$admins);
        }
        catch(Exception $e){
                return $e->getMessage();
        }
    }
    public function bookSelfPage(Request $request)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
          
            $getBookName=LibraryBookCategory::All();
            $self = LibrarySelf::All();

            return view('library.addBookInSelf')
            ->with('datas',$getBookName)
            ->with('self',$self)
            ->with('admin',$admins);
        }catch(Exception $e){
                return $e->getMessage();
        }
    }

    public function bookSelfStore(Request $request)
    {
        try{
            $book_name=$request->book_name;
            $self_name=$request->self_name;
            $quantity=$request->quantity;
           	$data=new BookSelf();
           	$data->book_id=$book_name;
           	$data->self_id=$self_name;
           	$data->quantity=$quantity;
           	$data->save();

           	return response()->json(array('status'=>'success','message'=>'Data Save Successfully'));
        }
        catch(Exception $e){
                return $e->getMessage();
        }
    }

    public function getBookSelfData(Request $request){
   		    $bookself=$request->bookself;

            if(empty($bookself)){
            	// $getbookself=BookSelf::leftjoin('edumaster_library_self','edumaster_library_self.library_self_id','=','edumaster_library_book_self.self_id')
            	// ->leftjoin('edumaster_library_book_category','edumaster_library_book_category.parent_id','=','edumaster_library_self.library_self_parent_id')
             //    ->where('book_self_school_id','=',$school->school_admin_school_id)
            	// ->where('book_self_is_deleted','=',0)
            	// ->get();

                $sql="
                SELECT 
                    book_self_id,
                    category_name,
                    library_self_self_number,
                    quantity
                FROM
                    library_book_self
                        LEFT JOIN
                    library_self ON library_book_self.self_id = library_self.library_self_id
                left join
                library_book_category on library_book_category.book_category_id=library_book_self.book_id    
                ";
                $getbookself=DB::select($sql);

            }
            else if(!empty($bookself)){
            	$getbookself=BookSelf::leftjoin('library_self','library_self.library_self_id','=','library_book_self.self_id')
            	->leftjoin('library_book_category','library_book_category.book_category_id','=','library_book_self.book_id')
            	->where('self_id','=',$bookself)
            	->get();
            }
            
            
            $data_rocord=array();
            foreach($getbookself as $each_data){
            	$data_rocord[]=array(
            		'id'=>$each_data->book_self_id,
            		'name'=>$each_data->category_name,
            		'self_name'=>$each_data->library_self_self_number,
            		'quantity'=>$each_data->quantity
            	);
            }
            return response()->json(array('status'=>'success','Data'=>$data_rocord,'myData'=>$bookself));
   }

    public function bookSelfDataDelete(Request $request){
		try 
		{
			$id=$request->id;
			BookSelf::where('book_self_id', $id)->delete();
			return response()->json(array('status'=>'success'));
		} 
		catch(Exception $e) {
			return response()->json(array('status'=>'FAILED'));
		}

	}
	
	public function updateValue(Request $request,$id)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            $book_In_self=BookSelf::where('book_self_id','=',$id)
            	->first();
            $self = LibrarySelf::All();

            $getBookName=LibraryBookCategory::All();

            return view('library.bookSelf-Edit')
            ->with('book_In_self',$book_In_self)
            ->with('self',$self)
            ->with('getBookName',$getBookName)
            ->with('admin',$admins);
        }catch(Exception $e){
                return $e->getMessage();
        }
    } 

    public function updateStore(Request $request)
    {
        try{
            $book_name=$request->book_name;
            $self_name=$request->self_name;
            $quantity=$request->quantity;
            $hidden_id=$request->hidden_id;
           	$data=BookSelf::find($hidden_id);
           	$data->book_id=$book_name;
           	$data->self_id=$self_name;
           	$data->quantity=$quantity;
           	$data->save();

           	return response()->json(array('status'=>'success','message'=>'Data Updated Successfully'));
        }
        catch(Exception $e){
                return $e->getMessage();
        }
    }

}

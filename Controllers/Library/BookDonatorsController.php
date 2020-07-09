<?php

namespace App\Http\Controllers\Library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\BookDonator;
use App\model\adminTable;

class BookDonatorsController extends Controller
{
    public function index(Request $request)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            return view('library.bookDonators')
            ->with('admin',$admins);
        }catch(Exception $e){
                return $e->getMeassage();
        }
    } 
    public function addDonators(Request $request)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            return view('library.addBookDonators')
            ->with('admin',$admins);
        }catch(Exception $e){
                return $e->getMeassage();
        }
    }
    public function addDonatorsStore(Request $request)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            $donator_name=$request->donator_name;
            $donator_phone=$request->donator_phone;
            $address=$request->address;
           	$data=new BookDonator();
           	$data->book_donars_name=$donator_name;
           	$data->book_donars_mobile=$donator_phone;
           	$data->book_donars_address=$address;
           	$data->save();

           	return response()->json(array('status'=>'success','message'=>'Data Save Successfully'));
        }catch(Exception $e){
                return $e->getMeassage();
        }
    }

    public function getDonatorsData(Request $request){
   		    $donator_name=$request->donator_name;
			$phone_number=$request->phone_number;
   			$admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            if(empty($donator_name) && empty($phone_number)){
            	$book_donators=BookDonator::All();
            }
            else if(!empty($donator_name) && empty($phone_number)){
            	$book_donators=BookDonator::where('book_donars_name','LIKE','%'.$donator_name.'%')
            	->get();
            } else if(empty($donator_name) && !empty($phone_number)){
            	$book_donators=BookDonator::where('book_donars_mobile','LIKE','%'.$phone_number.'%')
            	->get();
            }
            else if(!empty($donator_name) && !empty($phone_number)){
            	$book_donators=BookDonator::where('book_donars_name','LIKE','%'.$donator_name.'%')
            	->where('book_donars_mobile','LIKE','%'.$phone_number.'%')
            	->get();
            }
            
            $data_rocord=array();
            foreach($book_donators as $each_data){
            	$data_rocord[]=array(
            		'id'=>$each_data->book_donars_id,
            		'name'=>$each_data->book_donars_name,
            		'phone_number'=>$each_data->book_donars_mobile,
            		'address'=>$each_data->book_donars_address
            	);
            }
            return response()->json(array('status'=>'success','Data'=>$data_rocord));
    }
   
   public function donatorsDelete(Request $request){
		try {
				$id=$request->id;
				BookDonator::where('book_donars_id', $id)->delete();
				return response()->json(array('status'=>'success'));
			} catch(Exception $e) {
				return response()->json(array('status'=>'FAILED'));
			}

	}

	public function updateValue(Request $request,$id)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            $book_donators=BookDonator::where('book_donars_id','=',$id)
            	->first();
            return view('Library.book-donatorsEdit')
            ->with('book_donators',$book_donators)
            ->with('admin',$admins);
        }catch(Exception $e){
                return $e->getMessage();
        }
    } 
    
    public function updateDonatorsStore(Request $request)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            $donator_name=$request->donator_name;
            $donator_phone=$request->donator_phone;
            $address=$request->address;
            $hidden_id=$request->hidden_id;
           	$data=BookDonator::find($hidden_id);
           	$data->book_donars_name=$donator_name;
           	$data->book_donars_mobile=$donator_phone;
           	$data->book_donars_address=$address;
           	$data->save();

           	return response()->json(array('status'=>'success','message'=>'Data Updated Successfully'));
        }catch(Exception $e){
                return $e->getMessage();
        }
    }
    
}

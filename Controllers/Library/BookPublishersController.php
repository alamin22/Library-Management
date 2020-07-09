<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\adminTable;
use App\model\BookPublishers;

class BookPublishersController extends Controller
{
    public function index(Request $request)
    {
        try {
            $admins = adminTable::where('admin_id', $request->session()->get('adminLogin'))->first();
            return view('library.publisher')
                ->with('admin', $admins);
        }catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function add(Request $request)
    {
        try {
            $admins = adminTable::where('admin_id', $request->session()->get('adminLogin'))->first();
            return view('library.publisheradd')
                ->with('admin', $admins);

        } catch (Exception $e) {
            return $e->getMessage();
        }


    }
    public function store(Request $request)
    {
        try{
            $data=new BookPublishers();
            $data->book_publishers_name=$request->name;
            $data->book_publishers_address=$request->address;
            $data->book_publishers_phone_number=$request->phone_number;
            $data->save();
            return response()->json(array('status'=>'success','message'=>'Data Save Successfully')); 
        }catch(Exception $e){
            return $e->getMessage();
        }   

    }
    public function search(Request $request)
    {
        $name=$request->name;
        $phone=$request->phone;
        $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
        if(empty($name) && empty($phone)){
            $book_publisher=BookPublishers::All();
        }
        else if(!empty($name) && empty($phone)){
            $book_publisher=BookPublishers::where('book_publishers_name','LIKE','%'.$name.'%')
            ->get();
        } else if(empty($name) && !empty($phone)){
            $book_publisher=BookPublishers::where('book_publishers_phone_number','LIKE','%'.$phone.'%')
            ->get();
        }
        else if(!empty($name) && !empty($phone)){
            $book_publisher=BookPublishers::where('book_publishers_name','LIKE','%'.$name.'%')
            ->where('book_publishers_phone_number','LIKE','%'.$phone.'%')
            ->get();
        }
        
        $data_rocord=array();
        foreach($book_publisher as $each_data){
            $data_rocord[]=array(
                'book_publishers_id'=>$each_data->book_publishers_id,
                'book_publishers_name'=>$each_data->book_publishers_name,
                'book_publishers_phone_number'=>$each_data->book_publishers_phone_number,
                'book_publishers_address'=>$each_data->book_publishers_address
            );
        }
        return response()->json(array('status'=>'success','Data'=>$data_rocord));
    }
    public function delete(Request $request)
    {
        $id=$request->id;
        BookPublishers::where('book_publishers_id','=',$id)->delete();
        return response()->json(array('status'=>'SUCCESS'));
    }


    public function edit(Request $request,$id)
    {
        try {
            $id=$request->id;
            $data=BookPublishers::find($id);
            $admins = adminTable::where('admin_id', $request->session()->get('adminLogin'))->first();
            return view('library.publisheredit')
                ->with('data', $data)
                ->with('admin', $admins);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        
    }

    public function update(Request $request)
    {
        $data=BookPublishers::find($request->hidden_id);
        $data->book_publishers_name=$request->name;
        $data->book_publishers_address=$request->address;
        $data->book_publishers_phone_number=$request->phone_number;
        $data->save();
        return response()->json(array('status'=>'success','message'=>'Data Updated Successfully')); 
    }

}

<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\BookWriters;
use App\model\adminTable;
use Exception;
use DB;

class BookWriterController extends Controller
{
    public function index(Request $request)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            return view('library.book-writer')
            ->with('admin',$admins);
        }
        catch(Exception $e){
            return $e->getMessage();
        }

    }
    public function add(Request $request)
    {
        try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            return view('library.book-writer-add')
            ->with('admin',$admins);
        }
        catch(Exception $e){
                return $e->getMessage();
        }

    }

    public function store(Request $request)
    {
    	try{
    		$data=new BookWriters();
		    $data->write_name=$request->writer_name;
		    $data->writer_address=$request->Writer_address;
		    $data->writer_working_place=$request->Working_Place;
		    $data->writer_designation=$request->writer_designation;
		    $data->writer_present_education_qualification=$request->writer_present_education_qualification;
		    $data->save();
		    return response()->json(array('message'=>'Data Save Successfully'));
    	}
    	catch(Exception $e){
    		return $e->getMessage();
    	}
    }

    public function search(Request $request)
    {
    	$name=$request->name;
    	if(empty($name)){
        $data=BookWriters::All();	
    	}else{
        $data=BookWriters::where('write_name','LIKE','%'.$name.'%')->get();
    	}
        return response()->json(array('status'=>'Success','data'=>$data));
    }

    public function edit(Request $request,$id)
    {
        $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
        $data=BookWriters::find($id);
        return view('library.book-writer-edit')
        ->with('data',$data)
        ->with('admin',$admins);

    }
    public function delete(Request $request)
    {
        $id=$request->id;
        BookWriters::where('writer_id','=',$id)->delete();
        return response()->json(array('status'=>'SUCCESS'));

    }

    public function update(Request $request)
    {
    	try{
    		$data=BookWriters::find($request->hidden_id);
	        $data->write_name=$request->writer_name;
	        $data->writer_address=$request->Writer_address;
	        $data->writer_working_place=$request->Working_Place;
	        $data->writer_designation=$request->writer_designation;
	        $data->writer_present_education_qualification=$request->writer_present_education_qualification;
	        $data->save();
	        return response()->json(array('message'=>'Data Updated Successfully'));
    	}
    	catch(Exception $e){
    		return $e->getMessage();
    	}
       

    }

}

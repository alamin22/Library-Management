<?php

namespace App\Http\Controllers\Library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\model\LibraryBookCategory;
use App\model\adminTable;

class BooksCategoryController extends Controller
{
    public function bookCategoryIndex(Request $request)
    {
    	try{
            $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            return view('library.bookcatogorylist')
                ->with('admin',$admins);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function addCategory(Request $request){
    	try{
    		$name=$request->name;
    		$data=new LibraryBookCategory();
    		$data->category_name=$name;
    		$data->save();
    		return response()->json(array('statud'=>'success','message'=>'Data Save Successfully'));
    	}catch(Exception $e){
    		return $e->getMessage();
    	}
    }
    public function getCategory(Request $request){
    	try{
    		$data=LibraryBookCategory::All();
    		return response()->json(array('statud'=>'success','data'=>$data));
    	}
    	catch(Exception $e){
    		return $e->getMessage();
    	}
    }
    public function delete(Request $request)
    {
        $id=$request->id;
        LibraryBookCategory::where('book_category_id','=',$id)->delete();
        return response()->json(array('status'=>'SUCCESS'));
    }

}

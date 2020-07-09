<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Exception;
use App\model\adminTable;
use App\model\LibraryBookIssue;
use App\model\BookReturn;
use App\model\LibraryBook;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        try{
           $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
           $totalIssue=LibraryBookIssue::sum('issue_quantity');
           $totalReturn=BookReturn::sum('quantity');
           $totalBook=LibraryBook::sum('entry_quantity');
           $totalMember=LibraryBookIssue::sum('issue_type_id');
            return view('library.index')
                ->with('totalIssue',$totalIssue)
                ->with('totalReturn',$totalReturn)
                ->with('totalBook',$totalBook)
                ->with('totalMember',$totalMember)
                ->with('admin',$admins);
        }catch (Exception $e){
            return view('Error.officeadmin');
        }

    }
	public function adminProfile(Request $request) {
		try {
			$admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
			$datas = adminTable::where('admin_id',1)->first();
			return view('admin.admin-profile')
				->with('datas', $datas)
				->with('admin', $admins);
		} catch (Exception $e) {
			return view('Error.admindanger');
		}

	}

	public function adminProfileUpdate(Request $request){
		if($request->admin_password==$request->confirm_password){
			$data=adminTable::find(1);
			$data->designation=$request->designation;
			$data->admin_name=$request->admin_username;
			$data->admin_email=$request->admin_email;
			$data->admin_phone=$request->admin_contact;
			$data->admin_password=Hash::make($request->admin_password);
			if ($request->hasFile('image')) {
	                $image = $request->file('image');
	                $imagename = time().'.'.$image->getClientOriginalExtension();
	                $location = public_path('images/admin');
	                $image->move($location, $imagename);
	                $data->admin_image = $imagename;
	            }
	        $data->save();
	        $request->session()->flash('message1','Data Updated Successfully');
	        return back();
		}
		else{
			$request->session()->flash('message2','Wrong Passsword');
	        return back();
		}
	}
	public function adminLogout(Request $request)
    {
        try{
            $request->session()->flush();
            $request->session()->regenerate();
            $request->session()->flash('message1','Logout Successfully');
            return redirect()->route('adminlogin.loginAdmin');
        }catch (Exception $e){
            return view('Error.officeadmin');
        }

    }
}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Exception;
use App\model\adminTable;

class AdminLoginController extends Controller
{
    public function loginAdmin(Request $request)
    {
        try{
            // $admins=adminTable::where('admin_id',$request->session()->get('adminLogin'))->first();
            return view('Admin.adminlogin');
                //->with('admin',$admins);
        }catch (Exception $e){
            return view('Error.officeadmin');
        }

    }
    public function loginAdminVerify(Request $request){
        $admin=adminTable::where('admin_name',$request->username)->first();
        if($admin && Hash::check($request->password,$admin->admin_password)){
            $request->session()->put('adminLogin',$admin->admin_id);
            $request->session()->flash('message1','Welcome ' .$admin->admin_name. ' to the DashBoard');
            return redirect()->route('admin.index');
        }else{
            $request->session()->flash('message2','Sorry Wrong Username or Password');
            return back();
        }
    }

 }


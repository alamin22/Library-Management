<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use App\model\adminTable;
use App\model\LibrarySelf;

class LibrarySelfController extends Controller
{
    public function index(Request $request)
    {
        try {
            $admins = adminTable::where('admin_id', $request->session()->get('adminLogin'))->first();
            return view('library.self')
                ->with('admin', $admins);
        } 
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request)
    {

        $data=new LibrarySelf();
        $data->library_self_self_number=$request->self_number;
        $data->save();
        return response()->json(array('status'=>'success','message'=>'Data Save Successfully'));

    }

    public function get_all(Request $request)
    {
        $Self = LibrarySelf::All();
        return response()->json(array('status'=>'success','data'=>$Self));
    }

    public function delete(Request $request)
    {
        $id=$request->id;
        LibrarySelf::where('library_self_id','=',$id)->delete();
        return response()->json(array('status'=>'SUCCESS'));

    }

    public function update(Request $request)
    {
    	try{
	        $data=LibrarySelf::find($request->hidden_id);
	        $data->library_self_self_number=$request->self_number;
	        $data->save();
	        return response()->json(array('status'=>'success'));
    	}catch(Exception $e){
    		return $e->getMessage();
    	}

    }

  
/*
    public function add(Request $request)
    {
        try {
            $admins = adminTable::where('admin_id', $request->session()->get('adminLogin'))->first();
            $school = SchoolAdmin::where('school_admin_id', $request->session()->get('loggedSchoolAdmin'))->leftjoin('edumaster_school_list', 'edumaster_school_list.school_id', 'edumaster_school_admin.school_admin_school_id')->first();
            $session = CurrentSession::where('current_session_school_id', $school->school_admin_school_id)
                ->where('current_session_active', 1)->where('current_session_session_id', $request->session()->get('SchoolSession'))->first();
            $SelfWithSubSelf = array();
            $this->GetSelfHirarchy($school->school_admin_school_id, $SelfWithSubSelf);
            $self = json_decode(json_encode((object)$SelfWithSubSelf), FALSE);



            return response()->json(array('status'=>'success', 'data'=>$SelfWithSubSelf));

        } catch (Exception $e) {
            return view('Error.admindanger');
        }
    }


    public function edit(Request $request)
    {
        try {
            $admins = SchoolAdmin::where('school_admin_id', $request->session()->get('loggedSchoolAdmin'))->get();
            $school = SchoolAdmin::where('school_admin_id', $request->session()->get('loggedSchoolAdmin'))->leftjoin('edumaster_school_list', 'edumaster_school_list.school_id', 'edumaster_school_admin.school_admin_school_id')->first();
            $session = CurrentSession::where('current_session_school_id', $school->school_admin_school_id)
                ->where('current_session_active', 1)->where('current_session_session_id', $request->session()->get('SchoolSession'))->first();
            $SelfWithSubSelf = array();
            $this->GetSelfHirarchy($school->school_admin_school_id, $SelfWithSubSelf);
            $self = json_decode(json_encode((object)$SelfWithSubSelf), FALSE);

            $data=LibrarySelf::find($request->id);

            return response()->json(array('status'=>'success', 'data'=>$SelfWithSubSelf,'selected'=>$data));

        } catch (Exception $e) {
            return view('Error.admindanger');
        }
    }


    private function GetSelfHirarchy(&$SelfWithSubSelf, $self_id = 0) {

        $selfs = DB::select(
            'SELECT 
                        `parent`.`library_self_id`,
                        `parent`.`library_self_self_number`,
                        `parent`.`library_self_parent_id`,
                        COUNT(`child`.`library_self_id`) AS `Count`
                    FROM
                        `library_self` `parent`
                            LEFT JOIN
                        `library_self` `child` ON `parent`.`library_self_id` = `child`.`library_self_parent_id`
                    WHERE
                            `parent`.`library_self_parent_id` = '.$self_id.'
                    GROUP BY `parent`.`library_self_id`
                    ORDER BY `parent`.`library_self_id` ASC'
        );
        $Level = 1;
        foreach($selfs as $each_self) {
            $self_array = array(
                'library_self_id' => $each_self->library_self_id,
                'library_self_self_number' => $each_self->library_self_self_number,
                'library_self_parent_id' => $each_self->library_self_parent_id,
                'SectionCount' => $each_self->Count
            );
            $ParentSelfNumber = $each_self->library_self_self_number;
                array_push($SelfWithSubSelf, $self_array);

            $this->GetSelfRecursive($each_self->library_self_id, $SelfWithSubSelf, $Level, $ParentSelfNumber);
        }

    }

    private function GetSelfRecursive($parent_self_id, &$SelfWithSubSelf, $Level, $ParentSelfNumber) {

        $selfs = DB::select(
            'SELECT 
                        `parent`.`library_self_id`,
                        `parent`.`library_self_self_number`,
                        `parent`.`library_self_parent_id`,
                        COUNT(`child`.`library_self_id`) AS `Count`
                    FROM
                        `library_self` `parent`
                            LEFT JOIN
                        `library_self` `child` ON `parent`.`library_self_id` = `child`.`library_self_parent_id`
                    WHERE
                           `parent`.`library_self_parent_id` = '.$parent_self_id.'
                    GROUP BY `parent`.`library_self_id`
                    ORDER BY `parent`.`library_self_id` ASC'
        );
        $NextLevel = $Level + 1;
        foreach($selfs as $each_self) {

            $self_array = array(
                'library_self_id' => $each_self->library_self_id,
                'library_self_self_number' =>$ParentSelfNumber.'  >  '. $each_self->library_self_self_number,
                'library_self_parent_id' => $each_self->library_self_parent_id,
                'SectionCount' => $each_self->Count
            );
            $ParentSelfNumber_Recursive = $ParentSelfNumber . '  >  ' . $each_self->library_self_self_number;

                array_push($SelfWithSubSelf, $self_array);

            $this->GetSelfRecursive($each_self->library_self_id, $SelfWithSubSelf, $NextLevel, $ParentSelfNumber_Recursive);
        }
    }private function GetSelfHirarchyshow(&$SelfWithSubSelf, $self_id = 0) {

        $selfs = DB::select(
            'SELECT 
                        `parent`.`library_self_id`,
                        `parent`.`library_self_self_number`,
                        `parent`.`library_self_parent_id`,
                        COUNT(`child`.`library_self_id`) AS `Count`
                    FROM
                        `library_self` `parent`
                            LEFT JOIN
                        `library_self` `child` ON `parent`.`library_self_id` = `child`.`library_self_parent_id`
                    WHERE
                           `parent`.`library_self_parent_id` = '.$self_id.'
                    GROUP BY `parent`.`library_self_id`
                    ORDER BY `parent`.`library_self_id` ASC'
        );
        $Level = 1;
        foreach($selfs as $each_self) {
            $self_array = array(
                'library_self_id' => $each_self->library_self_id,
                'library_self_self_number' => $each_self->library_self_self_number,
                'library_self_parent_id' => $each_self->library_self_parent_id,
                'SectionCount' => $each_self->Count
            );
            $ParentSelfNumber = $each_self->library_self_self_number;

                array_push($SelfWithSubSelf, $self_array);

            $this->GetSelfRecursiveshow($each_self->library_self_id, $SelfWithSubSelf, $Level, $ParentSelfNumber);
        }

    }

    private function GetSelfRecursiveshow($parent_self_id, &$SelfWithSubSelf, $Level, $ParentSelfNumber) {

        $selfs = DB::select(
            'SELECT 
                        `parent`.`library_self_id`,
                        `parent`.`library_self_self_number`,
                        `parent`.`library_self_parent_id`,
                        COUNT(`child`.`library_self_id`) AS `Count`
                    FROM
                        `library_self` `parent`
                            LEFT JOIN
                        `library_self` `child` ON `parent`.`library_self_id` = `child`.`library_self_parent_id`
                    WHERE
                           `parent`.`library_self_parent_id` = '.$parent_self_id.'
                    GROUP BY `parent`.`library_self_id`
                    ORDER BY `parent`.`library_self_id` ASC'
        );
        $NextLevel = $Level + 1;

        $Spaces = str_repeat("&emsp;", $Level);
        foreach($selfs as $each_self) {

            $self_array = array(
                'library_self_id' => $each_self->library_self_id,
                'library_self_self_number' =>$Spaces . $each_self->library_self_self_number,
                'library_self_parent_id' => $each_self->library_self_parent_id,
                'SectionCount' => $each_self->Count
            );
            $ParentSelfNumber_Recursive = $Spaces . $each_self->library_self_self_number;

                array_push($SelfWithSubSelf, $self_array);

            $this->GetSelfRecursiveshow($each_self->library_self_id, $SelfWithSubSelf, $NextLevel, $ParentSelfNumber_Recursive);
        }
    }
    */

}

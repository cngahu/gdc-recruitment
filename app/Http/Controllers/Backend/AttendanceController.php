<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function EmployeeAttendenceList(){

//        $allData = Attendance::orderBy('id','desc')->get();
        $allData = Attendance::select('date')->groupBy('date')->orderBy('id','desc')->get();
        return view('backend.attendance.view_employee_attend',compact('allData'));

    } // End Method

    public function AddEmployeeAttendence(){
        $employees = Employee::all();
        return view('backend.attendance.add_employee_attend',compact('employees'));
    }// End Method

    public function EmployeeAttendenceStore(Request $request){
        Attendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();
        $countemployee = count($request->employee_id);

        for ($i=0; $i < $countemployee ; $i++) {
            $attend_status = 'attend_status'.$i;
            $attend = new Attendance();
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status  = $request->$attend_status;
            $attend->save();
        }

        $notification = array(
            'message' => 'Data Inseted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.attend.list')->with($notification);


    }// End Method


    public function EditEmployeeAttendence($date){
        $employees = Employee::all();
        $editData = Attendance::where('date',$date)->get();
        return view('backend.attendance.edit_employee_attend',compact('employees','editData'));

    }// End Method

    public function ViewEmployeeAttendence($date){

        $details = Attendance::where('date',$date)->get();
        return view('backend.attendance.details_employee_attend',compact('details'));


    }// End Method
}

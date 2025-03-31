<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Designations;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DesignationsController extends Controller
{
    //
    public function AllDesignation(){

        $designation = Designations::latest()->get();
        return view('backend.designation.all_designation',compact('designation'));
    } // End Method

    public function AddDesignation(){
        return view('backend.designation.add_designation');
    } // End Method

    public function StoreDesignation(Request $request){

        $validateData = $request->validate([
            'name' => 'required|max:200',

        ]);



        Designations::insert([

            'name' => $request->name,

            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Designation Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.designation')->with($notification);
    } // End Method

    public function EditDesignation($id){

        $designation= Designations::findOrFail($id);
        return view('backend.designation.edit_designation',compact('designation'));

    } // End Method


    public function UpdateDesignation(Request $request){

        $designation_id = $request->id;

        Designations::findOrFail($request->id)->update([

            'name' => $request->name,
            'updated_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Designation Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.designation')->with($notification);


    } // End Method


    public function DeleteDesignation($id){


        Designations::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Designation Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method
}

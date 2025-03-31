<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\gender;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    //
    public function AllGender(){

        $gender = gender::latest()->get();
        return view('backend.gender.all_gender',compact('gender'));
    } // End Method

    public function AddGender(){
        return view('backend.gender.add_gender');
    } // End Method

    public function StoreGender(Request $request){

        $validateData = $request->validate([
            'name' => 'required|max:200',

        ]);



        gender::insert([

            'name' => $request->name,

            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Gender Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.gender')->with($notification);
    } // End Method

    public function EditGender($id){

        $gender= gender::findOrFail($id);
        return view('backend.gender.edit_gender',compact('gender'));

    } // End Method


    public function UpdateGender(Request $request){
        $validateData = $request->validate([
            'name' => 'required|max:200',

        ]);
        $gender_id = $request->id;

        gender::findOrFail($request->id)->update([

            'name' => $request->name,
            'updated_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Gender Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.gender')->with($notification);


    } // End Method


    public function DeleteGender($id){


        gender::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Gender Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ethnicity;
use App\Models\gender;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EthnicityController extends Controller
{
    //
    public function AllEthnicity(){

        $ethnicity = ethnicity::latest()->get();
        return view('backend.ethnicity.all_ethnicity',compact('ethnicity'));
    } // End Method

    public function AddEthnicity(){
        return view('backend.ethnicity.add_ethnicity');
    } // End Method

    public function StoreEthnicity(Request $request){

        $validateData = $request->validate([
            'name' => 'required|max:200',

        ]);



        ethnicity::insert([

            'name' => $request->name,

            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Ethnicity Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.ethnicity')->with($notification);
    } // End Method

    public function EditEthnicity($id){

        $ethnicity= ethnicity::findOrFail($id);
        return view('backend.ethnicity.edit_ethnicity',compact('ethnicity'));

    } // End Method


    public function UpdateEthnicity(Request $request){
        $validateData = $request->validate([
            'name' => 'required|max:200',

        ]);
        $gender_id = $request->id;

        ethnicity::findOrFail($request->id)->update([

            'name' => $request->name,
            'updated_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Ethnicity Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.ethnicity')->with($notification);


    } // End Method


    public function DeleteEthnicity($id){


        ethnicity::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Ethnicity Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method
}

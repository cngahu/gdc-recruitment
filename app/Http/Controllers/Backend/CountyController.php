<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\home_county;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    //
    public function AllCounty(){

        $county = home_county::latest()->get();
        return view('backend.county.all_county',compact('county'));
    } // End Method

    public function AddCounty(){
        return view('backend.county.add_county');
    } // End Method

    public function StoreCounty(Request $request){

        $validateData = $request->validate([
            'name' => 'required|max:200',

        ]);



        home_county::insert([

            'name' => $request->name,
            'active' => 1,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'County Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.county')->with($notification);
    } // End Method

    public function EditCounty($id){

        $county= home_county::findOrFail($id);
        return view('backend.county.edit_county',compact('county'));

    } // End Method


    public function UpdateCounty(Request $request){
        $validateData = $request->validate([
            'name' => 'required|max:200',

        ]);
        $county_id = $request->id;

        home_county::findOrFail($request->id)->update([

            'name' => $request->name,
            'updated_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'County Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.county')->with($notification);


    } // End Method


    public function DeleteCounty($id){


        home_county::findOrFail($id)->delete();

        $notification = array(
            'message' => 'County Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method

}

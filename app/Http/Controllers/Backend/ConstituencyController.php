<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\constituency;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConstituencyController extends Controller
{
    //
    public function AllConstituency(){

        $constituency = constituency::latest()->get();
        return view('backend.constituency.all_constituency',compact('constituency'));
    } // End Method

    public function AddConstituency(){
        return view('backend.constituency.add_constituency');
    } // End Method

    public function StoreConstituency(Request $request){

        $validateData = $request->validate([
            'name' => 'required|max:200',

        ]);



        constituency::insert([

            'name' => $request->name,
            'active' => 1,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Constituency Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.constituency')->with($notification);
    } // End Method

    public function EditConstituency($id){

        $constituency= constituency::findOrFail($id);
        return view('backend.constituency.edit_constituency',compact('constituency'));

    } // End Method


    public function UpdateConstituency(Request $request){
        $validateData = $request->validate([
            'name' => 'required|max:200',

        ]);
        $gender_id = $request->id;

        constituency::findOrFail($request->id)->update([

            'name' => $request->name,
            'updated_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Constituency Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.constituency')->with($notification);


    } // End Method


    public function DeleteConstituency($id){


        constituency::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Constituency Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method

}

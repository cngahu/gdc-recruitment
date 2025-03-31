<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\nationality;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    //
    public function AllNation(){

        $nation = nationality::latest()->get();
        return view('backend.nation.all_nation',compact('nation'));
    } // End Method

    public function AddNation(){
        return view('backend.nation.add_nation');
    } // End Method

    public function StoreNation(Request $request){

        $validateData = $request->validate([
            'name' => 'required|max:200',

        ]);



        nationality::insert([

            'name' => $request->name,
                 'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Country Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.nation')->with($notification);
    } // End Method

    public function EditNation($id){

        $nation= nationality::findOrFail($id);
        return view('backend.nation.edit_nation',compact('nation'));

    } // End Method


    public function UpdateNation(Request $request){
        $validateData = $request->validate([
            'name' => 'required|max:200',

        ]);
        $country_id = $request->id;

        nationality::findOrFail($request->id)->update([

            'name' => $request->name,
            'updated_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Nation Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.nation')->with($notification);


    } // End Method


    public function DeleteNation($id){


        nationality::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Country Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method
}

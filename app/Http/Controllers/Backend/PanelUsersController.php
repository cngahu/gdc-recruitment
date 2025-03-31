<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\PanelUserAppointmentMail;
use App\Models\User;
use App\Models\Vacancies;
use App\Service\AuditLogService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

class PanelUsersController extends Controller
{
    //
    public function AllPanelUsers(){


        $panel = User::where('adak_role', 3)->latest()->get();
        return view('backend.panelusers.all_panelusers',compact('panel'));
    } // End Method

    public function AllUnverified(){


        $panel = User::where('role', 'applicant')->where('email_verified_at',null)->latest()->get();
        return view('backend.panelusers.all_unverified',compact('panel'));
    } // End Method


    public function AddPanelUsers(){
        $vacancy=Vacancies::latest()->get();
        return view('backend.panelusers.add_panelusers',compact('vacancy'));
    } // End Method


    public function StorePanelUsers0(Request $request){

        $validateData = $request->validate([
            'first_name' => 'required|max:200',
            'last_name' => 'required|max:200',
            'email' => 'required|max:200',
            'vacancy_id' => 'required|max:200',

        ]);

        $randomPassword = Str::random(5);
        $hashedPassword = Hash::make($randomPassword);
        User::insert([

            'first_name' => $request->first_name,
            'other_name' => $request->other_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'panel_role' => $request->panel_role,
            'adak_role' =>3,
            'idnumber' => $request->idnumber,
            'vacancy_id' => $request->vacancy_id,
            'status' => 1,
            'role'=>'panelist',
            'gender'=>0,
            'nationality'=>115,
            'ethnicity'=>1,

            'marital'=>1,
            'email_verified_at'=>Carbon::now(),
            'county'=>1,
            'must_change'=>true,
            'password'=>$hashedPassword,
            'passcode'=>$randomPassword,
            'created_at' => Carbon::now(),


        ]);

        $notification = array(
            'message' => 'Panel User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.panel.users')->with($notification);
    } // End Method
    public function StorePanelUsers(Request $request)
    {
        // Start the try-catch block to handle errors
        try {
            // Validate the request data
            $validateData = $request->validate([
                'first_name' => 'required|max:200',
                'last_name' => 'required|max:200',
                'email' => 'required|max:200',
                'vacancy_id' => 'required|max:200',
            ]);

            // Generate random password
            $randomPassword = Str::random(5);
            $hashedPassword = Hash::make($randomPassword);

            // Insert the panel user into the User table
            $user = User::create([
                'first_name' => $request->first_name,
                'other_name' => $request->other_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'panel_role' => $request->panel_role,
                'adak_role' => 3,
                'idnumber' => $request->idnumber,
                'vacancy_id' => $request->vacancy_id,
                'status' => 1,
                'role' => 'panelist',
                'gender' => 0,
                'nationality' => 115,
                'ethnicity' => 1,
                'marital' => 1,
                'email_verified_at' => Carbon::now(),
                'county' => 1,
                'must_change' => true,
                'password' => $hashedPassword,
                'passcode' => $randomPassword,
                'created_at' => Carbon::now(),
            ]);

            // Record the activity in the Audit Log
            $vacancy = Vacancies::findOrFail($request->vacancy_id); // Get the vacancy details
            $activityDescription = "Created a new panelist with role: {$request->panel_role} for vacancy: {$vacancy->title}.";
            AuditLogService::record('CREATE', $activityDescription, 'users', $user->id, ['vacancy_id' => $request->vacancy_id]);

            // Send email to the user
            Mail::to($request->email)->send(new PanelUserAppointmentMail($user, $vacancy, $randomPassword));

            // Notify the user
            $notification = array(
                'message' => 'Panel User Inserted Successfully and email sent.',
                'alert-type' => 'success'
            );

            return redirect()->route('all.panel.users')->with($notification);

        } catch (\Exception $e) {
            // Log the exception and return an error response
            Log::error('Error creating panel user: ' . $e->getMessage());
            return redirect()->route('all.panel.users')->with([
                'message' => 'Error creating panel user. Please try again.',
                'alert-type' => 'error',
            ]);
        }
    }
    public function EditPanelUsers($id){

        $panel = User::findOrFail($id);
        $vacancy=Vacancies::latest()->get();

        return view('backend.panelusers.edit_panelusers',compact('panel','vacancy'));

    } // End Method

    public function AdminVerify($id){

        $panel = User::findOrFail($id);
        $panel->email_verified_at=Carbon::now();
        $panel->save();
        $notification = array(
            'message' => 'Verification Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.unverified')->with($notification);

    } // End Method



    public function UpdatePanelUsers0(Request $request){

//        $randomPassword = Str::random(5);
//        $hashedPassword = Hash::make($randomPassword);
        User::findOrFail($request->id)->update([

            'first_name' => $request->first_name,
            'other_name' => $request->other_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'panel_role' => $request->panel_role,
            'idnumber' => $request->idnumber,
            'vacancy_id' => $request->vacancy_id,
            'status' => 1,
            'role'=>'panelist',
            'adak_role'=>3,
//            'gender'=>0,
//            'nationality'=>115,
//            'ethnicity'=>1,
//
//            'marital'=>1,
            'email_verified_at'=>Carbon::now(),
//            'county'=>1,

            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Record Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.panel.users')->with($notification);

    } // End else Condition
    public function UpdatePanelUsers(Request $request)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Update the user record
            $user = User::findOrFail($request->id);

            // Prepare the data to be updated
            $updateData = [
                'first_name' => $request->first_name,
                'other_name' => $request->other_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'panel_role' => $request->panel_role,
                'idnumber' => $request->idnumber,
                'vacancy_id' => $request->vacancy_id,
                'status' => 1,
                'role' => 'panelist',
                'adak_role' => 3,
                'email_verified_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            $user->update($updateData);

            // Log the activity for auditing purposes
            AuditLogService::record(
                'Update',
                'Updated panel user details',
                'users',
                $user->id,
                $updateData
            );

            // Commit the transaction
            DB::commit();

            // Send a success notification
            $notification = array(
                'message' => 'Record Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.panel.users')->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            // Log the error with detailed info for auditing
            AuditLogService::record(
                'Error',
                'Failed to update panel user: ' . $e->getMessage(),
                'users',
                $request->id,
                [
                    'error' => $e->getMessage(),
                    'request_data' => $request->all()
                ]
            );

            // Send an error notification
            $notification = array(
                'message' => 'Failed to update record: ' . $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->route('all.panel.users')->with($notification);
        }
    }


    public function DeletePanelUsers($id){


        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Panel User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method
}

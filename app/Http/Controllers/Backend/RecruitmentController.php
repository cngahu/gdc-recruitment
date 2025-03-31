<?php

namespace App\Http\Controllers\Backend;

use App\Helper\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\Recruitment;
use App\Models\Vacancies;
use App\Service\AuditLogService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruitmentController extends Controller
{
    //
    public function AllRecruitment(){

        $recruitment = Recruitment::latest()->get();
        return view('backend.recruitment.all_recruitment',compact('recruitment'));
    } // End Method

    public function AddRecruitment(){
        return view('backend.recruitment.add_recruitment');
    } // End Method


    public function StoreRecruitment0(Request $request){


        $request->validate([
            'approval'=>'nullable|mimes:pdf'
        ],
            [
                'approval.mimes:pdf'=>'Please Upload A PDF Document',


            ]

        );

        if($request->approval != null) {
            $certificate = 'Approval-' . date('YmdHis') . '.' . $request->approval->extension();

            $request->approval->move(public_path('upload/approval/'), $certificate);
            $certificate_url = 'upload/approval/' . $certificate;
        }
        else{
            $certificate_url=null;
        }
        Recruitment::insert([

            'name' => $request->name,
            'description' => $request->description,
            'startDate' => $request->startDate,
            'closeDate' => $request->closeDate,
            'approval'=>$certificate_url,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Recruitment Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.recruitment')->with($notification);
    } // End Method

    public function StoreRecruitment(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'startDate' => 'required|date',
            'closeDate' => 'required|date|after_or_equal:startDate',
            'approval' => 'nullable|mimes:pdf',
        ], [
            'approval.mimes' => 'Please upload a valid PDF document.',
            'closeDate.after_or_equal' => 'Closing date must be on or after the opening date.',
        ]);

        try {
            // Initialize certificate URL
            $certificate_url = null;

            // Handle file upload if approval is provided
            if ($request->hasFile('approval')) {
                $certificate = 'Approval-' . date('YmdHis') . '.' . $request->approval->extension();
                $request->approval->move(public_path('upload/approval/'), $certificate);
                $certificate_url = 'upload/approval/' . $certificate;
            }

            // Create the recruitment record
            $recruitment = Recruitment::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'startDate' => $validatedData['startDate'],
                'closeDate' => $validatedData['closeDate'],
                'approval' => $certificate_url,
                'created_by' => Auth::id(),
            ]);

            // Audit the recruitment creation
            AuditLogService::record(
                'created',
                'New recruitment created.',
                'recruitments',
                $recruitment->id,
                [
                    'name' => $recruitment->name,
                    'description' => $recruitment->description,
                    'startDate' => $recruitment->startDate,
                    'closeDate' => $recruitment->closeDate,
                    'approval' => $certificate_url,
                ]
            );

            // Success notification
            return redirect()->route('all.recruitment')->with([
                'message' => 'Recruitment created successfully.',
                'alert-type' => 'success',
            ]);
        } catch (\Exception $e) {
            // Log the error message for debugging
            LogHelper::logError('Recruitment creation failed: ' . $e->getMessage());

            // Record the failure in the audit logs
            AuditLogService::record(
                'error',
                'Failed to create recruitment.',
                'recruitments',
                null,
                ['error' => $e->getMessage()]
            );

            // Error notification
            return redirect()->back()->withErrors([
                'error' => 'An error occurred while creating recruitment. Please try again.',
            ]);
        }
    }


    public function EditRecruitment($id){

        $recruitment = Recruitment::findOrFail($id);
        return view('backend.recruitment.edit_recruitment',compact('recruitment'));

    } // End Method
    public function ExtendRecruitment($id){

        $recruitment = Recruitment::findOrFail($id);
        return view('backend.recruitment.extend_recruitment',compact('recruitment'));

    } // End Method

    public function UpdateRecruitment(Request $request){



            Recruitment::findOrFail($request->id)->update([

                'name' => $request->name,
                'description' => $request->description,
                'startDate' => $request->startDate,
                'closeDate' => $request->closeDate,
                'updated_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'Recruitment Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.recruitment')->with($notification);





    } // End Method
//    public function UpdateExtendRecruitment(Request $request){
//
//        $request->validate([
//            'reg_certificate'=>'nullable|mimes:pdf'
//        ],
//            [
//                'reg_certificate.mimes:pdf'=>'Please Upload A PDF Document',
//            ]
//        );
//
//
//        $certificate = 'EXT-'. '.' . $request->ext_certificate->extension();
//        $request->ext_certificate->move(public_path('upload/extension/'), $certificate);
//        $certificate_url = 'upload/disability/' . $certificate;
//
//        Recruitment::findOrFail($request->id)->update([
//            'closeDate' => $request->closeDate,
//            'justification'=>$certificate_url,
//            'updated_at' => Carbon::now(),
//        ]);
//
//        $notification = array(
//            'message' => 'Recruitment Updated Successfully',
//            'alert-type' => 'success'
//        );
//
//        return redirect()->route('all.recruitment')->with($notification);
//
//
//
//
//
//    } // End Method

//    public function DeleteRecruitment($id){
//
//        Recruitment::findOrFail($id)->delete();
//
//        $notification = array(
//            'message' => 'Recruitment Deleted Successfully',
//            'alert-type' => 'success'
//        );
//
//        return redirect()->back()->with($notification);
//
//    } // End Method
    public function UpdateExtendRecruitment(Request $request)
    {
        // Validate the request
        $request->validate([
            'reg_certificate' => 'nullable|mimes:pdf',
        ], [
            'reg_certificate.mimes:pdf' => 'Please Upload A PDF Document',
        ]);

        try {
            // Check if file exists and process it
            if ($request->hasFile('reg_certificate')) {
                $certificate = 'EXT-' . time() . '.' . $request->file('reg_certificate')->extension();
                $request->file('reg_certificate')->move(public_path('upload/extension/'), $certificate);
                $certificate_url = 'upload/extension/' . $certificate;
            } else {
                $certificate_url = null; // Handle case where no file is uploaded
            }

            // Update the recruitment record
            $recruitment = Recruitment::findOrFail($request->id);
            $recruitment->update([
                'closeDate' => $request->closeDate,
                'justification' => $certificate_url,
                'updated_at' => now(),
            ]);

            // Log the activity using AuditLogService
            AuditLogService::record(
                'Update',
                'Updated recruitment with extension justification.',
                'recruitments',
                $recruitment->id,
                [
                    'closeDate' => $request->closeDate,
                    'justification' => $certificate_url,
                ]
            );

            // Prepare success notification
            $notification = [
                'message' => 'Recruitment Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.recruitment')->with($notification);

        } catch (\Exception $e) {
            // Handle exceptions and log error
            \Log::error('Error updating recruitment extension: ' . $e->getMessage());

            // Optional: Log the error activity for audit purposes
            AuditLogService::record(
                'Error',
                'Error updating recruitment extension: ' . $e->getMessage(),
                'recruitments',
                $request->id ?? null,
                [
                    'closeDate' => $request->closeDate ?? null,
                    'justification' => $certificate_url ?? null,
                ]
            );

            // Redirect back with an error notification
            $notification = [
                'message' => 'Failed to update recruitment. Please try again later.',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function DeleteRecruitment($id)
    {
        // Check if there are any vacancies for the given recruitment ID
        $vacanciesCount = Vacancies::where('Recruitmentid', $id)->count();

        if ($vacanciesCount > 0) {
            // If there are vacancies, notify and don't proceed with the deletion
            $notification = array(
                'message' => 'Cannot delete recruitment that has vacancies associated with it.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        // Find the recruitment record and delete it
        $recruitment = Recruitment::findOrFail($id);

        // Audit log the deletion action
        AuditLogService::record(
            'Delete',
            'Recruitment deleted',
            'recruitments',
            $recruitment->id,
            ['name' => $recruitment->name, 'description' => $recruitment->description] // Optional: You can also pass specific details of the deleted record
        );

        // Delete the recruitment
        $recruitment->delete();

        // Prepare success notification
        $notification = array(
            'message' => 'Recruitment Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}

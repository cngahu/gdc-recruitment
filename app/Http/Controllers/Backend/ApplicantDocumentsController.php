<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ApplicantDocs;
use App\Models\JobSeekerDoc;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantDocumentsController extends Controller
{
    //
    public function AllApplicantDocuments(){

        $appdocs = ApplicantDocs::latest()->get();
        return view('backend.appdocs.all_applicantdocs',compact('appdocs'));
    } // End Method

    public function AddApplicantDocuments(){
        return view('backend.appdocs.add_applicantdoc');
    } // End Method

    public function StoreApplicantDocuments(Request $request){




        ApplicantDocs::insert([

            'document_name' => $request->document_name,
            'job_specific' => $request->job_specific,
            'active' => $request->active,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Document Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.appdocs')->with($notification);
    } // End Method

    public function EditApplicantDocuments($id){

        $appdoc= ApplicantDocs::findOrFail($id);
        return view('backend.appdocs.edit_appdocs',compact('appdoc'));

    } // End Method


    public function UpdateApplicantDocuments(Request $request){

        $appdoc_id = $request->id;

        ApplicantDocs::findOrFail($request->id)->update([


            'document_name' => $request->document_name,
            'job_specific' => $request->job_specific,
            'active' => $request->active,
            'updated_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Document Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.appdocs')->with($notification);


    } // End Method


    public function DeleteApplicantDocuments($id){


        ApplicantDocs::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Document Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method


    public function ApplicantDocumentProfile(){
        $userid=Auth::user()->id;
        $user=User::findOrFail($userid);
        $appdocs=ApplicantDocs::where('job_specific',0)->where('active',1)->get()->all();
        $jobdocs=JobSeekerDoc::where('userid',$userid)->get()->all();
        $ccount=JobSeekerDoc::where('userid',$userid)->count();
        return view('applicant.apply.applicantdocs_all',compact('ccount','jobdocs','user','userid','appdocs'));
    }

    public  function ApplicantDocumentStore(Request $request){


        if($request->fileid != null)
        {
            foreach ($request->fileid as $key=> $file)
            {
             $poster =str_replace(" ","_",microtime(false)) .'.'.$file->extension();
            $file->move(public_path('upload/commondocs/'), $poster);
            $poster_url='upload/commondocs/'.$poster;

                JobSeekerDoc::insert([
                    'document_id' => $key,
                    'userid'=>$request->userid,
                    'path'=>$poster_url,

                ]);

            }



        }
        $user=User::findOrFail($request->userid);
        $user->level=8;
        $user->Save();

        $notification = array(
            'message' => 'Document Saved Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('applicant.dashboard')->with($notification);
    }


    public function ApplicantDocumentEdit($id){

        $appdoc= JobSeekerDoc::findOrFail($id);
        return view('applicant.apply.edit_applicantdocument',compact('appdoc'));

    } // End Method


    public function ApplicantDocumentUpdate(Request $request){

        $appdoc_id = $request->id;
        $old_cert = $request->oldcert;
        if (file_exists($old_cert)) {
            unlink($old_cert);
        }
        $certificate = time(). '.' . $request->certificate->extension();
        $request->certificate->move(public_path('upload/commondocs/'), $certificate);
        $certificate_url = 'upload/commondocs/' . $certificate;



        JobSeekerDoc::findOrFail($request->id)->update([


            'path' => $certificate_url,

            'updated_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Document Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.appdocs')->with($notification);


    } // End Method


    public function ApplicantDocumentDelete($id){

        $document = JobSeekerDoc::findOrFail($id);
        $cert = $document->path;
        unlink($cert );

        JobSeekerDoc::findOrFail($id)->delete();
        $this->DowngradeLevel(Auth::user()->id);
        $notification = array(
            'message' => 'Document Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method


    private function DowngradeLevel($id)
    {
        if(JobSeekerDoc::where('userid',$id)->count()==0)
        {
            $user=User::findOrFail($id);

            $user->level=6;

            $user->Save();
        }

    }
}

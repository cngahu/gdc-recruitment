<?php

namespace App\Http\Controllers;

use App\Mail\CustomMailer;
use App\Models\EducationQualifications;
use App\Models\Experience;
use App\Models\JobApplication;
use App\Models\JobApplicationDocument;
use App\Models\ProffessionalMembership;
use App\Models\User;
use App\Models\Vacancies;
use App\Models\VacancyDocuments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class copyjobapplicationcontroller extends Controller
{
    //
    public function OpenVacancies()
    {
        $vacancies = DB::table('vacancies')
            ->join('recruitments', 'vacancies.Recruitmentid', '=', 'recruitments.id')
            ->where('recruitments.closeDate', ">=",today())
            ->select('vacancies.*', 'recruitments.closeDate as closedate')
            ->get();
        return view('applicant.apply.jobs_indexer',compact('vacancies'));
    }

    public function VacancyApply($id){

        $vacancy=Vacancies::findOrFail($id);
        $uploaddocs=VacancyDocuments::where('vacancy_id',$id)->get();

        return view('applicant.apply.job_apply',compact('vacancy','uploaddocs'));


    }

    public function StoreVacancyApplication(Request $request){

        $etype=0;
        foreach ($request->fileid as $fl)
        {
//            $file = $fl->file('file');
            $extension = $fl->getClientOriginalExtension();
            if($extension != 'pdf')
            {
                $etype+=1;
            }


        }
        if($etype>0)
        {
            $notification = array(
                'message' => 'Ensure that all documents are in pdf format',
                'alert-type' => 'danger'
            );
            return redirect()->route('applicant.dashboard')->with($notification);
        }
        else {


            if ($request->fileid != null) {

                $vacancyid = $request->vacancyid;
                $userid = Auth::user()->id;


                if (JobApplication::where('vacancyid', $vacancyid)->where('userid', $userid)->exists()) {

                    $notification = array(
                        'message' => 'You Have Already Applied For this position',
                        'alert-type' => 'success'
                    );
                    return redirect()->back()->with($notification);
                } else {


                    $applicationid = JobApplication::insertGetId([
                        'vacancyid' => $request->vacancyid,
                        'userid' => Auth::user()->id,
                        'created_at' => Carbon::now(),

                    ]);


                    foreach ($request->fileid as $key => $file) {
                        $poster = $applicationid . "-" . $request->vacancyid . "-" . str_replace(" ", "_", microtime(false)) . '.' . $file->extension();
                        $file->move(public_path('upload/applicationdocs/'), $poster);
                        $poster_url = 'upload/applicationdocs/' . $poster;

                        JobApplicationDocument::insert([
                            'jobapplicationid' => $applicationid,
                            'userid' => Auth::user()->id,
                            'vacancyid' => $request->vacancyid,
                            'documentid' => $key,
                            'path' => $poster_url,
                        ]);

                    }


                }

                $useremail = User::where('id', Auth::user()->id)->value('email');
                $user = User::where('id', Auth::user()->id)->first();

                $vacancy = Vacancies::where('id', $request->vacancyid)->value('jobTitle');

                $noti = 'Thank you for your interest in the Kenya National Commission on Human Rights.';

                $data = [
                    'subject' => 'Successful Application for Vacancy: ' . $vacancy,
                    'salute' => '',
                    'body' => '<p>Dear   <strong>' . $user->first_name . '' . $user->other_name . '' . $user->last_name . '</strong><br>
                     Your application for the position of  <strong>' . $vacancy . '</strong>  at the Kenya National Commission on Human Rights has been successful ' . ' <br>
           .<br>As an Equal Opportunity Employer, the Kenya National Commission on Human Rights is committed to promoting diversity and ensuring a fair and inclusive hiring process. We appreciate your interest in joining our organization.
             <br>  Please note that only shortlisted candidates will be contacted for further stages of the selection process. <strong>' . $noti . '</strong>. <br></p>',
                ];


                Mail::to($useremail)->send(new CustomMailer($data));


                $notification = array(
                    'message' => 'Job Application Successfully',
                    'alert-type' => 'success'
                );


                $vid=$vacancyid;
                $id=$userid;
                $jobapplication=JobApplication::findOrFail($vid);
                $userid=User::findOrFail($id);
                $educationquals=EducationQualifications::where('Userid',$id)->latest()->get();
                $proffessionalquals=ProffessionalQual::where('Userid',$id)->latest()->get();
                $workexperience=Experience::where('Userid',$id)->latest()->get();
                $memberships=ProffessionalMembership::where('Userid',$id)->latest()->get();
                $vacancy=Vacancies::findOrFail($jobapplication->vacancyid);
                $uploaddocs=JobApplicationDocument::where('jobapplicationid',$vid)->get();
                return view('applicant.apply.applicant_profile_p',compact('vacancy','uploaddocs','id','memberships','workexperience','educationquals','userid','proffessionalquals'));

//                $this->JobApplicantProfile($userid,$vacancyid);
                // return redirect()->route('jobsapply.success', $request->vacancyid)->with($notification);
            }
        }

    }
    public  function JobApplicantProfile($id,$vid){
        $jobapplication=JobApplication::findOrFail($vid);
        $userid=User::findOrFail($id);
        $educationquals=EducationQualifications::where('Userid',$id)->latest()->get();
        $proffessionalquals=ProffessionalQual::where('Userid',$id)->latest()->get();
        $workexperience=Experience::where('Userid',$id)->latest()->get();
        $memberships=ProffessionalMembership::where('Userid',$id)->latest()->get();
        $vacancy=Vacancies::findOrFail($jobapplication->vacancyid);
        $uploaddocs=JobApplicationDocument::where('jobapplicationid',$vid)->get();

//        $user=User::where('id',Auth::user()->id)->first();

        return view('applicant.apply.applicant_profile_p',compact('vacancy','uploaddocs','id','memberships','workexperience','educationquals','userid','proffessionalquals'));



    }
    public function EditSaveChanges(Request $request){

        $old_cert=$request->oldrecord;

        if($request->file('newfile') != null)
        {

            if (file_exists($old_cert)) {
                unlink($old_cert);
            }

            $poster =$request->appid."-".$request->vacancyid."-".str_replace(" ","_",microtime(false)) .'.'.$request->newfile->extension();
            $request->newfile->move(public_path('upload/applicationdocs/'), $poster);
            $poster_url='upload/applicationdocs/'.$poster;

            JobApplicationDocument::findOrFail($request->docid)->update([

                'path' => $poster_url,
                'updated_at'=>Carbon::now(),
            ]);

        }



        $notification = array(
            'message' => 'Document Saved Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.applicationsmade')->with($notification);


    }
    public function ApplicationSuccessful($id){

        $vacancy=Vacancies::findOrFail($id);
        return view('applicant.apply.job_applysuccess',compact('vacancy'));


    }

    public function VacancyApplications(){
        $vacancy=JobApplication::where('userid',Auth::user()->id)->get();


        return view('applicant.apply.jobs_applied',compact('vacancy'));

    }

    public function EditAppliedJob($id)
    {
        $vacancyapplied=JobApplication::findOrFail($id);
        $jobuploaddocs=JobApplicationDocument::where('jobapplicationid',$id)->get();

        return view('applicant.apply.jobs_applied_edit',compact('jobuploaddocs','vacancyapplied'));


    }
}

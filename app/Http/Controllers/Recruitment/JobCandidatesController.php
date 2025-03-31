<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Models\EducationQualifications;
use App\Models\Experience;
use App\Models\JobApplication;
use App\Models\JobApplicationDocument;
use App\Models\PendingSelections;
use App\Models\ProffessionalMembership;
use App\Models\ProffessionalQual;
use App\Models\SelectionStages;
use App\Models\ShortlingStages;
use App\Models\ShortlistingLogger;
use App\Models\User;
use App\Models\Vacancies;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobCandidatesController extends Controller
{
    //
    public function LoadApplications(){

        $user=User::findOrFail(Auth::user()->id);

        $myvacancy=Vacancies::where('id',$user->vacancy_id)->first();
        $applicants=JobApplication::where('vacancyid',$user->vacancy_id) ->where('status','Applied')->latest()->get();

        return view('shortlisting.load_applicants',compact('myvacancy','applicants'));


    }

    public function AllShortlists(){

        $userid=Auth::user()->id;
        $vacancyid=User::where('id',$userid)->value('vacancy_id');

//        $shortlists=ShortlingStages::where('userid',$userid)->where('stage',1)->latest()->get();
        $shortlists=ShortlingStages::where('userid',$userid)->latest()->get();
        $allclosed=ShortlingStages::where('userid',$userid)->where('status',1)->count();
        $myvacancy = DB::table('vacancies')->where('id', $vacancyid)->first();

        return view('shortlisting.all_shortlist',compact('shortlists','allclosed','myvacancy'));
    }
    public function CreateShortlist(){

        $userid=Auth::user()->id;
        $vacancyid=User::where('id',$userid)->value('vacancy_id');
        $mystages=ShortlingStages::where('vacancyid',$vacancyid)->where('userid',$userid)->where('status',1)->orderBy('id','DESC')->first();
//
//        $stagenumber=ShortlingStages::where('vacancyid',$stage->vacancyid)->where('id','<',$id)->orderBy('id','DESC')->first();
//
//        $stage=ShortlingStages::findOrFail($id);
        if($mystages)
        {
            return ('Cannot create stage since there is an active stage');
        }
        else{
            return view('shortlisting.add_shortlist',compact('vacancyid'));

        }





    }

    public function StoreShortlist(Request $request) {
        $validatedDate=$request->validate([
            'Stage'=>'required',
            'Criteria'=>'required',

        ]);

        $data= new ShortlingStages();
        $data->stage= $request->Stage;
        $data->criteria= $request->Criteria;
        $data->vacancyid=  $request->vacancyid;
        $data->userid=  Auth::user()->id;
        $data->status= 1;
        $data->created_at= Carbon::now();

        $data->save();

        $notification=array(
            'message'=>'Shortlisting Stage Inserted Successfully',
            'alert-type'=>'success',
        );

        return redirect()->route('all.shortlist')->with($notification);

    }

    public function StartShortlist($id){
        $userid=User::findOrFail(Auth::user()->id);
        $stage=ShortlingStages::findOrFail($id);
        $stagenumber=ShortlingStages::where('vacancyid',$stage->vacancyid)->where('id','<',$id)->orderBy('id','DESC')->first();

        $myvacancy=Vacancies::where('id',$stage->vacancyid)->latest()->first();


        $totalcount=JobApplication::where('vacancyid',$stage->vacancyid)->count();
//        $reviewed=JobApplication::where('VacancyID',$stage->VacancyID)->where('status',1)->count();
//        $balance=JobApplication::where('VacancyID',$stage->VacancyID)->where('status',0)->count();
        if($stagenumber)
        {
            $applicants=JobApplication::where('vacancyid',$stage->vacancyid)->where('status','Shortlisted')->latest()->get();

        }
        else{
            $applicants=JobApplication::where('vacancyid',$stage->vacancyid)->where('status','Applied')->latest()->get();

        }


        return view('shortlisting.shortlist_applicants',compact('totalcount','myvacancy','applicants','stage'));

    }

    public function ShortlistProfile($id,$sid){

        $stageid=ShortlingStages::where('id',$sid)->latest()->first();
        $myvacancy=Vacancies::where('id',$stageid->vacancyid)->latest()->first();
        $applications=JobApplication::where('userid',$id)->latest()->get();
        $specificapplication=JobApplication::where('userid',$id)->where('vacancyid',$stageid->vacancyid)->first();
        $userid=User::findOrFail($id);
        $educationquals=EducationQualifications::where('Userid',$id)->latest()->get();
        $proffessionalquals=ProffessionalQual::where('Userid',$id)->latest()->get();
        $workexperience=Experience::where('Userid',$id)->latest()->get();
        $memberships=ProffessionalMembership::where('Userid',$id)->latest()->get();
//        $uploaddocs=JobApplicationDocument::where('jobapplicationid',$specificapplication->id)->get();
//        $uploaddocs=JobApplicationDocument::where('vacancyid',$myvacancy->id)->where('userid',$id)->get();
//        $uploaddocs=JobApplicationDocument::where('jobapplicationid',$myvacancy->id)->get();
        $uploaddocs=JobApplicationDocument::where('vacancyid',$myvacancy->id)->where('userid',$id)->get();
        return view('shortlisting.applicant_shortlist_profile',compact('specificapplication','stageid','myvacancy','applications','id','memberships','workexperience','educationquals','userid','proffessionalquals','uploaddocs'));

    }

    public function StoreShortlistSelect(Request $request) {

       $status='dropped';
       $shortlistingdate=null;
        $shortlistedby=null;



            if($request->decision==1)
            {

                $status='Shortlisted';
                $shortlistingdate=Carbon::now();
                $shortlistedby=Auth::user()->id;

            }
            elseif ($request->decision==2)
            {
                SelectionStages::insert([
                    'jobapplicationid'=>$request->applicationid,
                    'vacancyid'=>$request->vacancyid,
                    'stage'=>2,
                    'StageID'=>$request->stageid,
                    'status'=>0,
                    'comments'=>$request->comments,
                    'userid'=>Auth::user()->id,

                    'created_at'=>Carbon::now(),
                ]);

            }
            elseif ($request->decision==3)
            {
                PendingSelections::insert([
                    'jobapplicationid'=>$request->applicationid,
                    'vacancyid'=>$request->vacancyid,
                    'userid'=>Auth::user()->id,
                    'comments'=>$request->comments,
                    'Stage'=>$request->stageid,
                    'created_at'=>Carbon::now(),
                ]);
                $status='Applied';
            }

        JobApplication::where('id',$request->applicationid)->update([
            'status'=> $status,
            'shortlistingdate'=>$shortlistingdate,
            'shortlistedby'=>$shortlistedby,

        ]);

            ShortlistingLogger::insert([
                'stage'=>$request->stageid,
                'vacancyid'=>$request->vacancyid,
                'applicationid'=>$request->applicationid,
                'userid'=>Auth::user()->id,
            ]);

        $notification=array(
            'message'=>'Shortlisting  Inserted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('start.shortlist',$request->stageid)->with($notification);

    }


public function FinalShortlists($id){
//    $stage=ShortlingStages::findOrFail($id);
//    group by u.id
    $myvacancy=Vacancies::where('id',$id)->latest()->first();
    $applicants=DB::select('
        SELECT u.first_name,u.other_name,u.last_name,u.idnumber,u.phone,u.email,g.name as gender,hc.name as county,ja.status,ss.comments
        FROM job_applications ja  join
            users u on ja.userid=u.id JOIN genders g on u.gender=g.id join home_counties hc on u.county=hc.id left join selection_stages ss
                on ss.jobapplicationid=ja.id  and ss.vacancyid=? where ja.vacancyid=?

        ',[$id,$id]);

    return view('shortlisting.sfinal_shortlist',compact('applicants','myvacancy'));

}

    public function ProvisionalShortlists($id){

        $stage=ShortlingStages::findOrFail($id);
        $myvacancy=Vacancies::where('id',$stage->vacancyid)->latest()->first();
        $applicants=DB::select('
        SELECT u.first_name,u.other_name,u.last_name,u.idnumber,u.phone,u.email,g.name as gender,hc.name as county,ja.status,ss.comments
        FROM shortlisting_loggers sl join job_applications ja on ja.id=sl.applicationid join
            users u on ja.userid=u.id JOIN genders g on u.gender=g.id join home_counties hc on u.county=hc.id left join selection_stages ss
                on ss.jobapplicationid=ja.id  and ss.vacancyid=? where sl.vacancyid=? and ss.StageID is null or ss.StageID=? group by u.id

        ',[$stage->vacancyid,$stage->vacancyid,$id]);

if($stage->status=1)
{
    return view('shortlisting.provisional_shortlist',compact('myvacancy','applicants','stage'));

}
else
{
    return view('shortlisting.final_shortlist',compact('myvacancy','applicants','stage'));

}



    }

    public function CloseShortlist($sid,$vid){
        $stage=ShortlingStages::findOrFail($sid);
        $myvacancy=Vacancies::where('id',$vid)->latest()->first();
        $applicants=JobApplication::where('vacancyid',$vid)->where('status','Applied')->count();
        if($applicants>0)
        {
            return 'Cannot Close The Shortlist Since Some Applications Are Pending';
        }
        else
        {
            $stage->status=0;
            $stage->Save();
        }
        return  redirect()->route('all.shortlist');

    }
}

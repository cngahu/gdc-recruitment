<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AcademicLevels;
use App\Models\CourseCategory;
use App\Models\EducationQualifications;
use App\Models\Experience;
use App\Models\JobApplication;
use App\Models\JobApplicationDocument;
use App\Models\JobSeekerDoc;
use App\Models\ProffessionalMembership;
use App\Models\ProffessionalQual;
use App\Models\SelectionDBQueries;
use App\Models\SelectionStages;
use App\Models\TempInSelection;
use App\Models\User;
use App\Models\Vacancies;
use App\Models\VacancyResets;
use App\Service\PanelVerificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    //

    public function AllAppliedJobs(){
        $jobs=Vacancies::orderBy('id','DESC')->get();
        return view('backend.jobs.jobs_applied',compact('jobs'));
    }

    public function JobApplicants($vid){
        $user=User::where('id',Auth::user()->id)->first();
        $vacancy=Vacancies::findOrFail($vid);
        $applicants=JobApplication::where('vacancyid',$vid)->get();

        if($user->role=='panelist')
        {
            return view('backend.jobs.panelist_applicants',compact('applicants','vacancy','vid'));

        }
        else
        {
            return view('backend.jobs.jobs_applicants',compact('applicants','vacancy','vid'));

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
        $jobdocs=JobSeekerDoc::where('userid',$id)->get()->all();

//        $uploaddocs=JobApplicationDocument::where('jobapplicationid',$vid)->get();
        $uploaddocs=JobApplicationDocument::where('vacancyid',$jobapplication->vacancyid)->where('userid',$id)->get();

        $user=User::where('id',Auth::user()->id)->first();
        if($user->role=='panelist')
        {
            return view('backend.jobs.panelist_applicant_profile',compact('vacancy','jobdocs','uploaddocs','id','memberships','workexperience','educationquals','userid','proffessionalquals'));

        }
        else
        {
            return view('backend.jobs.applicant_profile',compact('vacancy','uploaddocs','jobdocs','id','memberships','workexperience','educationquals','userid','proffessionalquals'));

        }

    }

    public function Stage1default($vid){
        $vacancy=Vacancies::findOrFail($vid);
        $applicants=JobApplication::where('vacancyid',$vid)->where('status',"!=",'dropped')->get();
        $academiclevel=AcademicLevels::orderBy('Weight')->get();
        $courecategories=CourseCategory::get()->all();

        return view('backend.jobs.stage1',compact('academiclevel','applicants','vacancy','vid','courecategories'));
    }
    public function Stage1a($vid)
    {
        try {
            // Check if the panel is ready for filtering
            if (!PanelVerificationService::isPanelReadyForFiltering($vid)) {
                $notification = array(
                    'message' => 'The panel is not fully ready. A chair and at least one member or secretary must be logged in to proceed.',
                    'alert-type' => 'error'
                );
                return redirect()->route('all.jobs')->with($notification);
            }

            // Fetch the necessary data
            $vacancy = Vacancies::findOrFail($vid);  // Get the vacancy
            $applicants = JobApplication::where('vacancyid', $vid)
                ->where('status', '!=', 'dropped')
                ->get();  // Get the applicants for the vacancy

            $academiclevel = AcademicLevels::orderBy('Weight')->get();  // Get the academic levels
            $courecategories = CourseCategory::get()->all();  // Get the course categories

            // Return the view with the fetched data
            return view('backend.jobs.stage1', compact('academiclevel', 'applicants', 'vacancy', 'vid', 'courecategories'));

        } catch (\Exception $e) {
            // Handle any exceptions and redirect with an error message
            $notification = array(
                'message' => 'An error occurred while processing the stage. ' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('all.jobs')->with($notification);
        }
    }
    public function Stage1($vid)
    {
        try {
            // Perform a detailed panel verification
            $panelVerification = PanelVerificationService::isPanelReadyForFiltering($vid);

//            if (!$panelVerification['status']) {
//                // Handle specific panel verification errors
//                $notification = array(
//                    'message' => $panelVerification['message'],
//                    'alert-type' => 'error'
//                );
//                return redirect()->route('all.jobs')->with($notification);
//            }

            // Fetch the necessary data
            $vacancy = Vacancies::findOrFail($vid);  // Get the vacancy
            $applicants = JobApplication::where('vacancyid', $vid)
                ->where('status', '!=', 'dropped')
                ->get();  // Get the applicants for the vacancy

            $academiclevel = AcademicLevels::orderBy('Weight')->get();  // Get the academic levels
            $courecategories = CourseCategory::get()->all();  // Get the course categories

            // Return the view with the fetched data
            return view('backend.jobs.stage1', compact('academiclevel', 'applicants', 'vacancy', 'vid', 'courecategories'));

        } catch (\Exception $e) {
            // Handle any exceptions and redirect with an error message
            $notification = array(
                'message' => 'An error occurred while processing the stage. ' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('all.jobs')->with($notification);
        }
    }

    public function Applyfilter(Request $request){

        $vacancy=Vacancies::findOrFail($request->vacancyid);
        $academiclevel=AcademicLevels::orderBy('Weight')->get();
        $courecategories=CourseCategory::get()->all();

        $academiclevel=AcademicLevels::orderBy('Weight')->get();
        $specific_academic_level=AcademicLevels::where('id',$request->academiclevel)->value('Weight');

        $conditional_category="";
        $conditional_ands="u.highest_weight >={$specific_academic_level}";
        $conditional_professional="";
        $conditional_membership="";
        $conditional_experience="";
        $conditional_minage="";
        $conditional_maxage="";
        $conditional_disability="";
        $coursecategoryvalue =1;

        if(isset($request->exclude))
        {

            $conditional_ands="u.highest_academic_level ={$request->academiclevel}";
        }
        if(isset($request->coursecategory))
        {
            $coursecategoryvalue =implode(',',$request->coursecategory);
            $conditional_category="and eq.course_category in ($coursecategoryvalue)";

        }
        if(isset($request->professional))
        {
            $selected_option=$request->professional=="Yes"?1:0;
            $conditional_professional="and u.no_certifications ={$selected_option}";
        }
        if(isset($request->membership))
        {

            $selected_option=$request->membership=="Yes"?1:0;
            $conditional_membership="and u.no_membership ={$selected_option}";
        }
        if($request->experience != null)
        {
//            dd($request->experience);
            $conditional_experience="and u.years_of_experience >={$request->experience}";
        }
        if($request->minage != null)
        {
            $conditional_minage="and u.age >={$request->minage}";
        }
        if($request->maxage != null)
        {
            $conditional_maxage="and u.age <={$request->maxage}";
        }
        if(isset($request->disability))
        {

            $conditional_disability="or (u.disability ='Yes')";
        }

//dd($coursecategoryvalue);
DB::enableQueryLog();
        $res = DB::select('

    SELECT  u.id,u.first_name,u.other_name,u.last_name,u.idnumber,u.disability,ja.id as ja,hc.name as county,gd.name as gender,v.jobTitle,hal.name as hal FROM users u
    join job_applications ja on ja.userid=u.id
        join education_qualifications eq on eq.userid=u.id
        join home_counties hc on hc.id=u.county
        join genders gd on gd.id=u.gender
        join vacancies v on ja.vacancyid=v.id
        join academic_levels al on eq.academiclevel=al.id
       join academic_levels hal on u.highest_academic_level=hal.id


     where  ('.$conditional_ands.' and ja.vacancyid=? '.$conditional_category.' '.$conditional_professional.' '.$conditional_membership.' '.$conditional_experience.' '.$conditional_minage.' '.$conditional_maxage.')
     '.$conditional_disability.' and ja.status !="dropped"
    GROUP BY u.id
       ',[$request->vacancyid]);

//        dd($res);
        $querylog=DB::getQueryLog();

        $queryid=SelectionDBQueries::insertGetId([
            'vacancyid'=>$request->vacancyid,
            'userid'=>Auth::user()->id,
            'query'=>$querylog[0]['query'],
            'bindings'=>implode(',',$querylog[0]['bindings']),
            'created_at'=>Carbon::now(),
        ]);

        return view('backend.jobs.stage11',compact('res','queryid','vacancy','academiclevel','courecategories','academiclevel'));

    }

    public  function SubmitFilterResult(Request $request){

                    $not_in_ids=DB::select('
            SELECT ja.id from job_applications ja
            where ja.id not in (SELECT jobapplicationid from temp_in_selections where vacancyid=?) and vacancyid=? and status !=?
                    ',[$request->vacancyid,$request->vacancyid,'dropped']);

        foreach($not_in_ids as $item)
        {
            SelectionStages::insert([
                'jobapplicationid'=>$item->id,
                'vacancyid'=>$request->vacancyid,
                'stage'=>1,
                'status'=>0,
                'comments'=>$request->comments,
                'userid'=>Auth::user()->id,
                'queryid'=>$request->queryid,
                'created_at'=>Carbon::now(),
            ]);

            JobApplication::findOrFail($item->id)->update([
                'status'=>'dropped',
            ]);
        }

        return redirect()->route('all.jobs');


    }

    public function Stage1Reset($vid){



        JobApplication::where('vacancyid',$vid)->where('status','dropped')->update([
            'status'=>'Applied',

        ]);

        VacancyResets::insert([
            'vacancyid'=>$vid,
            'userid'=>Auth::user()->id,
            'created_at'=>Carbon::now(),
        ]);

        SelectionStages::where('vacancyid',$vid)->delete();
        TempInSelection::where('vacancyid',$vid)->delete();

        $notification = array(
            'message' => 'Stage Reset Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.jobs')->with($notification);
    }

    public function Stage1Close($vid){

        Vacancies::where('id',$vid)->update([
            'status'=>'Shortlisting',

        ]);


        $notification = array(
            'message' => 'Stage Closed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.jobs')->with($notification);
    }
  public function Stage1Report($vid){
        $vacancy=Vacancies::findOrFail($vid);
        $applicants=DB::select('
SELECT ss.comments,ja.status,u.first_name,u.other_name,u.last_name,g.name as gender,u.disability,u.age,u.disability,ss.comments FROM job_applications ja

 join users u on ja.userid=u.id
    join genders g on u.gender=g.id
left join selection_stages ss on ja.id=ss.jobapplicationid and ss.vacancyid=?
where ja.vacancyid=?;
        ',[$vid,$vid]);
      return view('backend.jobs.stage1report',compact('applicants','vacancy'));


  }


}



//SELECT  u.id,u.first_name,u.other_name,u.last_name,u.idnumber,u.disability,ja.id as ja,hc.name,gd.name,v.jobTitle as gender FROM users u
//    join job_applications ja on ja.userid=u.id
//        join education_qualifications eq on eq.userid=u.id
//        join home_counties hc on hc.id=u.county
//        join genders gd on gd.id=u.gender
//        join vacancies v on ja.vacancyid=v.id
//        join academic_levels al on eq.academiclevel=al.id
//
//     where  (eq.academiclevel=? or al.Weight >= '.$specific_academic_level.' ) and ja.vacancyid=?
//    GROUP BY u.id
//       ',[$request->academiclevel,$request->vacancyid]);

<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Models\LeadershipCourse;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadershipCourseController extends Controller
{
    //
    public function LeadershipCourseProfile(){
        $userid=Auth::user()->id;
        $lc_qual=LeadershipCourse::where('user_id',$userid)->get()->all();
        $ccount=LeadershipCourse::where('user_id',$userid)->count();
        $user=User::findOrFail($userid);



        return view('applicant.apply.leadership_all',compact('ccount','user','userid','lc_qual'));
    }

    public function LeadershipCourseStore(Request $request){
        $request->validate([
            'certificate'=>'nullable|mimes:pdf'
        ],
            [
                'certificate.mimes:pdf'=>'Please Upload A PDF Document',


            ]

        );

        $proffqualid= LeadershipCourse::insertGetId([

            'user_id' => Auth::user()->id,
//            'startDate' => $request->startDate,
            'exitDate' => $request->exitDate,
            'institutionName' => $request->institutionName,
            'courseName' => $request->courseName,
            'grade' => $request->grade,
            'certificate' => "",
            'entryDate' => Carbon::now(),
            'created_at'=>Carbon::now(),
        ]);

        //Synopsis
        if($request->certificate != null) {
            $certificate ='LC-'. $proffqualid. '.' . $request->certificate->extension();
            $request->certificate->move(public_path('upload/lc/'), $certificate);
            $certificate_url = 'upload/lc/' . $certificate;
        }
        else{
            $certificate_url=null;
        }
        $proffqual=LeadershipCourse::findOrFail($proffqualid);
        $proffqual->certificate=$certificate_url;
        $proffqual->save();
        $this->UpdateLevel(Auth::user()->id);
        $notification = array(
            'message' => 'Leadership Course  Saved Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('applicant.leadership')->with($notification);

    }
    public function LeadershipCourseNoQualsStore(Request $request){

        $proffquals=LeadershipCourse::where('user_id',$request->userid)->count();
        $user=User::findOrFail($request->userid);


        if($proffquals==0)
        {
            User::findOrFail($request->userid)->update([

                'leadership' => 0,
                'level'=>$user->level>7?$user->level:7,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Leadership Course Details Saved Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('applicant.applicantdoc')->with($notification);
        }
        else
        {
            $notification = array(
                'message' => 'You Already Have Some Leadership Courses',
                'alert-type' => 'danger'
            );
            return redirect()->route('applicant.leadership')->with($notification);
        }








    }


    public function LeadershipCourseEdit($id)
    {
        try {
            // Fetch the leadership course entry that matches the given ID and belongs to the logged-in user
            $proffqual = LeadershipCourse::where('id', $id)
                ->where('user_id', auth()->id()) // Ensure the user ID matches the logged-in user's ID
                ->firstOrFail();

            // If the record is found and valid, show the edit view
            return view('applicant.apply.leadership_edit', compact('proffqual'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // If the record is not found or does not belong to the user
            $notification = [
                'message' => 'An error occurred: The specified leadership course was not found or is not accessible.',
                'alert-type' => 'danger',
            ];
            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // Handle any other unexpected errors
            $notification = [
                'message' => 'An unexpected error occurred while trying to access the leadership course. Please try again.',
                'alert-type' => 'danger',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function LeadershipCourseUpdate(Request $request){

        $proffqual_id = $request->id;
        $old_cert = $request->oldcert;

        if ($request->file('certificate')) {
            $request->validate([
                'certificate'=>'nullable|mimes:pdf'
            ],
                [
                    'certificate.mimes:pdf'=>'Please Upload A PDF Document',


                ]

            );

            if (file_exists($old_cert)) {
                unlink($old_cert);
            }
            $certificate ='PQ-'. $proffqual_id . '.' . $request->certificate->extension();
            $request->certificate->move(public_path('upload/proffqual/'), $certificate);
            $certificate_url = 'upload/proffqual/' . $certificate;



            LeadershipCourse::findOrFail($proffqual_id)->update([

//                'startDate' => $request->startDate,
                'exitDate' => $request->exitDate,
                'institutionName' => $request->institutionName,
                'courseName' => $request->courseName,
                'grade' => $request->grade,
                'certificate' => $certificate_url,
                'updated_at'=>Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Leadership Course Updated with Certificate Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('applicant.leadership')->with($notification);

        } else {

            LeadershipCourse::findOrFail($proffqual_id)->update([

//                'startDate' => $request->startDate,
                'exitDate' => $request->exitDate,
                'institutionName' => $request->institutionName,
                'courseName' => $request->courseName,
                'grade' => $request->grade,

                'updated_at'=>Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Leadership Course Updated  Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('applicant.leadership')->with($notification);

        } // end else

    }// End Method

    public function LeadershipCourseDelete($id){

        $proffqual = LeadershipCourse::findOrFail($id);
        $cert = $proffqual->certificate;
        unlink($cert );

        LeadershipCourse::findOrFail($id)->delete();
        $this->DowngradeLevel($proffqual->userid);
        $notification = array(
            'message' => 'Leadership Course Deleted Successfully',
            'alert-type' => 'success'
        );

//        return redirect()->back()->with($notification);
        return redirect()->route('applicant.leadership')->with($notification);
    }// End Method

    private function UpdateLevel($id)
    {
        $user=User::findOrFail($id);
        if($user->level==6)
        {
            $user->leadership=1;
            $user->level=7;
        }
        if($user->level>=7)
        {
//            $user->no_certifications=1;
            $user->leadership=1;

        }
        $user->Save();
    }

    private function DowngradeLevel($id)
    {
        if(LeadershipCourse::where('user_id',$id)->count()==0)
        {
            $user=User::findOrFail($id);
//            $user->no_certifications=0;
            $user->level=$user->level>7?$user->level:6;

            $user->Save();
        }

    }
}

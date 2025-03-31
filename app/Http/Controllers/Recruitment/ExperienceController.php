<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    //
    public function ExperienceProfile(){
        $userid=Auth::user()->id;
        $experience=Experience::where('userid',$userid)->get()->all();
        $ccount=Experience::where('userid',$userid)->count();
        $user=User::findOrFail($userid);

        return view('applicant.apply.experience_all',compact('ccount','user','userid','experience'));
    }

    public function ExperienceStore(Request $request){
//dd($request);
//        $experienceid= Experience::insertGetId([
//
//            'userid' => Auth::user()->id,
//            'company' => $request->company,
//            'jobTitle' => $request->jobTitle,
//            'Duties' => $request->Duties,
//            'startDate' => $request->startDate,
//            'isCurrent' => $request->current=="Yes" ? 1 :0,
//            'exitDate' => $request->current=="No" ? $request->exitDate :null,
//            'exitReasons' => $request->current=="No" ? $request->exitReasons :"",
//            'created_at'=>Carbon::now(),
//        ]);
//
//        $this->UpdateLevel(Auth::user()->id);

        $experience = Experience::create([
            'userid' => Auth::user()->id,
            'company' => $request->company,
            'jobTitle' => $request->jobTitle,
            'Duties' => $request->Duties,
            'startDate' => $request->startDate,
            'isCurrent' => $request->current == "Yes" ? 1 : 0,
            'exitDate' => $request->current == "No" ? $request->exitDate : null,
            'exitReasons' => $request->current == "No" ? $request->exitReasons : "",
            'created_at' => Carbon::now(),
        ]);

        $this->UpdateLevel(Auth::user()->id);
        $notification = array(
            'message' => 'Experience Saved Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('applicant.experience')->with($notification);

    }

    private function UpdateLevel($id)
    {
        $user=User::findOrFail($id);
        if($user->level==5)
        {
            $user->level=6;
            $user->no_experience=1;
        }
       elseif($user->level==6)
        {

            $user->no_experience=1;
        }
        elseif($user->level>6)
        {

            $user->no_experience=1;
        }

        $user->Save();
    }

    public function ExperienceEdit($id){

        $experience = Experience::findOrFail($id);

        return view('applicant.apply.experience_edit',compact('experience',));

    }

    public function ExperienceUpdate(Request $request){






            Experience::findOrFail($request->id)->update([
                'company' => $request->company,
                'jobTitle' => $request->jobTitle,
                'Duties' => $request->Duties,
                'startDate' => $request->startDate,
//                'isCurrent' => $request->current=="Yes" ? 1 :0,
                'exitDate' => $request->current==0 ? $request->exitDate :null,
                'exitReasons' => $request->current==0 ? $request->exitReasons :"",
                'updated_at'=>Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Experience Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('applicant.experience')->with($notification);




    }// End Method

    public function ExperienceDelete($id){

        $experience = Experience::findOrFail($id);


        Experience::findOrFail($id)->delete();
        $this->DowngradeLevel($experience->userid);
        $notification = array(
            'message' => 'Experience  Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method
    private function DowngradeLevel($id)
    {
        if(Experience::where('userid',$id)->count()==0)
        {
            $user=User::findOrFail($id);

            if($user->level==6)
            {
                $user->level=5;
                $user->no_experience=0;
                $user->Save();
            }
            if($user->level>6)
            {
                $user->no_experience=0;
                $user->Save();
            }

        }

    }

    public function NoExperienceStore(Request $request){

        $experiences=Experience::where('userid',$request->userid)->count();
        $user=User::findOrFail($request->userid);


        if($experiences==0)
        {
            User::findOrFail($request->userid)->update([

                'no_experience' => 0,
                'level'=>$user->level>6?$user->level:6,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'No Experience Saved Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('applicant.applicantdoc')->with($notification);
        }
        else
        {
            $notification = array(
                'message' => 'You Already Have Some Added Experiences',
                'alert-type' => 'danger'
            );
            return redirect()->route('applicant.experience')->with($notification);
        }




    }
}

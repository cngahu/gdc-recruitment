<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;

use App\Models\constituency;
use App\Models\Designations;
use App\Models\EducationQualifications;
use App\Models\ethnicity;
use App\Models\Experience;
use App\Models\gender;
use App\Models\home_county;
use App\Models\JobSeekerDoc;
use App\Models\marital_status;
use App\Models\nationality;
use App\Models\ProffessionalMembership;
use App\Models\ProffessionalQual;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AccountController extends Controller
{
    //
    public function GetConstituencies($id){
        $subcat = constituency::where('countyid',$id)->orderBy('name','ASC')->get();
        return json_encode($subcat);
    }
    public function Register(){
        $user=User::where('id', Auth::user()->id)->first();
//        $designation=DB::table('designations')->select('id','name')->get();
//        $gender=DB::table('genders')->select('id','name')->get();
//        $nationality=DB::table('countries')->select('id','name')->get();
//
//        $county=DB::table('counties')->select('id','name')->get();
        $designation=Designations::get()->all();
        $gender=gender::get()->all();
        $nationality=nationality::get()->all();
        $ethnicity=ethnicity::get()->all();
        $county=home_county::get()->all();
        $constituency=constituency::get()->all();
        $marital=marital_status::get()->all();

        return view('applicant.apply.account',compact('user','nationality','ethnicity','constituency','county','marital','designation','gender'));

    }

    public function RegisterUpdate(Request $request){
        $request->validate([
            'reg_certificate'=>'nullable|mimes:pdf'
        ],
        [
        'reg_certificate.mimes:pdf'=>'Please Upload A PDF Document',


        ]

        );

        if ($request->file('reg_certificate')) {


            $certificate = $request->userid . '.' . $request->reg_certificate->extension();
            $request->reg_certificate->move(public_path('upload/disability/'), $certificate);
            $certificate_url = 'upload/disability/' . $certificate;
        }
        else{
            $certificate_url ="";
        }


        User::findOrFail($request->userid)->update([

            'idnumber' => $request->idnumber,
            'first_name' => $request->first_name,
            'other_name' => $request->other_name,
            'last_name' => $request->last_name,
//            'kra' => $request->kra,
            'gender' => $request->gender,
            'title' => $request->title,
             'dob' => $request->dob,
            'nationality' => 115,
            'ethnicity' => $request->ethnicity,
            'county' => $request->county,
            'constituency' => $request->constituency_id,
//            'constituency' =>$request->constituency,
            'postal_address' => $request->postal_address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'phone' =>$request->phone,
            'marital' => 5,
            'disability' =>$request->disability,
            'disability_reg' =>$request->disability="Yes"? $request->disability_reg:0,
            'disability_desc' => $request->disabilitydesc,


            'disabilitydescription' => $request->disabilitydescription,
            'disability_cert'=>$certificate_url,
            'level' => 2,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('applicant.alleducation')->with($notification);
    }

    public function Profile($id){
        if(Auth::user()->id != $id)
        {
            return "An error occurred";
        }
        $user=User::findOrFail($id);
        $designation=Designations::get()->all();
        $gender=gender::get()->all();
        $nationality=nationality::get()->all();
        $ethnicity=ethnicity::get()->all();
        $county=home_county::get()->all();
        $constituency=constituency::get()->all();
        $marital=marital_status::get()->all();

        return view('applicant.apply.applicant_profile',compact('user','nationality','ethnicity','constituency','county','marital','designation','gender'));
    }
    public function DisabilityProfile($id){
        $user=User::findOrFail($id);
        $designation=Designations::get()->all();
        $gender=gender::get()->all();
        $nationality=nationality::get()->all();
        $ethnicity=ethnicity::get()->all();
        $county=home_county::get()->all();
        $constituency=constituency::get()->all();
        $marital=marital_status::get()->all();
        return view('applicant.apply.applicant_profile_disability',compact('user','nationality','ethnicity','constituency','county','marital','designation','gender'));
    }

    public function ProfileUpdate(Request $request){

//        if ($request->file('reg_certificate')) {
//
//
//            $certificate = $request->userid . '.' . $request->reg_certificate->extension();
//            $request->reg_certificate->move(public_path('upload/disability/'), $certificate);
//            $certificate_url = 'upload/disability/' . $certificate;
//        }
//        else{
//            $certificate_url ="";
//        }


        User::findOrFail($request->userid)->update([

            'idnumber' => $request->idnumber,
            'gender' => $request->gender,
            'title' => $request->title,
            'dob' => $request->dob,

            'ethnicity' => $request->ethnicity,
            'county' => $request->county,

            'postal_address' => $request->postal_address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'phone' =>$request->phone,
            'constituency' => $request->constituency_id,
//            'marital' => $request->marital,
//            'disability' =>$request->disability,
//            'disabilitydescription' => $request->disabilitydescription,
//            'disability_cert'=>$certificate_url,

            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('applicant.profile',$request->userid)->with($notification);
    }
    public function ProfileUpdateDisability(Request $request){

        $request->validate([
            'reg_certificate'=>'nullable|mimes:pdf'
        ],
            [
                'reg_certificate.mimes:pdf'=>'Please Upload A PDF Document',


            ]

        );

        $disabilitycert = User::where('id',$request->userid)->value('disability_cert');
//        dd($disabilitycert);
//        $cert = $request->userid;
        if($disabilitycert != null)
        {
//            $file_path =  asset('upload/disability/'.$disabilitycert);
            unlink( $disabilitycert);
        }

        if ($request->file('reg_certificate')) {

            $certificate = $request->userid . '.' . $request->reg_certificate->extension();
            $request->reg_certificate->move(public_path('upload/disability/'), $certificate);
            $certificate_url = 'upload/disability/' . $certificate;
        }
        else{
            $certificate_url ="";
        }

        if($request->disability=='No')
        {

            User::findOrFail($request->userid)->update([

                'disability' =>$request->disability,
                'disability_reg' =>0,
                'disability_desc' => '',
                'disabilitydescription' => '',
                'disability_cert'=>'',
                'updated_at' => Carbon::now(),
            ]);



        }
        else{




            User::findOrFail($request->userid)->update([

                'disability' =>$request->disability,
                'disability_reg' =>$request->disability_reg,
                'disability_desc' => $request->disabilitydesc,
                'disabilitydescription' => $request->disabilitydescription,
                'disability_cert'=>$certificate_url,
                'updated_at' => Carbon::now(),
            ]);
        }



        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('applicant.profile',$request->userid)->with($notification);
    }

    public function CompleteProfile(){
        $user=User::where('id',Auth::user()->id)->first();
        $designation=Designations::get()->all();
        $gender=gender::get()->all();
        $nationality=nationality::get()->all();
        $constituency=constituency::get()->all();
        $ethnicity=ethnicity::get()->all();
        $county=home_county::get()->all();
        $marital=marital_status::get()->all();
        $edu_profile=EducationQualifications::where('userid',$user->id)->get()->all();
        $proff_qual=ProffessionalQual::where('userid',$user->id)->get()->all();
        $proff_memb=ProffessionalMembership::where('userid',$user->id)->get()->all();
        $experience=Experience::where('userid',$user->id)->get()->all();
        $jobdocs=JobSeekerDoc::where('userid',$user->id)->get()->all();
//        return view('applicant.apply.complete_profile',compact('ethnicity','county','marital','edu_profile','proff_qual','proff_memb','experience','jobdocs','user','designation','gender','nationality'));
        return view('applicant.apply.complete_profile2',compact('constituency','ethnicity','county','marital','edu_profile','proff_qual','proff_memb','experience','jobdocs','user','designation','gender','nationality'));

    }
}

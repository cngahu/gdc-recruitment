<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Models\AcademicLevels;
use App\Models\Category;
use App\Models\CourseCategory;
use App\Models\EducationQualifications;
use App\Models\Grades;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    //

    public function EducationProfile(){
        $userid=Auth::user()->id;
       $edu_profile=EducationQualifications::where('userid',$userid)->get()->all();
        $academiclevels=AcademicLevels::get()->all();
        $grade=Grades::get()->all();
        $categories=CourseCategory::get()->all();

       return view('applicant.apply.education_all',compact('userid','edu_profile','academiclevels','grade','categories'));

    }

    public function EducationStore(Request $request){

        $request->validate([
            'certificate'=>'nullable|mimes:pdf'
        ],
            [
                'certificate.mimes:pdf'=>'Please Upload A PDF Document',


            ]

        );
        $educationid= EducationQualifications::insertGetId([

            'userid' => Auth::user()->id,
            'academiclevel' => $request->academiclevel,
//            'startDate' => $request->startDate,
            'exitDate' => $request->exitDate,
            'institutionName' => $request->institutionName,
            'courseName' => $request->courseName,
            'course_category' => $request->course_category,
            'grade' => $request->grade,
            'certNo' => $request->certNo,
            'certificate' => "",
            'entryDate' => Carbon::now(),
            'created_at'=>Carbon::now(),
        ]);


        if($request->certificate != null) {
            $certificate ='EQ-'. $educationid . '.' . $request->certificate->extension();
            $request->certificate->move(public_path('upload/educationqual/'), $certificate);
            $certificate_url = 'upload/educationqual/' . $certificate;
        }
        else{
            $certificate_url=null;
        }
        $eduprofile=EducationQualifications::findOrFail($educationid);
        $eduprofile->certificate=$certificate_url;
        $eduprofile->save();
        $this->UpdateLevel(Auth::user()->id);
        $notification = array(
            'message' => 'Education Qualification Saved Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('applicant.alleducation')->with($notification);

    }

    public function EducationEdit($id){
        $education = EducationQualifications::findOrFail($id);
        $academiclevels=AcademicLevels::get()->all();
        $grade=Grades::get()->all();
        $categories=CourseCategory::get()->all();
        return view('applicant.apply.education_edit',compact('education','academiclevels','grade','categories'));

    }// End Method


    public function EducationUpdate(Request $request){

//      dd($request);
        $edu_id = $request->id;
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
            $certificate = $edu_id . '.' . $request->certificate->extension();
            $request->certificate->move(public_path('upload/educationqual/'), $certificate);
            $certificate_url = 'upload/educationqual/' . $certificate;



            EducationQualifications::findOrFail($edu_id)->update([
                'academiclevel' => $request->academiclevel,
//                'startDate' => $request->startDate,
                'exitDate' => $request->exitDate,
                'institutionName' => $request->institutionName,
                'courseName' => $request->courseName,
                'course_category' => $request->course_category,
                'grade' => $request->grade,
                'certNo' => $request->certNo,
                'certificate' => $certificate_url,
                'updated_at'=>Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Education Qualification Updated with Certificate Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('applicant.alleducation')->with($notification);

        } else {

            EducationQualifications::findOrFail($edu_id)->update([
                'academiclevel' => $request->academiclevel,
                'startDate' => $request->startDate,
                'exitDate' => $request->exitDate,
                'institutionName' => $request->institutionName,
                'courseName' => $request->courseName,
                'grade' => $request->grade,
                'certNo' => $request->certNo,
                'updated_at'=>Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Education Qualification Updated  Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('applicant.alleducation')->with($notification);

        } // end else

    }// End Method


    public function EducationDelete($id){

        $education = EducationQualifications::findOrFail($id);
        $cert = $education->certificate;
        unlink($cert );

        EducationQualifications::findOrFail($id)->delete();
  $this->DowngradeLevel($education->userid);
        $notification = array(
            'message' => 'Education Qualification Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

    private function UpdateLevel($id)
    {
        $user=User::findOrFail($id);
        if($user->level==2)
        {
            $user->level=3;
        }
             $user->Save();
    }
    private function DowngradeLevel($id)
    {
        if(EducationQualifications::where('userid',$id)->count()==0)
        {
            $user=User::findOrFail($id);

                $user->level=2;

            $user->Save();
        }

    }




}

<?php

namespace App\Http\Controllers;

use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function AdminDashboard(){
        $vacancies=Vacancies::latest()->get()->all();

        return view('index',compact('vacancies'));
    }//end

    public function ShortlistFinal(){
        $vacancies=Vacancies::latest()->get()->all();

        return view('shortlistfinal',compact('vacancies'));

    }


    public function PanelistDashboard(){
        $user=User::where('id',Auth::user()->id)->first();
        $vacancyid=User::where('id',Auth::user()->id)->value('vacancy_id');
    $vacancies=Vacancies::where('id',$vacancyid)->get();
        if($user->must_change==1)
        {

            return redirect()->route('panelist.firsttime');
//            return view('applicant.index', compact('user', 'vacancies', 'userType'));

        }

        return view('panelist.index',compact('vacancies'));
    }//end
    public function ApplicantDashboard(){
        $user=User::where('id',Auth::user()->id)->first();
        $userType=$user->user_type;
        if($user->must_change==1)
        {

            return redirect()->route('first.change.password');
//            return view('applicant.index', compact('user', 'vacancies', 'userType'));

        }
        else {
//        $vacancies = DB::table('vacancies')
//            ->join('recruitments', 'vacancies.Recruitmentid', '=', 'recruitments.id')
//            ->where('recruitments.closeDate', ">=",today())
//            ->select('vacancies.*', 'recruitments.closeDate as closedate')
//            ->get();
            $vacancies = DB::table('vacancies')
                ->join('recruitments', 'vacancies.Recruitmentid', '=', 'recruitments.id')
                ->when($userType != 'internal', function ($query) {
                    // For external users, select only external vacancies
                    return $query->where('vacancies.job_type', 'External');
                })
                ->where('recruitments.closeDate', '>=', today())
                ->select('vacancies.*', 'recruitments.closeDate as closedate')
                ->get();
            return view('applicant.index', compact('user', 'vacancies', 'userType'));

        }
        }//end method

    public function AdminLogin(){
        return view('admin.admin_login');
    } // End Mehtod
    public function AdminDestroy(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'info'
        );


        return redirect('/logout')->with($notification);
    } // End Method


    public function AdminLogoutPage(){

        return view('admin.admin_logout');

    }// End Method



    public function AdminProfile(){

        $id = Auth::user()->id;
        $adminData = User::find($id);
        if($adminData->role==1)
        {
                 return view('admin.admin_profile_view',compact('adminData'));

        }
        else{
                return view('applicant.admin.applicant_profile_view',compact('adminData'));

        }
    }// End Method


    public function AdminProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_image/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }// End Method


    public function ChangePassword(){
        $user=User::where('id',Auth::user()->id)->first();
        if($user->role==1)
        {
            return view('admin.change_password');
        }
        else{
            return view('applicant.admin.change_password');
        }

    }// End Method

    public function FirstTimeChangePassword(){
        $user=User::where('id',Auth::user()->id)->first();
        return view('applicant.admin.first_change_password');

    }// End Method

    public function PanelistFirstTime(){
        $user=User::where('id',Auth::user()->id)->first();
        return view('panelist.first_change_password');

    }// End Method



    public function UpdatePassword(Request $request){

        /// Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',

        ]);

        /// Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Dones not Match!!',
                'alert-type' => 'error'
            );
            return back()->with($notification);

        }

        //// Update The New Password

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
            'must_change'=>0
        ]);

        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);


    }// End Method
    public function FirstUpdatePassword(Request $request){

        $user=User::find(Auth::user()->id);

        /// Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',

        ]);

        /// Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Dones not Match!!',
                'alert-type' => 'error'
            );
            return back()->with($notification);

        }

        //// Update The New Password

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
            'must_change'=>0
        ]);

        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );
        if($user->role=='panelist')
        {
            return redirect()->route('panelist.dashboard')->with($notification);

        }

        return redirect()->route('applicant.dashboard')->with($notification);


    }// End Method





}


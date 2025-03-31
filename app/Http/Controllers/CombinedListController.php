<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Vacancies;
use Illuminate\Http\Request;

class CombinedListController extends Controller
{
    //

    public function CombinedReport($id){


        $applicants=JobApplication::with('user')->where('vacancyid',$id)->get();
        $myvacancy=Vacancies::findorFail($id);
        return view('combinedreport',compact('applicants','myvacancy'));
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Helper\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\ApplicantDocs;
use App\Models\JobApplication;
use App\Models\Recruitment;
use App\Models\User;
use App\Models\Vacancies;
use App\Models\VacancyDocuments;
use App\Service\AuditLogService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VacanciesController extends Controller
{
    //
    public function AllVacancies(){
        $vacancies = Vacancies::latest()->get();
        return view('backend.vacancies.all_vacancies',compact('vacancies'));
    } // End Method

    public function VacancyDetails0($id)
    {
        $vacancydetails=Vacancies::where('id',$id)->first();
        $docs=VacancyDocuments::where('vacancy_id',$id)->get();

        return view('vacancydetails',compact('id','vacancydetails','docs'));

    }


    public function VacancyDetails($id)
    {
        try {
            // Fetch the vacancy details and documents
            $vacancydetails = Vacancies::where('id', $id)->firstOrFail(); // throws exception if not found
            $docs = VacancyDocuments::where('vacancy_id', $id)->get();

            return view('vacancydetails', compact('id', 'vacancydetails', 'docs'));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error fetching vacancy details: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while retrieving the vacancy details.');
        }
    }

    public function VacancyDetailsAdmin($id)
    {
        $vacancydetails=Vacancies::where('id',$id)->first();
        $docs=VacancyDocuments::where('vacancy_id',$id)->get();

        return view('backend.vacancies.details',compact('id','vacancydetails','docs'));

    }
    public function updateVacancy0(Request $request){


        Vacancies::findOrFail($request->vacancyid)->update([

            'jobTitle' => $request->jobTitle,
            'jobDescription' => $request->jobDescription,
            'jobSpecification' => $request->jobSpecification,
            'positionCode' => $request->positionCode,
            'Positions' => $request->Positions,
            'VacancyReference' => $request->VacancyReference,
            'competence' => $request->competence,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
            'jobtype' => $request->jobtype,
            'job_type' => $request->job_type,
            'updated_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Vacancy Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('recruitment.vacancies',$request->recruitmentid)->with($notification);

    }
    public function updateVacancy(Request $request)
    {
        try {
            // Fetch the vacancy to update
            $vacancy = Vacancies::findOrFail($request->vacancyid);

            // Prepare updated data for the vacancy
            $updatedData = [
                'jobTitle' => $request->jobTitle,
                'jobDescription' => $request->jobDescription,
                'jobSpecification' => $request->jobSpecification,
                'positionCode' => $request->positionCode,
                'Positions' => $request->Positions,
                'VacancyReference' => $request->VacancyReference,
                'competence' => $request->competence,
                'min_salary' => $request->min_salary,
                'max_salary' => $request->max_salary,
                'jobtype' => $request->jobtype,
                'job_type' => $request->job_type,
                'updated_at' => Carbon::now(),
            ];

            // Update vacancy details
            $vacancy->update($updatedData);

            // Log the vacancy update
            AuditLogService::record(
                'Update',
                'Vacancy details updated.',
                'vacancies',
                $vacancy->id,
                $updatedData
            );

            // Update vacancy documents
            $vacancyId = $request->vacancyid;
            $currentDocs = VacancyDocuments::where('vacancy_id', $vacancyId)->pluck('document_id')->toArray();
            $selectedDocs = array_keys($request->fileid ?? []);

            // Documents to add and remove
            $docsToAdd = array_diff($selectedDocs, $currentDocs);
            $docsToRemove = array_diff($currentDocs, $selectedDocs);

            // Delete unchecked documents
            if (!empty($docsToRemove)) {
                VacancyDocuments::where('vacancy_id', $vacancyId)
                    ->whereIn('document_id', $docsToRemove)
                    ->delete();

                // Log removed documents
                AuditLogService::record(
                    'Delete',
                    'Removed vacancy documents.',
                    'vacancy_documents',
                    $vacancyId,
                    ['removed_documents' => $docsToRemove]
                );
            }

            // Insert new documents
            foreach ($docsToAdd as $documentId) {
                VacancyDocuments::insert([
                    'vacancy_id' => $vacancyId,
                    'document_id' => $documentId,
                ]);
            }

            // Log added documents
            if (!empty($docsToAdd)) {
                AuditLogService::record(
                    'Insert',
                    'Added new vacancy documents.',
                    'vacancy_documents',
                    $vacancyId,
                    ['added_documents' => $docsToAdd]
                );
            }

            // Prepare a success notification
            $notification = [
                'message' => 'Vacancy Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('recruitment.vacancies', $request->recruitmentid)->with($notification);

        } catch (\Exception $e) {
            // Log error in case of failure
            LogHelper::logError('Error updating vacancy: ' . $e->getMessage(), ['vacancy_id' => $request->vacancyid]);

            AuditLogService::record(
                'Error',
                'Error while updating vacancy.',
                'vacancies',
                $request->vacancyid,
                ['error_message' => $e->getMessage()]
            );

            return back()->withErrors(['message' => 'Failed to update the vacancy. Please try again later.']);
        }
    }

    public function RecruitmentVacancies($id){
        $recuitment=Recruitment::findOrFail($id);
        $vacancies = Vacancies::where('Recruitmentid',$id)->latest()->get();
        return view('backend.vacancies.recruitment_vacancies',compact('vacancies','recuitment'));
    } // End Method

    public function AddVacancy($id){
        $appdocs=ApplicantDocs::where('job_specific',1)->where('active',1)->get()->all();
        return view('backend.vacancies.add_vacancies',compact('id','appdocs'));
    } // End Method

    public function EditVacancy($id){
        $vacancy=Vacancies::findOrFail($id);
        $appdocs=ApplicantDocs::where('job_specific',1)->where('active',1)->get()->all();
        $docs=VacancyDocuments::where('vacancy_id',$id)->get();

        return view('backend.vacancies.edit_vacancies',compact('vacancy','appdocs','docs'));

    }


    public function StoreVacancy0(Request $request){


        $validateData = $request->validate([
            'jobTitle' => 'required|max:200',
            'job_type' => 'required',
            'jobDescription' => 'required',
            'jobSpecification' => 'required',
            'positionCode' => 'required|max:50',
            'Positions' => 'required',
            'VacancyReference' => 'required',
            'min_salary' => 'required',
            'max_salary' => 'required',
        ]);

       $vacancyid=Vacancies::insertGetId([

            'jobTitle' => $request->jobTitle,
            'jobDescription' => $request->jobDescription,
            'jobSpecification' => $request->jobSpecification,
            'positionCode' => $request->positionCode,
            'Positions' => $request->Positions,
            'VacancyReference' => $request->VacancyReference,
            'competence' => $request->competence,
           'jobtype' => $request->jobtype,
           'job_type' => $request->job_type,
           'min_salary' => $request->min_salary,
           'max_salary' => $request->max_salary,
            'Recruitmentid'=>$request->recruitmentid,
            'created_by'=>Auth::user()->id,
            'created_at' => Carbon::now(),

        ]);

       if(isset($request->fileid)) {
           foreach ($request->fileid as $key => $item) {


               VacancyDocuments::insert([
                   'vacancy_id' => $vacancyid,
                   'document_id' => $key,
               ]);

           }
       }

        $notification = array(
            'message' => 'Vacancy Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('recruitment.vacancies',$request->recruitmentid)->with($notification);

    } // End Method

    public function StoreVacancy(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'jobTitle' => 'required|max:200',
                'job_type' => 'required',
                'jobDescription' => 'required',
                'jobSpecification' => 'required',
                'positionCode' => 'required|max:50',
                'Positions' => 'required',
                'VacancyReference' => 'required',
                'min_salary' => 'required|numeric|min:0',
                'max_salary' => 'required|numeric|min:0|gte:min_salary',
            ]);

            // Insert the vacancy into the database
            $vacancyId = Vacancies::insertGetId([
                'jobTitle' => $request->jobTitle,
                'jobDescription' => $request->jobDescription,
                'jobSpecification' => $request->jobSpecification,
                'positionCode' => $request->positionCode,
                'Positions' => $request->Positions,
                'VacancyReference' => $request->VacancyReference,
                'competence' => $request->competence,
                'jobtype' => $request->jobtype,
                'job_type' => $request->job_type,
                'min_salary' => $request->min_salary,
                'max_salary' => $request->max_salary,
                'Recruitmentid' => $request->recruitmentid,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            // Handle vacancy documents if provided
            if (isset($request->fileid)) {
                foreach ($request->fileid as $key => $item) {
                    VacancyDocuments::insert([
                        'vacancy_id' => $vacancyId,
                        'document_id' => $key,
                    ]);
                }
            }

            // Log the successful transaction
            AuditLogService::record(
                'Create',
                'Vacancy created successfully',
                'Vacancies',
                $vacancyId,
                [
                    'jobTitle' => $request->jobTitle,
                    'min_salary' => $request->min_salary,
                    'max_salary' => $request->max_salary,
                ]
            );

            // Redirect with a success message
            return redirect()
                ->route('recruitment.vacancies', $request->recruitmentid)
                ->with('message', 'Vacancy Inserted Successfully')
                ->with('alert-type', 'success');
        } catch (\Exception $e) {
            // Log the error
            LogHelper::logError($e);

            // Audit the failed attempt
            AuditLogService::record(
                'Error',
                'Error occurred while creating vacancy',
                'Vacancies',
                null, // No record ID since the transaction failed
                [
                    'error_message' => $e->getMessage(),
                    'request_data' => $request->all(),
                ]
            );

            // Redirect back with an error message
            return redirect()
                ->back()
                ->withInput()
                ->with('message', 'An error occurred while creating the vacancy. Please try again.')
                ->with('alert-type', 'danger');
        }
    }

    public function deleteVacancy($id)
    {
        try {
            // Check if the vacancy has any job applications
            $applicationExists = JobApplication::where('vacancyid', $id)->exists();

            if ($applicationExists) {
                // Audit the unsuccessful delete attempt
                AuditLogService::record(
                    'Delete',
                    'Attempted to delete a vacancy with existing job applications',
                    'Vacancies',
                    $id,
                    ['vacancy_id' => $id]
                );

                // Return error response
                return redirect()
                    ->back()
                    ->with('message', 'Cannot delete a vacancy that already has applications applied for.')
                    ->with('alert-type', 'error');
            }

            // Proceed to delete the vacancy
            $vacancy = Vacancies::findOrFail($id);
            $vacancy->delete();

            // Audit the successful deletion
            AuditLogService::record(
                'Delete',
                'Vacancy deleted successfully',
                'Vacancies',
                $id,
                ['vacancy_id' => $id]
            );

            // Return success response
            return redirect()
                ->route('recruitment.vacancies', $vacancy->Recruitmentid)
                ->with('message', 'Vacancy deleted successfully.')
                ->with('alert-type', 'success');
        } catch (\Exception $e) {
            // Log the error
            LogHelper::logError($e);

            // Audit the error
            AuditLogService::record(
                'Error',
                'Error occurred while deleting vacancy',
                'Vacancies',
                $id,
                [
                    'error_message' => $e->getMessage(),
                    'vacancy_id' => $id,
                ]
            );

            // Return error response
            return redirect()
                ->back()
                ->with('message', 'An error occurred while deleting the vacancy. Please try again.')
                ->with('alert-type', 'danger');
        }
    }



    public function ApplicantVacancyDetails($id)
    {
        $role=User::where('id',Auth::user()->id)->value('role');

        $vacancydetails=Vacancies::where('id',$id)->first();
        if($role=='admin')
        {
            return view('backend.vacancies.adminvacancydetails',compact('id','vacancydetails'));

        }
        else
        {
            return view('applicant.apply.vacancydetails',compact('id','vacancydetails'));

        }

    }
}

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DesignationsController;
use App\Http\Middleware;
use App\Http\Controllers\Backend\GenderController;
use App\Http\Controllers\Backend\ConstituencyController;
use App\Http\Controllers\Backend\CountyController;
use App\Http\Controllers\Backend\NationalityController;
use App\Http\Controllers\Backend\EthnicityController;
use App\Http\Controllers\Recruitment\AccountController;
use App\Http\Controllers\Recruitment\EducationController;
use App\Http\Controllers\Recruitment\ProffessionalQualificationsController;
use App\Http\Controllers\Recruitment\ProffessionalMembershipsController;
use App\Http\Controllers\Recruitment\ExperienceController;
use App\Http\Controllers\Backend\ApplicantDocumentsController;
use App\Http\Controllers\Backend\RecruitmentController;
use App\Http\Controllers\Backend\VacanciesController;
use App\Http\Controllers\Recruitment\JobApplicationController;
use App\Http\Controllers\Backend\JobsController;
use App\Http\Controllers\Backend\PanelUsersController;
use App\Http\Controllers\Recruitment\JobCandidatesController;
use App\Http\Controllers\CombinedListController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Employee Routes
Route::controller(EmployeeController::class)->group(function(){

    Route::get('/all/employee','AllEmployee')->name('all.employee');
    Route::get('/add/employee','AddEmployee')->name('add.employee');
    Route::post('/store/employee','StoreEmployee')->name('employee.store');
    Route::get('/edit/employee/{id}','EditEmployee')->name('edit.employee');
    Route::post('/update/employee','UpdateEmployee')->name('employee.update');
    Route::get('/delete/employee/{id}','DeleteEmployee')->name('delete.employee');
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {

    return view('welcome')->name('welcomehome');
});
Route::get('/dashboard', function () {

    return view('auth.login')->name('dashboard');
});
//Route::get('applicant/dashboard', function () {
//    return view('applicant.index');
//})->middleware(['auth', 'verified'])->name('applicant.dashboard');


Route::controller(VacanciesController::class)->group(function () {

    Route::get('/vacancy/details/{id}', 'VacancyDetails')->name('vacancy.details');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/logout', [AdminController::class, 'AdminLogoutPage'])->name('admin.logout.page');

//Admin Routes
Route::middleware(['auth','verified'])->group(function (){
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change.password');
    Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update.password');

});



Route::controller(RecruitmentController::class)->group(function(){

    Route::get('/all/recruitment','AllRecruitment')->name('all.recruitment');
    Route::get('/add/recruitment','AddRecruitment')->name('add.recruitment');
    Route::post('/store/recruitment','StoreRecruitment')->name('recruitment.store');
    Route::get('/edit/recruitment/{id}','EditRecruitment')->name('edit.recruitment');
    Route::post('/update/recruitment','UpdateRecruitment')->name('recruitment.update');
    Route::get('/delete/recruitment/{id}','DeleteRecruitment')->name('delete.recruitment');
    Route::get('/extend/recruitment/{id}','ExtendRecruitment')->name('extend.recruitment');
    Route::post('/update/extend/recruitment','UpdateExtendRecruitment')->name('recruitment.updateextend');

});

Route::controller(VacanciesController::class)->group(function () {
    Route::get('/all/vacancies', 'AllVacancies')->name('all.vacancies');
    Route::get('/recruitment/vacancies/{id}', 'RecruitmentVacancies')->name('recruitment.vacancies');

    Route::get('/add/vacancies/{id}', 'AddVacancy')->name('add.vacancies');
    Route::get('/edit/vacancies/{id}', 'EditVacancy')->name('edit.vacancy');
    Route::post('/store/vacancies', 'StoreVacancy')->name('vacancies.store');
    Route::post('/update/vacancies', 'updateVacancy')->name('vacancies.update');
});

//Customer Routes
Route::controller(CustomerController::class)->group(function(){

    Route::get('/all/customer','AllCustomer')->name('all.customer');
    Route::get('/add/customer','AddCustomer')->name('add.customer');
    Route::post('/store/customer','StoreCustomer')->name('customer.store');
    Route::get('/edit/customer/{id}','EditCustomer')->name('edit.customer');
    Route::post('/update/customer','UpdateCustomer')->name('customer.update');
    Route::get('/delete/customer/{id}','DeleteCustomer')->name('delete.customer');
});

  Route::controller(RoleController::class)->group(function () {


      Route::get('all/permission','AllPermission')->name('all.permission');
      Route::get('/add/permission','AddPermission')->name('add.permission');
      Route::post('/store/permission','StorePermission')->name('permission.store');
      Route::get('/edit/permission/{id}','EditPermission')->name('edit.permission');

      Route::post('/update/permission','UpdatePermission')->name('permission.update');
      Route::get('/delete/permission/{id}','DeletePermission')->name('delete.permission');



      Route::get('/all/roles','AllRoles')->name('all.roles');
      Route::get('/add/roles','AddRoles')->name('add.roles');
      Route::post('/store/roles','StoreRoles')->name('roles.store');
      Route::get('/edit/roles/{id}','EditRoles')->name('edit.roles');
      Route::post('/update/roles','UpdateRoles')->name('roles.update');
      Route::get('/delete/roles/{id}','DeleteRoles')->name('delete.roles');

  });


Route::middleware(['auth','verified','role:admin'])->group(function () {

    Route::controller(VacanciesController::class)->group(function () {


        Route::get('/admin/vacancy/details/{id}', 'ApplicantVacancyDetails')->name('avacancy.details');


    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard',  'AdminDashboard')->name('admin.dashboard');


    });


    Route::controller(DashboardController::class)->group(function () {
        Route::get('/vdashboard',  'VacancyDashboard')->name('vacancy.dashboard');
        Route::get('/fetchChartData',  'FetchData')->name('fetchChartData');
        Route::get('/byCounty',  'ReportByCounty')->name('reportbycounty');
        // routes/web.php

        Route::get('/vacancies', 'index');
        Route::get('/ethnicities', 'ethnicities');




    });

    Route::controller(PanelUsersController::class)->group(function () {
        Route::get('/all/panel', 'AllPanelUsers')->name('all.panel.users');
        Route::get('/add/panel', 'AddPanelUsers')->name('add_panelusers');
        Route::post('/store/panel', 'StorePanelUsers')->name('panel.store');
        Route::get('/edit/panel/{id}', 'EditPanelUsers')->name('edit.panel');
        Route::post('/update/panel', 'UpdatePanelUsers')->name('panel.update');
        Route::get('/delete/panel/{id}', 'DeletePanelUsers')->name('delete.panel');
    });

    Route::controller(JobsController::class)->group(function () {
        Route::get('/all/jobs', 'AllAppliedJobs')->name('all.jobs');
        Route::get('/all/jobapplicants/{id}', 'JobApplicants')->name('job.applicants');
        Route::get('/jobapplicant/profile/{id}/{vid}', 'JobApplicantProfile')->name('jobapplicant.profile');
        Route::get('/stage1/jobapplicants/{id}', 'Stage1')->name('stage1');
        Route::post('/stage1/filter', 'Applyfilter')->name('stage1.filter');
        Route::post('/stage1filter/submit', 'SubmitFilterResult')->name('stage1filter.submit');
        Route::get('/stage1/reset/{id}', 'Stage1Reset')->name('stage1.reset');
        Route::get('/stage1/close/{id}', 'Stage1Close')->name('stage1.close');
        Route::get('/stage1/report/{id}', 'Stage1Report')->name('stage1.report');
        Route::get('/combined/report/{id}', 'CombinedReport')->name('combined.report');

    });
    Route::controller(CombinedListController::class)->group(function () {

        Route::get('/combined/report/{id}', 'CombinedReport')->name('combined.report');

    });



    Route::controller(DesignationsController::class)->group(function () {
        Route::get('/all/designation', 'AllDesignation')->name('all.designation');
        Route::get('/add/designation', 'AddDesignation')->name('add.designation');
        Route::post('/store/designation', 'StoreDesignation')->name('designation.store');
        Route::get('/edit/designation/{id}', 'EditDesignation')->name('edit.designation');
        Route::post('/update/designation', 'UpdateDesignation')->name('designation.update');
        Route::get('/delete/designation/{id}', 'DeleteDesignation')->name('delete.designation');
    });

    Route::controller(GenderController::class)->group(function () {
        Route::get('/all/gender', 'AllGender')->name('all.gender');
        Route::get('/add/gender', 'AddGender')->name('add.gender');
        Route::post('/store/gender', 'StoreGender')->name('gender.store');
        Route::get('/edit/gender/{id}', 'EditGender')->name('edit.gender');
        Route::post('/update/gender', 'UpdateGender')->name('gender.update');
        Route::get('/delete/gender/{id}', 'DeleteGender')->name('delete.gender');
    });
    Route::controller(EthnicityController::class)->group(function () {
        Route::get('/all/ethnicity', 'AllEthnicity')->name('all.ethnicity');
        Route::get('/add/ethnicity', 'AddEthnicity')->name('add.ethnicity');
        Route::post('/store/ethnicity', 'StoreEthnicity')->name('ethnicity.store');
        Route::get('/edit/ethnicity/{id}', 'EditEthnicity')->name('edit.ethnicity');
        Route::post('/update/ethnicity', 'UpdateEthnicity')->name('ethnicity.update');
        Route::get('/delete/ethnicity/{id}', 'DeleteEthnicity')->name('delete.ethnicity');
    });

    Route::controller(ApplicantDocumentsController::class)->group(function () {
        Route::get('/all/appdocs', 'AllApplicantDocuments')->name('all.appdocs');
        Route::get('/add/appdocs', 'AddApplicantDocuments')->name('add.appdocs');
        Route::post('/store/appdocs', 'StoreApplicantDocuments')->name('appdocs.store');
        Route::get('/edit/appdocs/{id}', 'EditApplicantDocuments')->name('edit.appdocs');
        Route::post('/update/appdocs', 'UpdateApplicantDocuments')->name('appdocs.update');
        Route::get('/delete/appdocs/{id}', 'DeleteApplicantDocuments')->name('delete.appdocs');
    });

    Route::controller(ConstituencyController::class)->group(function () {
        Route::get('/all/constituency', 'AllConstituency')->name('all.constituency');
        Route::get('/add/constituency', 'AddConstituency')->name('add.constituency');
        Route::post('/store/constituency', 'StoreConstituency')->name('constituency.store');
        Route::get('/edit/constituency/{id}', 'EditConstituency')->name('edit.constituency');
        Route::post('/update/constituency', 'UpdateConstituency')->name('constituency.update');
        Route::get('/delete/constituency/{id}', 'DeleteConstituency')->name('delete.constituency');
    });

    Route::controller(CountyController::class)->group(function () {
        Route::get('/all/county', 'AllCounty')->name('all.county');
        Route::get('/add/county', 'AddCounty')->name('add.county');
        Route::post('/store/county', 'StoreCounty')->name('county.store');
        Route::get('/edit/county/{id}', 'EditCounty')->name('edit.county');
        Route::post('/update/county', 'UpdateCounty')->name('county.update');
        Route::get('/delete/county/{id}', 'DeleteCounty')->name('delete.county');
    });

    Route::controller(NationalityController::class)->group(function () {
        Route::get('/all/nation', 'AllNation')->name('all.nation');
        Route::get('/add/nation', 'AddNation')->name('add.nation');
        Route::post('/store/nation', 'StoreNation')->name('nation.store');
        Route::get('/edit/nation/{id}', 'EditNation')->name('edit.nation');
        Route::post('/update/nation', 'UpdateNation')->name('nation.update');
        Route::get('/delete/nation/{id}', 'DeleteNation')->name('delete.nation');
    });
});


Route::middleware(['auth','verified','role:applicant'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('applicant/dashboard',  'ApplicantDashboard')->name('applicant.dashboard');


    });
    Route::controller(VacanciesController::class)->group(function () {

        Route::get('/apply/vacancy/details/{id}', 'ApplicantVacancyDetails')->name('vvacancy.details');


    });
    Route::controller(AccountController::class)->group(function () {
        Route::get('applicant/register',  'Register')->name('applicant.register');
        Route::get('applicant/profile/{id}',  'Profile')->name('applicant.profile');
        Route::get('applicant/profile/disability/{id}',  'DisabilityProfile')->name('applicant.profile.disability');

        Route::post('applicant/profile/update',  'ProfileUpdate')->name('profile.update');
        Route::post('applicant/profile/disability/update',  'ProfileUpdateDisability')->name('profile.update.disability');

        Route::post('applicant/profile/store',  'RegisterUpdate')->name('applicant.store');
        Route::get('applicant/completeprofile',  'CompleteProfile')->name('applicant.completeprofile');
        Route::get('/constituencies/ajax/{id}',  'GetConstituencies');

    });

    Route::controller(EducationController::class)->group(function () {
        Route::get('applicant/education',  'EducationProfile')->name('applicant.alleducation');
        Route::post('education/store',  'EducationStore')->name('education.store');
        Route::get('education/edit/{id}' , 'EducationEdit')->name('education.edit');
        Route::post('education/update' , 'EducationUpdate')->name('education.update');
        Route::get('education/delete{id}' , 'EducationDelete')->name('education.delete');

    });

    Route::controller(ProffessionalQualificationsController::class)->group(function () {
        Route::get('applicant/proffessionalqual',  'ProffessionalQualProfile')->name('applicant.proffessionalqual');
        Route::post('proffessionalqual/store',  'ProffessionalQualStore')->name('proffessionalqual.store');
        Route::get('proffessionalqual/edit/{id}' , 'ProffessionalQualEdit')->name('proffessionalqual.edit');
        Route::post('proffessionalqual/update' , 'ProffessionalQualUpdate')->name('proffessionalqual.update');
        Route::get('proffessionalqual/delete/{id}' , 'ProffessionalQualDelete')->name('proffessionalqual.delete');
        Route::post('proffessionalqual/noquals',  'ProffessionalNoQualsStore')->name('proffessionalqual.noquals');

    });

    Route::controller(ProffessionalMembershipsController::class)->group(function () {
        Route::get('applicant/proffmembership',  'ProffessionalMembershipProfile')->name('applicant.proffmembership');
        Route::post('proffmembership/store',  'ProffessionalMembershipStore')->name('proffmembership.store');
        Route::get('proffmembership/edit/{id}' , 'ProffessionalMembershipEdit')->name('proffmembership.edit');
        Route::post('proffmembership/update' , 'ProffessionalMembershipUpdate')->name('proffmembership.update');
        Route::get('proffmembership/delete{id}' , 'ProffessionalMembershipDelete')->name('proffmembership.delete');
        Route::post('proffmembership/noquals',  'ProffessionalNoMembershipStore')->name('proffmembership.noquals');

    });

    Route::controller(ExperienceController::class)->group(function () {
        Route::get('applicant/experience',  'ExperienceProfile')->name('applicant.experience');
        Route::post('experience/store',  'ExperienceStore')->name('experience.store');
        Route::get('experience/edit/{id}' , 'ExperienceEdit')->name('experience.edit');
        Route::post('experience/update' , 'ExperienceUpdate')->name('experience.update');
        Route::get('experience/delete{id}' , 'ExperienceDelete')->name('experience.delete');
        Route::post('experience/noquals',  'NoExperienceStore')->name('experience.noquals');

    });

    Route::controller(ApplicantDocumentsController::class)->group(function () {
        Route::get('applicant/applicantdoc',  'ApplicantDocumentProfile')->name('applicant.applicantdoc');
        Route::post('applicantdoc/store',  'ApplicantDocumentStore')->name('applicantdoc.store');
        Route::get('applicantdoc/edit/{id}' , 'ApplicantDocumentEdit')->name('applicantdoc.edit');
        Route::post('applicantdoc/update' , 'ApplicantDocumentUpdate')->name('applicantdoc.update');
        Route::get('applicantdoc/delete{id}' , 'ApplicantDocumentDelete')->name('applicantdoc.delete');

    });

    Route::controller(JobApplicationController::class)->group(function () {
        Route::get('all/openvacancies',  'OpenVacancies')->name('all.openvacancies');
        Route::get('job/apply/{id}',  'VacancyApply')->name('jobs.apply');
        Route::post('job/application/store',  'StoreVacancyApplication')->name('jobsapply.save');
        Route::get('jobapplication/success/{id}',  'ApplicationSuccessful')->name('jobsapply.success');
        Route::get('job/editapplication/{id}' , 'EditAppliedJob')->name('edit.jobapplied');
        Route::get('all/applications',  'VacancyApplications')->name('all.applicationsmade');
        Route::post('job/application/editstore',  'EditSaveChanges')->name('jobsapply.editsave');
        Route::get('/applicant/profile/{id}/{vid}', 'JobApplicantProfileView')->name('applicant.jobapplicant.profile');
        Route::get('profile/editapplication/{id}' , 'PreviewEditAppliedJob1')->name('pv.edit.jobapplied');
        Route::get('p/a/{id}' , 'PreviewEditAppliedJob')->name('pedit');

    });
});

Route::middleware(['auth','verified','role:panelist'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('panelist/dashboard',  'PanelistDashboard')->name('panelist.dashboard');


    });

    Route::controller(JobsController::class)->group(function () {

        Route::get('/panelist/jobapplicants/{id}', 'JobApplicants')->name('panelist.applicants');
        Route::get('/panelist/profile/{id}/{vid}', 'JobApplicantProfile')->name('panelist.jobapplicant.profile');


    });

    Route::controller(JobCandidatesController::class)->group(function () {
        Route::get('/load/applicants','LoadApplications')->name('load.applications');
        Route::get('/shortlists','AllShortlists')->name('all.shortlist');
        Route::get('/create/shortlist','CreateShortlist')->name('create.shortlist');
        Route::post('/store/shortlist','StoreShortlist')->name('store.shortlist');
        Route::get('/start/shortlist/{id}','StartShortlist')->name('start.shortlist');
        Route::get('provisional/shortlists/{id}','ProvisionalShortlists')->name('provisional.shortlist');
        Route::get('/shortlist/profile/{id}/{sid}','ShortlistProfile')->name('shortlist.profile');
        Route::post('/select/shortlist','StoreShortlistSelect')->name('shortlist.post');
        Route::get('/close/shortlist/{sid}/{vid}','CloseShortlist')->name('close.shortlist');
        Route::get('final/shortlists/{id}','FinalShortlists')->name('final.shortlist');


    });


});

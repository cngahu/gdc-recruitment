<?php

namespace App\Http\Controllers;

use App\Models\gender;
use App\Models\home_county;
use App\Models\User;
use App\Models\Vacancies;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\DB;
use TCPDF;

class DashboardController extends Controller
{
    //
        public function CountySummary($id){
            $vacancy=Vacancies::find($id);

            $applicantsByCounty = JobApplication::select(DB::raw('COUNT(*) as total_applicants'), 'home_counties.name as county_name')
                ->join('users', 'job_applications.userid', '=', 'users.id')
                ->join('home_counties', 'users.county', '=', 'home_counties.id')
                ->where('job_applications.vacancyid', $vacancy->id) // Filter by vacancyid
                ->groupBy('users.county', 'home_counties.name')
                ->get();
            return view('reports.county',compact('vacancy','applicantsByCounty'));
        }
    public function ethnicities()
    {

        $vacancies = Vacancies::withCount('jobApplications')->get();

        // Fetch counties with job applications count
        $tribes = DB::table('ethnicities')
            ->select('ethnicities.*')
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(*)')
                    ->from('job_applications')
                    ->join('users', 'job_applications.userid', '=', 'users.id')
                    ->whereColumn('users.ethnicity', 'ethnicities.id');
            }, 'job_applications_count')
            ->get();

        // Create a new TCPDF instance
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Your Application');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Vacancies and Job Applications Report');
        $pdf->SetSubject('Vacancies and Job Applications Report');
        $pdf->SetKeywords('TCPDF, PDF, report, vacancies, job applications');

        // Add a page
        $pdf->AddPage();

        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(60, 10, 'Vacancy', 1, 0, 'C');
        $pdf->Cell(60, 10, 'County', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Applications', 1, 1, 'C');

        // Add vacancy details with wrapped job title
        foreach ($vacancies as $vacancy) {
            // Calculate the height of the cell based on the number of lines in the job title
            $titleHeight = $pdf->getStringHeight(60, $vacancy->jobTitle . ' (Total Applications: ' . $vacancy->job_applications_count . ')');

            // Add vacancy job title spanning three columns
            $pdf->Cell(180, $titleHeight, $vacancy->jobTitle . ' (Total Applications: ' . $vacancy->job_applications_count . ')', 1, 1, 'C');

            // Skip a row
            $pdf->Cell(60, 10, '', 1, 1);

            // Add county information in subsequent rows
            foreach ($tribes as $tribe) {
                $pdf->Cell(60, 10, $tribe->name, 1, 0, 'C');
                $pdf->Cell(60, 10, $tribe->job_applications_count, 1, 1, 'C');
            }
        }

        // Output the PDF to the browser
        $pdf->Output('Ethnicities_and_vacancies_and_applications_report.pdf', 'I');

        }
    public function index()
    {

        $vacancies = Vacancies::withCount('jobApplications')->get();

        // Fetch counties with job applications count
        $counties = DB::table('home_counties')
            ->select('home_counties.*')
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(*)')
                    ->from('users')
                    ->whereColumn('users.county', 'home_counties.id')
                    ->join('job_applications', 'job_applications.userid', '=', 'users.id');
            }, 'job_applications_count')
            ->get();

        // Create a new TCPDF instance
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Your Application');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Vacancies and Job Applications Report');
        $pdf->SetSubject('Vacancies and Job Applications Report');
        $pdf->SetKeywords('TCPDF, PDF, report, vacancies, job applications');

        // Add a page
        $pdf->AddPage();

        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(60, 10, 'Vacancy', 1, 0, 'C');
        $pdf->Cell(60, 10, 'County', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Applications', 1, 1, 'C');

        // Add vacancy details with wrapped job title
        foreach ($vacancies as $vacancy) {
            // Calculate the height of the cell based on the number of lines in the job title
            $titleHeight = $pdf->getStringHeight(60, $vacancy->jobTitle . ' (Total Applications: ' . $vacancy->job_applications_count . ')');

            // Add vacancy job title spanning three columns
            $pdf->Cell(180, $titleHeight, $vacancy->jobTitle . ' (Total Applications: ' . $vacancy->job_applications_count . ')', 1, 1, 'C');

            // Skip a row
            $pdf->Cell(60, 10, '', 1, 1);

            // Add county information in subsequent rows
            foreach ($counties as $county) {
                $pdf->Cell(60, 10, $county->name, 1, 0, 'C');
                $pdf->Cell(60, 10, $county->job_applications_count, 1, 1, 'C');
            }
        }

        // Output the PDF to the browser
        $pdf->Output('vacancies_and_applications_report.pdf', 'I');

    }
    public function ApplicationsReport0()
    {
        // Fetch vacancies with applicant details
        $vacancies = Vacancies::with('applications.user')
            ->get()
            ->map(function ($vacancy) {
                $applicants = $vacancy->applications;
                $male = $applicants->filter(fn($app) => $app->user->gender === 1)->count();
                $female = $applicants->filter(fn($app) => $app->user->gender === 2)->count();
                $disabled = $applicants->filter(fn($app) => strtolower($app->user->disability) === 'yes')->count();

                return [
                    'vacancy_name' => $vacancy->jobTitle,
                    'total_applicants' => $applicants->count(),
                    'male' => $male,
                    'female' => $female,
                    'disabled' => $disabled,
                ];
            });

        $data = [
            'vacancies' => $vacancies,
            'institution_name' => 'Your Institution Name',
            'logo_url' => asset('images/your-logo.png'),
        ];

        $pdf = Pdf::loadView('reports.applications_report', $data)->setPaper('a4', 'landscape');
        return $pdf->stream('Applications_Report.pdf');
    }


    public function ApplicationsReport()
    {
        // Generate PDF content dynamically
        $vacancies = Vacancies::with('applications.user')->get();

        $data = $vacancies->map(function ($vacancy) {
            $applicants = $vacancy->applications;

            return [

                'name' => $vacancy->title,
                'total' => $applicants->count(),
                'male' => $applicants->filter(fn($app) => $app->user->gender == 1)->count(),
                'female' => $applicants->filter(fn($app) => $app->user->gender == 2)->count(),
                'disabled' => $applicants->filter(fn($app) => $app->user->disability == 'Yes')->count(),
            ];
        });

        return view('reports.applicationreports', [
            'data' => $data,
            'logo_url' => asset('backend/assets/images/logo-dark.png')
        ]);

    }


    public function ApplicationsReportPdf()
    {
        $vacancies = Vacancies::with('applications.user')->get()->map(function ($vacancy) {
            $applicants = $vacancy->applications;

            return [
                'name' => $vacancy->jobTitle,
                'total' => $applicants->count(),
                'male' => $applicants->filter(fn($app) => $app->user->gender == 1)->count(),
                'female' => $applicants->filter(fn($app) => $app->user->gender == 2)->count(),
                'disabled' => $applicants->filter(fn($app) => $app->user->disability == 'Yes')->count(),
            ];
        });

        $pdf = Pdf::loadView('reports.vacancy_report', ['data' => $vacancies,  'logo_url' => asset('backend/assets/images/logo-dark.png')]);
        return $pdf->stream('vacancy_report.pdf');
    }

    public function index1(){
        $vacancies = Vacancies::withCount('jobApplications')->get();

        $counties = DB::table('home_counties')
            ->select('home_counties.*')
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(*)')
                    ->from('users')
                    ->whereColumn('users.county', 'home_counties.id')
                    ->join('job_applications', 'job_applications.userid', '=', 'users.id');
            }, 'job_applications_count')
            ->get();



        return view('reports.index', compact('vacancies', 'counties'));
    }

    public function VacancyDashboard(){
        // Retrieve vacancies and their titles
        $vacancies = Vacancies::all();

// Extract job titles and store them in an array
        $jobTitles = $vacancies->pluck('jobTitle')->toArray();

// Use the job titles array for both categories and series names
        $vacanciesdisp = $jobTitles;

        $maleData = [];
        $femaleData = [];
        $intersexData = [];

// Iterate through each vacancy
        foreach ($vacancies as $vacancy) {
            // Initialize counts for each gender category
            $maleCount = 0;
            $femaleCount = 0;
            $intersexCount = 0;

            // Retrieve gender distribution for the current vacancy
            $genderDistribution = JobApplication::select('users.gender', DB::raw('count(*) as total'))
                ->join('users', 'job_applications.userid', '=', 'users.id')
                ->where('job_applications.vacancyid', $vacancy->id)
                ->groupBy('users.gender')
                ->get();

            // Update counts based on gender distribution
            foreach ($genderDistribution as $item) {
                switch ($item->gender) {
                    case 1:
                        $maleCount = $item->total;
                        break;
                    case 2:
                        $femaleCount = $item->total;
                        break;
                    case 3:
                        $intersexCount = $item->total;
                        break;
                }
            }

            // Add counts to respective gender data arrays
            $maleData[] = $maleCount;
            $femaleData[] = $femaleCount;
            $intersexData[] = $intersexCount;
        }

// Create series data array with the desired structure
        $seriesData = [
            ['name' => 'Male', 'data' => $maleData],
            ['name' => 'Female', 'data' => $femaleData],
            ['name' => 'Intersex', 'data' => $intersexData]
        ];

// Pass the $seriesData array to the view
        return view('reports.vacancy', compact('seriesData','vacanciesdisp'));

    }
    public function VacancyDashboard1(){

        // Retrieve vacancies and their titles
        $vacancies = Vacancies::all();

// Extract job titles and store them in an array
        $jobTitles = $vacancies->pluck('jobTitle')->toArray();

// Use the job titles array for both categories and series names
        $vacanciesdisp = $jobTitles;


        $seriesData = [];


        foreach ($vacancies as $vacancy) {


            $maleCount = 0;
            $femaleCount = 0;
            $intersexCount = 0;

            $genderDistribution = JobApplication::select('users.gender', DB::raw('count(*) as total'))
                ->join('users', 'job_applications.userid', '=', 'users.id')
                ->where('job_applications.vacancyid', $vacancy->id)
                ->groupBy('users.gender')
                ->get();


            foreach ($genderDistribution as $item) {
                switch ($item->gender) {
                    case 1:
                        $maleCount = $item->total;
                        break;
                    case 2:
                        $femaleCount = $item->total;
                        break;
                    case 3:
                        $intersexCount = $item->total;
                        break;
                }
            }

            // Add counts to the series data
            $seriesData[] = [
                'name' => $vacancy->jobTitle,
                'data' => [
                    $maleCount,
                    $femaleCount,
                    $intersexCount
                ]
            ];

        }


        return view ('reports.vacancy',compact('vacanciesdisp','seriesData'));
    }

    public function FetchData(){

    }

    public function ReportByCounty(){

    }
}

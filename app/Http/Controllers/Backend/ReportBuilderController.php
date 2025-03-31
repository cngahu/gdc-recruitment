<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Jobs\GenerateLonglistReportPdfJob;
use App\Models\JobApplication;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\home_county;
use App\Models\Vacancies;


class ReportBuilderController extends Controller
{
    //

    public function index()
    { $vacancies = Vacancies::all();
        return view('builder.index',compact('vacancies'));
    }
    public function longlistIndex()
    { $vacancies = Vacancies::all();
        return view('builder.longlist_index',compact('vacancies'));
    }


    public function countyVacanciesReport(Request $request)
    {
        $vacancyId = $request->vacancy_id; // Optional parameter for filtering by vacancy

        // If there's a specific vacancy, filter the applications for that vacancy, else fetch all vacancies
        $query = JobApplication::with(['user', 'user.homeCounty', 'vacancy'])
            ->whereHas('user', function ($q) {
                $q->where('role', 'applicant');
            });

        // If a vacancy_id is provided, filter based on that.
        if ($vacancyId) {
            $query->where('vacancy_id', $vacancyId);
        }

        // Get the applications from the database
        $applications = $query->get();

        // Group the applications by county and aggregate the data
        $countyApplications = $applications->groupBy(function($application) {
            return $application->user->homeCounty->name;  // Group by county name
        });

        // Prepare the county application statistics data
        $countyData = $countyApplications->map(function($countyGroup) {
            $totalApplicants = $countyGroup->count();
            $male = $countyGroup->where('user.gender', 1)->count();
            $female = $countyGroup->where('user.gender', 2)->count();
            $disabled = $countyGroup->where('user.disability', 'Yes')->count();

            return [
                'county_name' => $countyGroup->first()->user->homeCounty->name,
                'total' => $totalApplicants,
                'male' => $male,
                'female' => $female,
                'disabled' => $disabled,
            ];
        });

        // If requested for PDF, return the generated PDF, else return the Blade view with data.
        if ($request->has('pdf')) {
            $pdf = Pdf::loadView('reports.applications_by_county_pdf', compact('countyData'));
            return $pdf->download('vacancy_applications_by_county.pdf');
        }

        // Otherwise, return the page that will have the report displayed in iframe or table form
        return view('reports.applications_by_county_report', compact('countyData'));
    }
    public function generateReport0(Request $request)
    {
        // Step 1: Get form inputs
        $vacancyId = $request->input('vacancy_id');
        $criteria = $request->input('criteria');

        // Validate the inputs
        if (!$vacancyId || !$criteria) {
            return response()->json(['error' => 'Invalid parameters'], 400);
        }


        // Step 2: Filter job applications based on selected vacancy
        $jobApplications = JobApplication::where('vacancyid', $vacancyId)
            ->with(['user', 'user.homeCounty'])
            ->get();

        // Step 3: Process the data by county and gender (for county criteria)
        $countyData = [];
        foreach ($jobApplications as $application) {
            // Get county and gender data
            $county = $application->user->homeCounty->name;
            $gender = $application->user->gender;

            if (!isset($countyData[$county])) {
                $countyData[$county] = ['total' => 0, 'male' => 0, 'female' => 0];
            }

            // Increment total applications for the county
            $countyData[$county]['total']++;

            // Increment gender count for the county
            if ($gender === 'male') {
                $countyData[$county]['male']++;
            } else {
                $countyData[$county]['female']++;
            }
        }

        // Step 4: Get the vacancy details for PDF generation
        $vacancy = Vacancies::findOrFail($vacancyId); // assuming you have a Vacancy model
        $institution = "Your Institution Name"; // Or fetch dynamically from your settings table
        $logoPath = public_path('images/logo.png'); // Specify logo path

        // Step 5: Generate the PDF with the data
        $pdf = Pdf::loadView('builder.job_application_report', [
            'vacancy' => $vacancy,
            'countyData' => $countyData,
            'institution' => $institution,
            'logo' => $logoPath
        ]);

        // Step 6: Return the PDF in response (it will be displayed in iframe on your page)
        return $pdf->stream('job_application_report.pdf');
    }
    public function generateReport1(Request $request)
    {
        // Step 1: Get form inputs
        $vacancyId = $request->input('vacancy_id');
        $criteria = $request->input('criteria');

        // Validate the inputs
        if (!$vacancyId || !$criteria) {
            return response()->json(['error' => 'Invalid parameters'], 400);
        }

        // Step 2: Filter job applications based on selected vacancy
        $jobApplications = JobApplication::where('vacancyid', $vacancyId)
            ->with(['user', 'user.homeCounty'])
            ->get();



        // Step 3: Process the data by county and gender (for county criteria)
        $countyData = [];
        foreach ($jobApplications as $application) {
            // Get county and gender data
            $county = $application->user->homeCounty->name;
            $gender = $application->user->gender;

            if (!isset($countyData[$county])) {
                $countyData[$county] = ['total' => 0, 'male' => 0, 'female' => 0];
            }

            // Increment total applications for the county
            $countyData[$county]['total']++;

            // Increment gender count for the county
            if ($gender === 'male') {
                $countyData[$county]['male']++;
            } else {
                $countyData[$county]['female']++;
            }
        }

        // Step 4: Get the vacancy details for PDF generation
        $vacancy = Vacancies::findOrFail($vacancyId);  // assuming you have a Vacancy model
        $institution = "Your Institution Name";  // Or fetch dynamically from your settings table
        $logoPath = public_path('images/logo.png');  // Specify logo path

        // Step 5: Generate the PDF with the data
//        $pdf = Pdf::loadView('builder.job_application_report', [
//            'vacancy' => $vacancy,
//            'countyData' => $countyData,
//            'institution' => $institution,
//            'logo' => $logoPath
//        ]);

        // Step 6: Return the PDF in response (it will be displayed in iframe on your page)
        // Instead of using `stream`, use `response()->file` to handle Blob response in JavaScript.
//        return response()->stream(
//            fn() => $pdf->output(),
//            200,
//            [
//                'Content-Type' => 'application/pdf',
//                'Content-Disposition' => 'inline; filename="job_application_report.pdf"',
//            ]
//        );
        dd($vacancy, $countyData, $institution, $logoPath);

        $pdf = Pdf::loadView('builder.job_application_report', [
            'vacancy' => $vacancy,
            'countyData' => $countyData,
            'institution' => $institution,
            'logo' => $logoPath
        ]);

        // Return PDF directly for testing
        return $pdf->stream('job_application_report.pdf');
    }
    public function generateReportPdf0(Request $request)
    {
        $vacancyId = $request->query('vacancy_id');
        $criteria = $request->query('criteria');

        // Validate the inputs
        if (!$vacancyId || !$criteria) {
            abort(400, 'Invalid parameters');
        }

        // Generate the data
        $jobApplications = JobApplication::where('vacancyid', $vacancyId)
            ->with(['user', 'user.homeCounty'])
            ->get();

        $countyData = [];
        foreach ($jobApplications as $application) {
            $county = $application->user->homeCounty->name;
            $gender = $application->user->gender;

            if (!isset($countyData[$county])) {
                $countyData[$county] = ['total' => 0, 'male' => 0, 'female' => 0];
            }

            $countyData[$county]['total']++;
            $gender = $application->user->gender;

            if ($gender == 1) {
                $countyData[$county]['male']++;
            } elseif ($gender == 2) {
                $countyData[$county]['female']++;
            }

        }
        // Sort counties alphabetically
        ksort($countyData);


        $vacancy = Vacancies::findOrFail($vacancyId);
        $institution = "Your Institution Name";
        $logoPath = public_path('backend/assets/images/logo-dark.png');

        // Generate PDF
        $pdf = Pdf::loadView('builder.job_application_report', [
            'vacancy' => $vacancy,
            'countyData' => $countyData,
            'institution' => $institution,
            'logo' => $logoPath
        ]);

        return $pdf->stream('job_application_report.pdf');
    }
    public function generateReportPdf1(Request $request)
    {
        $vacancyId = $request->query('vacancy_id');
        $criteria = $request->query('criteria');

        // Validate the inputs
        if (!$vacancyId || !$criteria) {
            abort(400, 'Invalid parameters');
        }

        $vacancy = Vacancies::findOrFail($vacancyId);
        $institution = "Your Institution Name";
        $logoPath = public_path('backend/assets/images/logo-dark.png');

        // Initialize variables for the data that will be passed to the view
        $data = [];

        // Based on the selected criteria, handle different data processing
        switch ($criteria) {
            case 'county':
                $jobApplications = JobApplication::where('vacancyid', $vacancyId)
                    ->with(['user', 'user.homeCounty'])
                    ->get();

                $countyData = [];
                foreach ($jobApplications as $application) {
                    $county = $application->user->homeCounty->name;
                    $gender = $application->user->gender;

                    if (!isset($countyData[$county])) {
                        $countyData[$county] = ['total' => 0, 'male' => 0, 'female' => 0];
                    }

                    $countyData[$county]['total']++;

                    if ($gender == 1) {
                        $countyData[$county]['male']++;
                    } elseif ($gender == 2) {
                        $countyData[$county]['female']++;
                    }
                }

                // Sort counties alphabetically
                ksort($countyData);

                $data = [
                    'countyData' => $countyData,
                ];

                break;

            case 'ethnicity':
                $jobApplications = JobApplication::where('vacancyid', $vacancyId)
                    ->with(['user', 'user.ethnicity'])
                    ->get();

                $ethnicityData = [];
//                foreach ($jobApplications as $application) {
//                    $ethnicity = $application->user->ethnicity->name;
//                    $gender = $application->user->gender;
//
//                    if (!isset($ethnicityData[$ethnicity])) {
//                        $ethnicityData[$ethnicity] = ['total' => 0, 'male' => 0, 'female' => 0];
//                    }
//
//                    $ethnicityData[$ethnicity]['total']++;
//
//                    if ($gender == 1) {
//                        $ethnicityData[$ethnicity]['male']++;
//                    } elseif ($gender == 2) {
//                        $ethnicityData[$ethnicity]['female']++;
//                    }
//                }
                foreach ($jobApplications as $application) {
                    $ethnicity = optional($application->user->ethnicity)->name;  // Using optional to prevent errors if ethnicity is null
                    $gender = $application->user->gender;

                    if (!isset($ethnicityData[$ethnicity])) {
                        $ethnicityData[$ethnicity] = ['total' => 0, 'male' => 0, 'female' => 0];
                    }

                    $ethnicityData[$ethnicity]['total']++;

                    if ($gender == 1) {
                        $ethnicityData[$ethnicity]['male']++;
                    } elseif ($gender == 2) {
                        $ethnicityData[$ethnicity]['female']++;
                    }
                }

                // Sort ethnicities alphabetically
                ksort($ethnicityData);

                $data = [
                    'ethnicityData' => $ethnicityData,
                ];

                break;

            // You can add more cases here for additional criteria like "age group", "job type", etc.
            default:
                abort(400, 'Unknown criteria selected');
        }

        // Generate PDF
        $pdf = Pdf::loadView('builder.job_application_report', array_merge([
            'vacancy' => $vacancy,
            'institution' => $institution,
            'logo' => $logoPath
        ], $data));

        return $pdf->stream('job_application_report.pdf');
    }
    public function generateReportPdf2(Request $request)
    {
        $vacancyId = $request->query('vacancy_id');
        $criteria = $request->query('criteria');

        // Validate inputs
        if (!$vacancyId || !$criteria) {
            abort(400, 'Invalid parameters');
        }

        $vacancy = Vacancies::findOrFail($vacancyId);
        $institution = "Your Institution Name";
        $logoPath = public_path('backend/assets/images/logo-dark.png');

        // Initialize variables
        $data = [];
        $countyData = [];
        $ethnicityData = [];

        switch ($criteria) {
            case 'county':
                $jobApplications = JobApplication::where('vacancyid', $vacancyId)
                    ->with(['user', 'user.homeCounty']) // Ensure user and homeCounty are eagerly loaded
                    ->get();

                foreach ($jobApplications as $application) {
                    $county = optional($application->user->homeCounty)->name; // Safe handling of null county
                    $gender = $application->user->gender;

                    if ($county) { // Only process if county is not null
                        if (!isset($countyData[$county])) {
                            $countyData[$county] = ['total' => 0, 'male' => 0, 'female' => 0];
                        }

                        $countyData[$county]['total']++;

                        if ($gender == 1) {
                            $countyData[$county]['male']++;
                        } elseif ($gender == 2) {
                            $countyData[$county]['female']++;
                        }
                    }
                }

                ksort($countyData);
                $data = ['countyData' => $countyData];
                break;

            case 'ethnicity':
                $jobApplications = JobApplication::where('vacancyid', $vacancyId)
                    ->with(['user', 'user.ethnicityname']) // Eager-load ethnicity data
                    ->get();

                foreach ($jobApplications as $application) {
                    $ethnicity = optional($application->user->ethnicityname)->name; // Handle cases where ethnicity is null
                    $gender = $application->user->gender;

                    if ($ethnicity) { // Only process if ethnicity is not null
                        if (!isset($ethnicityData[$ethnicity])) {
                            $ethnicityData[$ethnicity] = ['total' => 0, 'male' => 0, 'female' => 0];
                        }

                        $ethnicityData[$ethnicity]['total']++;

                        if ($gender == 1) {
                            $ethnicityData[$ethnicity]['male']++;
                        } elseif ($gender == 2) {
                            $ethnicityData[$ethnicity]['female']++;
                        }
                    }
                }

                ksort($ethnicityData);
                $data = ['ethnicityData' => $ethnicityData];
                break;

            default:
                abort(400, 'Unknown criteria selected');
        }


        // Generate the PDF with the relevant data
        $pdf = Pdf::loadView('builder.job_application_report', array_merge([
            'vacancy' => $vacancy,
            'institution' => $institution,
            'logo' => $logoPath
        ], $data));

        return $pdf->stream('job_application_report.pdf');
    }



    public function generateReportPdf(Request $request)
    {
        $vacancyId = $request->query('vacancy_id');
        $criteria = $request->query('criteria');

        // Validate inputs
        if (!$vacancyId || !$criteria) {
            abort(400, 'Invalid parameters');
        }

        $vacancy = Vacancies::findOrFail($vacancyId);
        $institution = "Your Institution Name";
        $logoPath = public_path('backend/assets/images/logo-dark.png');

        // Initialize variables
        $data = [];
        $countyData = [];
        $ethnicityData = [];
        $dateData = []; // For grouping applications by date

        switch ($criteria) {
            case 'county':
                $jobApplications = JobApplication::where('vacancyid', $vacancyId)
                    ->with(['user', 'user.homeCounty']) // Ensure user and homeCounty are eagerly loaded
                    ->get();

                foreach ($jobApplications as $application) {
                    $county = optional($application->user->homeCounty)->name; // Safe handling of null county
                    $gender = $application->user->gender;

                    if ($county) { // Only process if county is not null
                        if (!isset($countyData[$county])) {
                            $countyData[$county] = ['total' => 0, 'male' => 0, 'female' => 0];
                        }

                        $countyData[$county]['total']++;

                        if ($gender == 1) {
                            $countyData[$county]['male']++;
                        } elseif ($gender == 2) {
                            $countyData[$county]['female']++;
                        }
                    }
                }

                ksort($countyData);
                $data = ['countyData' => $countyData];
                break;

            case 'ethnicity':
                $jobApplications = JobApplication::where('vacancyid', $vacancyId)
                    ->with(['user', 'user.ethnicityname']) // Eager-load ethnicity data
                    ->get();

                foreach ($jobApplications as $application) {
                    $ethnicity = optional($application->user->ethnicityname)->name; // Handle cases where ethnicity is null
                    $gender = $application->user->gender;

                    if ($ethnicity) { // Only process if ethnicity is not null
                        if (!isset($ethnicityData[$ethnicity])) {
                            $ethnicityData[$ethnicity] = ['total' => 0, 'male' => 0, 'female' => 0];
                        }

                        $ethnicityData[$ethnicity]['total']++;

                        if ($gender == 1) {
                            $ethnicityData[$ethnicity]['male']++;
                        } elseif ($gender == 2) {
                            $ethnicityData[$ethnicity]['female']++;
                        }
                    }
                }

                ksort($ethnicityData);
                $data = ['ethnicityData' => $ethnicityData];
                break;

            case 'date': // New case for Application Date filter
                // Fetch job applications for the selected vacancy
                $jobApplications = JobApplication::where('vacancyid', $vacancyId)
                    ->with('user') // Ensure we eager load user to access gender information
                    ->get();

                // Group the applications by created_at date
                foreach ($jobApplications as $application) {
                    $date = $application->created_at->toDateString(); // Get the date part (YYYY-MM-DD)
                    $gender = $application->user->gender;

                    if (!isset($dateData[$date])) {
                        $dateData[$date] = ['total' => 0, 'male' => 0, 'female' => 0];
                    }

                    $dateData[$date]['total']++;

                    if ($gender == 1) {
                        $dateData[$date]['male']++;
                    } elseif ($gender == 2) {
                        $dateData[$date]['female']++;
                    }
                }

                ksort($dateData); // Sort by date
                $data = ['dateData' => $dateData];
                break;

            default:

                abort(400, 'Unknown criteria selected');
        }

        // Generate the PDF with the relevant data
        $pdf = Pdf::loadView('builder.job_application_report', array_merge([
            'vacancy' => $vacancy,
            'institution' => $institution,
            'logo' => $logoPath
        ], $data));

        return $pdf->stream('job_application_report.pdf');
    }
    public function generateLonglistReportPdf0(Request $request)
    {
        $vacancyId = $request->query('vacancy_id');
        $criteria = $request->query('criteria');

        // Validate inputs
        if (!$vacancyId || !$criteria) {
            abort(400, 'Invalid parameters');
        }

        $vacancy = Vacancies::findOrFail($vacancyId);
        $institution = "Your Institution Name";
        $logoPath = public_path('backend/assets/images/logo-dark.png');

        // Initialize variables
        $data = [];
        $countyData = [];
        $ethnicityData = [];
        $dateData = []; // For grouping applications by date

        switch ($criteria) {

            case 'longlist':
                // Fetch job applications
                $jobApplications = JobApplication::where('vacancyid', $vacancyId)
                    ->with([
                        'user',
                        'user.educationQualifications',
                        'user.professionalQualifications',
                        'user.professionalMemberships',
                        'user.leadershipCourses',
                        'user.experiences'
                    ])
                    ->get();

                $applicantDetails = [];

                foreach ($jobApplications as $application) {
                    $user = $application->user;

                    $personalDetails = [
                        'first_name' => $user->first_name,
                        'middle_name' => $user->middle_name,
                        'last_name' => $user->last_name,
                        'email' => $user->email,
                        'idnumber' => $user->idnumber,
                        'dob' => $user->dob,
                        'age' => $user->age,
                        'ethnicity' => optional($user->ethnicityname)->name,
                        'county' => optional($user->homeCounty)->name,
                        'disability' => $user->has_disability ? 'Yes' : 'No',
                    ];

                    $academicDetails = $user->educationQualifications->map(function ($qualification) {
                        return [
                            'level' => $qualification->level,
                            'institution' => $qualification->institution,
                            'course' => $qualification->course,
                            'graduation_year' => $qualification->graduation_year,
                        ];
                    });

                    $professionalQualifications = $user->professionalQualifications->map(function ($qualification) {
                        return [
                            'qualification' => $qualification->qualification,
                            'institution' => $qualification->institution,
                            'year' => $qualification->year,
                        ];
                    });

                    $professionalMemberships = $user->professionalMemberships->map(function ($membership) {
                        return [
                            'body' => $membership->body,
                            'membership_no' => $membership->membership_no,
                            'expiry_date' => $membership->expiry_date,
                        ];
                    });

                    $leadershipCourses = $user->leadershipCourses->map(function ($course) {
                        return [
                            'course_name' => $course->course_name,
                            'year' => $course->year,
                        ];
                    });

                    $workExperiences = $user->experiences->map(function ($experience) {
                        return [
                            'company' => $experience->company,
                            'position' => $experience->position,
                            'start_date' => $experience->start_date,
                            'end_date' => $experience->end_date,
                        ];
                    });

                    $applicantDetails[] = [
                        'personalDetails' => $personalDetails,
                        'academicDetails' => $academicDetails,
                        'professionalQualifications' => $professionalQualifications,
                        'professionalMemberships' => $professionalMemberships,
                        'leadershipCourses' => $leadershipCourses,
                        'workExperiences' => $workExperiences,
                    ];
                }

                $data = ['applicantDetails' => $applicantDetails];
                break;
            default:

                abort(400, 'Unknown criteria selected');
        }

        // Generate the PDF with the relevant data
        $pdf = Pdf::loadView('builder.longlist_job_application_report', array_merge([
            'vacancy' => $vacancy,
            'institution' => $institution,
            'logo' => $logoPath
        ], $data));

        return $pdf->stream('job_application_report.pdf');
    }
    public function generateLonglistReportPdf(Request $request)
    {
        $vacancyId = $request->query('vacancy_id');
        $criteria = $request->query('criteria');

        // Validate inputs
        if (!$vacancyId || !$criteria) {
            abort(400, 'Invalid parameters');
        }


        // Check the total number of job applications
        $jobApplicationsCount = JobApplication::where('vacancyid', $vacancyId)->count();
        $maxApplicants = 300;

        if ($jobApplicationsCount > $maxApplicants) {
            // Dispatch the job for large datasets
            GenerateLonglistReportPdfJob::dispatch($vacancyId, $criteria);

            return response()->json([
                'message' => 'The dataset is large. The PDF is being generated and will be available for download shortly.'
            ]);
        }

        $vacancy = Vacancies::findOrFail($vacancyId);
        $institution = "Your Institution Name";
        $logoPath = public_path('backend/assets/images/logo-dark.png');

        // Initialize variables
        $data = [];
        $countyData = [];
        $ethnicityData = [];
        $dateData = []; // For grouping applications by date

        switch ($criteria) {
            case 'longlist':
                // Fetch job applications
                $jobApplications = JobApplication::where('vacancyid', $vacancyId)
                    ->with([
                        'user',
                        'user.educationQualifications',
                        'user.professionalQualifications',
                        'user.professionalMemberships',
                        'user.leadershipCourses',
                        'user.experiences'
                    ])
                    ->get();

                $applicantDetails = [];

                foreach ($jobApplications as $application) {
                    $user = $application->user;

                    $personalDetails = [
                        'first_name' => $user->first_name,
                        'middle_name' => $user->middle_name,
                        'last_name' => $user->last_name,
                        'email' => $user->email,
                        'idnumber' => $user->idnumber,
                        'dob' => $user->dob,
                        'age' => $user->age,
                        'ethnicity' => optional($user->ethnicityname)->name,
                        'county' => optional($user->homeCounty)->name,
                        'disability' => $user->has_disability ? 'Yes' : 'No',
                    ];

                    $academicDetails = $user->educationQualifications->map(function ($qualification) {
                        return [
                            'level' => $qualification->academiclevel,
                            'institution' => $qualification->institutionName,
                            'course' => $qualification->courseName,
                            'graduation_year' => $qualification->exitDate,
                        ];
                    });
//                    dd($user->educationQualifications);

                    $professionalQualifications = $user->professionalQualifications->map(function ($qualification) {
                        return [
                            'qualification' => $qualification->courseName,
                            'institution' => $qualification->institutionName,
                            'year' => $qualification->grade,
                        ];
                    });

                    $professionalMemberships = $user->professionalMemberships->map(function ($membership) {
                        return [
                            'body' => $membership->proffBody,
                            'membership_no' => $membership->memberNumber,
                            'expiry_date' => $membership->active,
                        ];
                    });

                    $leadershipCourses = $user->leadershipCourses->map(function ($course) {
                        return [
                            'course_name' => $course->course_name,
                            'year' => $course->year,
                        ];
                    });

                    $workExperiences = $user->experiences->map(function ($experience) {
                        return [
                            'company' => $experience->institutionName,
                            'position' => $experience->courseName,
                            'start_date' => $experience->grade,

                        ];
                    });

                    $applicantDetails[] = [
                        'personalDetails' => $personalDetails,
                        'academicDetails' => $academicDetails,
                        'professionalQualifications' => $professionalQualifications,
                        'professionalMemberships' => $professionalMemberships,
                        'leadershipCourses' => $leadershipCourses,
                        'workExperiences' => $workExperiences,
                    ];
                }

                $data = ['applicantDetails' => $applicantDetails];
                break;

            default:
                abort(400, 'Unknown criteria selected');
        }

        // Generate the PDF with the relevant data
        $pdf = Pdf::loadView('builder.longlist_job_application_report', array_merge([
            'vacancy' => $vacancy,
            'institution' => $institution,
            'logo' => $logoPath
        ], $data))
            ->setPaper('a4', 'landscape'); // Set A4 paper size in landscape orientation

        return $pdf->stream('job_application_report.pdf');
    }


}

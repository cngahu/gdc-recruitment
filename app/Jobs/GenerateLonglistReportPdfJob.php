<?php

namespace App\Jobs;


use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\Vacancies;
use Barryvdh\DomPDF\Facade\Pdf;
class GenerateLonglistReportPdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected $vacancyId;
    protected $criteria;

    public function __construct($vacancyId, $criteria)
    {
        $this->vacancyId = $vacancyId;
        $this->criteria = $criteria;
    }


    /**
     * Execute the job.
     */
    public function handle0()
    {
        // Fetch data for the vacancy
        $vacancy = Vacancies::findOrFail($this->vacancyId);

        // Process and generate PDF content
        $jobApplications = JobApplication::where('vacancyid', $this->vacancyId)
            ->with([
                'user',
                'user.educationQualifications',
                'user.professionalQualifications',
                'user.professionalMemberships',
                'user.leadershipCourses',
                'user.experiences'
            ])
            ->get();

        // Extract the logic from your original controller for processing applicants
        $applicantDetails = $this->processApplications($jobApplications);

        $data = [
            'vacancy' => $vacancy,
            'institution' => "Your Institution Name",
            'logo' => public_path('backend/assets/images/logo-dark.png'),
            'applicantDetails' => $applicantDetails,
        ];

        // Generate PDF
        $pdf = Pdf::loadView('builder.longlist_job_application_report', $data)
            ->setPaper('a4', 'landscape');

        // Save PDF to storage
        $pdfPath = "pdfs/job_application_report_{$this->vacancyId}.pdf";
        Storage::put($pdfPath, $pdf->output());

        // Optionally notify user or record in the database that the PDF is ready
    }
    public function handle()
    {
        // Fetch data for the vacancy
        $vacancy = Vacancies::findOrFail($this->vacancyId);

        // Process and generate PDF content
        $jobApplications = JobApplication::where('vacancyid', $this->vacancyId)
            ->with([
                'user',
                'user.educationQualifications',
                'user.professionalQualifications',
                'user.professionalMemberships',
                'user.leadershipCourses',
                'user.experiences'
            ])
            ->get();

        // Extract the logic from your original controller for processing applicants
        $applicantDetails = $this->processApplications($jobApplications);

        $data = [
            'vacancy' => $vacancy,
            'institution' => "Your Institution Name",
            'logo' => public_path('backend/assets/images/logo-dark.png'),
            'applicantDetails' => $applicantDetails,
        ];

        // Generate PDF
        $pdf = Pdf::loadView('builder.longlist_job_application_report', $data)
            ->setPaper('a4', 'landscape');

        // Dynamically generate filename using the jobTitle
        $sanitizedJobTitle = preg_replace('/[^a-zA-Z0-9_]/', '_', $vacancy->jobTitle); // Replace special characters with underscores
        $pdfPath = "pdfs/{$sanitizedJobTitle}_report.pdf";

        // Save PDF to storage
        Storage::put($pdfPath, $pdf->output());

        // Optionally notify the user or record in the database that the PDF is ready
    }

    private function processApplications($jobApplications)
    {
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

            // Add similar mappings for academic details, professional qualifications, etc.
            $applicantDetails[] = [
                'personalDetails' => $personalDetails,
                // Add additional processed fields here
            ];
        }
        return $applicantDetails;
    }
}

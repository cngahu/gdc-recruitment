{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Job Application Report</title>--}}
{{--    <style>--}}
{{--        body {--}}
{{--            font-family: Arial, sans-serif;--}}
{{--        }--}}
{{--        .header {--}}
{{--            text-align: center;--}}
{{--        }--}}
{{--        .logo {--}}
{{--            width: 150px;--}}
{{--        }--}}
{{--        table {--}}
{{--            width: 100%;--}}
{{--            border-collapse: collapse;--}}
{{--            margin-top: 20px;--}}
{{--            text-align: left;--}}
{{--        }--}}
{{--        table, th, td {--}}
{{--            border: 1px solid black;--}}
{{--        }--}}
{{--        th, td {--}}
{{--            padding: 8px;--}}
{{--        }--}}
{{--        .footer {--}}
{{--            margin-top: 30px;--}}
{{--            text-align: center;--}}
{{--        }--}}
{{--        .report-table {--}}
{{--            page-break-inside: auto;--}}
{{--        }--}}
{{--        .report-table th, .report-table td {--}}
{{--            border: 1px solid black;--}}
{{--            padding: 8px;--}}
{{--            text-align: left;--}}
{{--        }--}}
{{--        .report-table th {--}}
{{--            background-color: #f4f4f4;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}

{{--@php--}}
{{--    $vacancyTitle = $vacancy->jobTitle; // Store job title in variable for use--}}
{{--    $applicants = $vacancy->jobApplications()->with(['user', 'user.educationQualifications', 'user.professionalQualifications', 'user.professionalMemberships', 'user.leadershipCourses', 'user.experiences'])->get();--}}
{{--@endphp--}}

{{--<div class="header">--}}
{{--    <img src="{{ $logo }}" alt="Logo" class="logo">--}}
{{--    <h2 style="text-transform: uppercase;">Public Sector Accounting Standards Board (PSASB)</h2>--}}
{{--    <h3>Job Application Report for {{ $vacancyTitle }}</h3>--}}
{{--    <h4>Longlist Report</h4>--}}
{{--</div>--}}

{{--<!-- Applicants Table -->--}}
{{--<table class="report-table">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>Applicant</th>--}}
{{--        <th>Personal Details</th>--}}
{{--        <th>Academic & Professional Qualifications</th>--}}
{{--        <th>Work Experience</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach($applicants as $application)--}}
{{--        @php--}}
{{--            $user = $application->user;--}}
{{--            // Personal Details--}}
{{--            $personalDetails = $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name . ', ' . $user->email . ', ' . $user->idnumber . ', ' . $user->dob . ', ' . \Carbon\Carbon::parse($user->dob)->age . ' years, ' . $user->ethnicityname->name . ', ' . optional($user->homeCounty)->name . ', Disability: ' . ($user->has_disability ? 'Yes' : 'No');--}}

{{--            // Academic & Professional Qualifications--}}
{{--            $academicQualifications = $user->educationQualifications->pluck('qualification')->implode(', ') ?? 'N/A';--}}
{{--            $professionalQualifications = $user->professionalQualifications->pluck('qualification')->implode(', ') ?? 'N/A';--}}
{{--            $professionalMemberships = $user->professionalMemberships->pluck('membership_body')->implode(', ') ?? 'N/A';--}}
{{--            $leadershipCourses = $user->leadershipCourses->pluck('course_title')->implode(', ') ?? 'N/A';--}}

{{--            // Work Experience--}}
{{--            $workExperience = $user->experiences->pluck('job_title')->implode(', ') ?? 'N/A';--}}
{{--        @endphp--}}
{{--        <tr>--}}
{{--            <td>{{ $user->first_name }} {{ $user->last_name }}</td>--}}
{{--            <td>{{ $personalDetails }}</td>--}}
{{--            <td>{{ $academicQualifications }} <br> {{ $professionalQualifications }} <br> {{ $professionalMemberships }} <br> {{ $leadershipCourses }}</td>--}}
{{--            <td>{{ $workExperience }}</td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}
{{--<table class="report-table">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>Applicant</th>--}}
{{--        <th>Personal Details</th>--}}
{{--        <th>Academic & Professional Qualifications</th>--}}
{{--        <th>Work Experience</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach($applicants as $application)--}}
{{--        @php--}}
{{--            $user = $application->user;--}}
{{--            // Personal Details--}}
{{--            $personalDetails = $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name . ', ' . $user->email . ', ' . $user->idnumber . ', ' . $user->dob . ', ' . \Carbon\Carbon::parse($user->dob)->age . ' years, ' . $user->ethnicityname->name . ', ' . optional($user->homeCounty)->name . ', Disability: ' . ($user->has_disability ? 'Yes' : 'No');--}}
{{--        @endphp--}}
{{--        <tr>--}}
{{--            <td>{{ $user->first_name }} {{ $user->last_name }}</td>--}}
{{--            <td>{{ $personalDetails }}</td>--}}
{{--            <td>--}}
{{--                @foreach($user->educationQualifications as $qualification)--}}
{{--                    <div>--}}
{{--                        <strong>Level:</strong> {{ optional($qualification->assign_academiclevel)->name ?? 'N/A' }}<br>--}}
{{--                        <strong>Institution:</strong> {{ $qualification->institutionName }}<br>--}}
{{--                        <strong>Course:</strong> {{ $qualification->courseName }}<br>--}}
{{--                        <strong>Graduation Year:</strong> {{ $qualification->exitDate }}<br>--}}
{{--                    </div>--}}
{{--                    <br>--}}
{{--                @endforeach--}}
{{--                <!-- Continue with other sections like professionalQualifications, memberships, etc -->--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                @foreach($user->experiences as $experience)--}}
{{--                    <div>--}}
{{--                        <strong>Company:</strong> {{ $experience->company }}<br>--}}
{{--                        <strong>Position:</strong> {{ $experience->jobTitle }}<br>--}}
{{--                        <strong>Duration:</strong> {{ \Carbon\Carbon::parse($experience->start_date)->format('Y-m-d') }} to {{ \Carbon\Carbon::parse($experience->end_date)->format('Y-m-d') }}<br>--}}
{{--                    </div>--}}
{{--                    <br>--}}
{{--                @endforeach--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}

{{--<div class="footer">--}}
{{--    Generated on {{ \Carbon\Carbon::now()->toFormattedDateString() }} at {{ \Carbon\Carbon::now()->toTimeString() }} by {{ config('app.name') }}--}}
{{--</div>--}}

{{--</body>--}}
{{--</html>--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
        }
        .logo {
            width: 150px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            text-align: left;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
        }
        .report-table {
            page-break-inside: auto;
            border-collapse: collapse;
        }
        .report-table th, .report-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .report-table th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #dcdcdc; /* Darker stripping color */
        }
        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        .personal-details {
            padding-left: 15px;
            font-size: 0.9em;
        }
        .header th {
            width: 20%;
        }
    </style>
</head>
<body>

@php
    $vacancyTitle = $vacancy->jobTitle; // Store job title in variable for use
    $applicants = $vacancy->jobApplications()->with(['user', 'user.educationQualifications', 'user.professionalQualifications', 'user.professionalMemberships', 'user.leadershipCourses', 'user.experiences'])->get();
@endphp

<div class="header">
    <img src="{{ $logo }}" alt="Logo" class="logo">
    <h2 style="text-transform: uppercase;">Public Sector Accounting Standards Board (PSASB)</h2>
    <h3>Job Application Report for {{ $vacancyTitle }}</h3>
    <h4>Longlist Report</h4>
</div>

<table class="report-table">
    <thead>
    <tr>
        <th>Row No.</th>
        <th>Applicant Details</th>
        <th>Academic Qualifications</th>
        <th>Professional Qualifications</th>
        <th>Professional Memberships</th>
        <th>Leadership</th>
        <th>Work Experience</th>
    </tr>
    </thead>
    <tbody>
    @foreach($applicants as $index => $application)
        @php
            $user = $application->user;
            // Personal Details
            $personalDetails = [
                'DOB' => $user->dob ?? 'None',
                'Email' => $user->email ?? 'None',
                'ID/Passport No' => $user->idnumber,
                'County' => optional($user->homeCounty)->name ?? 'None',
                'Gender' => $user->cgender->name ?? 'None',

                'Ethnicity' => optional($user->ethnicityname)->name ?? 'None',
                'Disability' => $user->disability ,
            ];

            // Academic Qualifications
            $educationQualifications = count($user->educationQualifications) ? $user->educationQualifications : 'None';

            // Professional Qualifications
            $professionalQualifications = count($user->professionalQualifications) ? $user->professionalQualifications : 'None';

            // Professional Memberships
            $professionalMemberships = count($user->professionalMemberships) ? $user->professionalMemberships : 'None';

            // Leadership
            $leadershipCourses = count($user->leadershipCourses) ? $user->leadershipCourses : 'None';

            // Work Experience
            $experiences = count($user->experiences) ? $user->experiences : 'None';
        @endphp
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>
                {{ $user->ctitle->name }}     {{ $user->first_name }} {{ $user->other_name }} {{ $user->last_name }}<br>
                <div class="personal-details">
                    @foreach($personalDetails as $key => $value)
                        <strong>{{ $key }}:</strong> {{ $value }}<br>
                    @endforeach
                </div>
            </td>

            <td>
                @if($educationQualifications != 'None')
                    @foreach($educationQualifications as $qualification)
                        <div>
                            <strong>Level:</strong> {{ optional($qualification->assign_academiclevel)->name ?? 'N/A' }}<br>
                            <strong>Institution:</strong> {{ $qualification->institutionName }}<br>
                            <strong>Course:</strong> {{ $qualification->courseName }}<br>
                            <strong>Graduation Year:</strong> {{ $qualification->exitDate }}<br><br>
                        </div>
                    @endforeach
                @else
                    None
                @endif
            </td>
            <td>
                @if($professionalQualifications != 'None')
                    @foreach($professionalQualifications as $qualification)
                        <div>
                            <strong>Institution:</strong> {{ $qualification->institutionName }}<br>
                            <strong>Course:</strong> {{ $qualification->courseName }}<br>
                            <strong>Qualification:</strong> {{ $qualification->grade }}<br><br>
                        </div>
                    @endforeach
                @else
                    None
                @endif
            </td>
            <td>
                @if($professionalMemberships != 'None')
                    @foreach($professionalMemberships as $membership)
                        <div>
                            <strong>Body:</strong> {{ $membership->proffBody }}<br>
                            <strong>Membership No.:</strong> {{ $membership->memberNumber }}<br>
                            <strong>Membership Status:</strong> {{ $membership->active }}<br><br>
                        </div>
                    @endforeach
                @else
                    None
                @endif
            </td>
            <td>
                @if($leadershipCourses != 'None')
                    @foreach($leadershipCourses as $leadership)
                        <div>
                            <strong>Institution:</strong> {{ $leadership->institutionName }}<br>
                            <strong>Course Name:</strong> {{ $leadership->courseName }}<br>
                            <strong>Qualification:</strong> {{ $leadership->grade }}<br><br>
                        </div>
                    @endforeach
                @else
                    None
                @endif
            </td>
            <td>
                @if($experiences != 'None')
                    @foreach($experiences as $experience)
                        <div>
                            <strong>Company:</strong> {{ $experience->company }}<br>
                            <strong>Job Title:</strong> {{ $experience->jobTitle }}<br>

                            <strong>Duration:</strong> {{ \Carbon\Carbon::parse($experience->start_date)->format('Y-m-d') }} to {{ \Carbon\Carbon::parse($experience->end_date)->format('Y-m-d') }}<br>
                        </div>
                    @endforeach
                @else
                    None
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>

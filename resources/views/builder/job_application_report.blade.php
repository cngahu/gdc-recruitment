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
            text-align: left; /* Align text to the left */
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left; /* Align table content to the left */
        }
        .footer {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>

@php
    $totalApplications = 0;
    $totalMale = 0;
    $totalFemale = 0;

    $reportTitle = '';
    $tableData = [];
    $columnHeaders = ['Date', 'Total Applications', 'Male', 'Female'];

    if (isset($dateData)) {
        // Iterating over date-wise data if report criteria is 'date'
        $reportTitle = 'Applications Per Day';
        $tableData = $dateData;
    } elseif (isset($countyData)) {
        // Iterating over county data if report criteria is 'county'
        $reportTitle = 'County-wise Application Distribution';
        $tableData = $countyData;
    } elseif (isset($ethnicityData)) {
        // Iterating over ethnicity data if report criteria is 'ethnicity'
        $reportTitle = 'Ethnicity-wise Application Distribution';
        $tableData = $ethnicityData;
    }

    // Calculate totals for the selected data
    foreach ($tableData as $data) {
        $totalApplications += $data['total'];
        $totalMale += $data['male'];
        $totalFemale += $data['female'];
    }
@endphp

<div class="header">
    <img src="{{ $logo }}" alt="Logo" class="logo">
    <h2 style="text-transform: uppercase;">Public Sector Accounting Standards Board (PSASB)</h2>

    <h3>Job Application Report for {{ $vacancy->jobTitle }}</h3>
    <h4>{{ $reportTitle }}</h4> <!-- Display dynamic report title -->
</div>

<table>
    <thead>
    <tr>
        <th>@if(isset($dateData)) Date @elseif(isset($countyData)) County @elseif(isset($ethnicityData)) Ethnicity @endif</th>
        <th>Total Applications</th>
        <th>Male</th>
        <th>Female</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tableData as $key => $data)
        <tr>
{{--            <td>{{ isset($key) ? \Carbon\Carbon::parse($key)->toFormattedDateString() : $key }}</td> <!-- Date formatted properly if date-wise data is provided -->--}}
            <td>
                @if (isset($key) && strtotime($key))
                    {{ \Carbon\Carbon::parse($key)->toFormattedDateString() }}
                @else
                    {{ $key }}
                @endif
            </td>

            <td>{{ $data['total'] }}</td>
            <td>{{ $data['male'] }}</td>
            <td>{{ $data['female'] }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Total</th>
        <th>{{ $totalApplications }}</th>
        <th>{{ $totalMale }}</th>
        <th>{{ $totalFemale }}</th>
    </tr>
    </tfoot>
</table>

<div class="footer">
    Generated on {{ \Carbon\Carbon::now()->toFormattedDateString() }} at {{ \Carbon\Carbon::now()->toTimeString() }} by {{ config('app.name') }}
</div>

</body>
</html>

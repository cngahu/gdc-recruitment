<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-height: 70px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ asset('images/logo.jpg') }}" alt="Institution Logo">
    <div class="title" style="text-transform: uppercase">Public Sector Accounting Standards Board (PSASB)</div>
    <div>Vacancy Applications Report by County</div>
</div>

<!-- Optionally provide a link for downloading the PDF report -->
@if (request()->has('pdf'))
    <h4>Generated PDF</h4>
    <iframe src="{{ route('county.vacancies.report', ['vacancy_id' => $vacancyId]) }}?pdf=true" width="100%" height="800px"></iframe>
@else
    <!-- Report table if not PDF -->
    <table class="table">
        <thead>
        <tr>
            <th>County</th>
            <th>Total Applicants</th>
            <th>Male</th>
            <th>Female</th>
            <th>Disabled</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($countyData as $data)
            <tr>
                <td>{{ $data['county_name'] }}</td>
                <td>{{ $data['total'] }}</td>
                <td>{{ $data['male'] }}</td>
                <td>{{ $data['female'] }}</td>
                <td>{{ $data['disabled'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

</body>
</html>

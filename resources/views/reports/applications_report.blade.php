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
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: gray;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="{{ $logo_url }}" alt="Institution Logo">
    <div class="title">{{ $institution_name }}</div>
    <div>Vacancy Applications Report</div>
</div>
<table class="table">
    <thead>
    <tr>
        <th>Vacancy Name</th>
        <th>Total Applicants</th>
        <th>Male</th>
        <th>Female</th>
        <th>Disabled</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($vacancies as $vacancy)
        <tr>
            <td>{{ $vacancy['vacancy_name'] }}</td>
            <td>{{ $vacancy['total_applicants'] }}</td>
            <td>{{ $vacancy['male'] }}</td>
            <td>{{ $vacancy['female'] }}</td>
            <td>{{ $vacancy['disabled'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="footer">
    Generated on {{ \Carbon\Carbon::now()->toFormattedDateString() }} by {{ config('app.name') }}
</div>
</body>
</html>

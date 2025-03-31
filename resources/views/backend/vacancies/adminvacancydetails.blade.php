@extends('admin_dashboard')
@section('admin')



    <div class="col-lg-8 col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="panel-body">
                    <table id="w0" class="table table-striped table-bordered detail-view"><tbody>
                        <tr><th>Job Title</th><td>{{$vacancydetails->jobTitle}}</td></tr>
                        <tr><th>Job Type</th><td>{{$vacancydetails->jobtype}}</td></tr>
                        <tr><th>Job Salary</th><td>{{$vacancydetails->salary}}</td></tr>
                        <tr><th>Job Description</th><td>{!! $vacancydetails->jobDescription !!}}</td></tr>
                        <tr><th>Job Specification</th><td>{!! $vacancydetails->jobSpecification !!}</td></tr>
                        <tr><th>Grade</th><td>{{$vacancydetails->positionCode}}</td></tr>
                        <tr><th>No Sought</th><td>{{$vacancydetails->Positions}}</td></tr>

                        <tr><th>Advert Ref </th><td>{{$vacancydetails->VacancyReference}}</td></tr>
                        </tbody></table>

                </div>
                <div class="panel-footer">



                    <a href="/" style="float:right;">

                    </a>

                    <a href="{{route('all.vacancies')}}" class="btn btn-info">Back</a>
    </div>
        </div>
    </div>


@endsection


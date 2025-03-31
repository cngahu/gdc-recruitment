@extends('admin_dashboard')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">All Vacancies</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Job Title</th>
{{--                                    <th>Job Description</th>--}}
{{--                                    <th>Job Specification</th>--}}
                                    <th>Position Code</th>
                                    <th>NO of Posts</th>
                                    <th>Vacancy Reference</th>
                                    <th>Details</th>

                                </tr>
                                </thead>


                                <tbody>
                                @foreach($vacancies as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->jobTitle }}</td>
{{--                                        <td>{!! $item->jobDescription !!}  }}</td>--}}
{{--                                        <td>{!! $item->jobSpecification!!}</td>--}}
                                        <td>{{ $item->positionCode }}</td>
                                        <td>{{ $item->Positions }}</td>
                                        <td>{{ $item->VacancyReference }}</td>
                                        <td>
{{--                                            {{ $item->competence }}--}}
                                            <a href="{{route('avacancy.details',$item->id)}}" class="btn btn-primary">Details</a>
                                        </td>


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->




        </div> <!-- container -->

    </div> <!-- content -->


@endsection

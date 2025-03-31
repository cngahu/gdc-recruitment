@extends('admin_dashboard')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">All Open Vacancies</h4>
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
{{--                                    <th>Grade</th>--}}
                                    <th>No Sought</th>
{{--                                    <th>Ref</th>--}}
                                    <th>Details</th>
                                    <th>Applicants</th>
                                    <th>Shortlisting Stages</th>

                                </tr>
                                </thead>


                                <tbody>
                                @foreach($jobs as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->jobTitle }}</td>
{{--                                        <td>{{ $item->positionCode }}</td>--}}
                                        <td>{{ $item->Positions }}</td>
{{--                                        <td>{{ $item->VacancyReference }}</td>--}}
                                        <td>
                                            <a href="{{route('avacancy.details',$item->id)}}" >Details</a>
                                        </td>
                                        <td>
                                            <a href="{{route('job.applicants',$item->id)}}">Applicants</a>
                                        </td>
                                        <td>
                                            @if($item->status=="Active")
                                                <a href="{{route('stage1',$item->id)}}" >Stage 1</a>
                                            @elseif($item->status=="Shortlisting")
                                                <a href="{{route('stage1',$item->id)}}" style="color: red">Stage 2</a> &nbsp;| &nbsp;

                                                <a href="{{route('stage1.report',$item->id)}}"  style="color: blueviolet">Stage 1 Report</a>
                                            @else

                                            @endif


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

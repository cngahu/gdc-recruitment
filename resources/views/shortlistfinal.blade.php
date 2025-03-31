@extends('admin_dashboard')
@section('admin')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->

        <!-- end page title -->


        <!-- end row -->

        <div class="row">


            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>

                        <h4 class="header-title mb-3">Application Summaries</h4>

                        <div class="table-responsive">
                            <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                                <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Vacancy</th>
                                    <th>Summary</th>
                                    <th>No. Applicants</th>
                                    <th>No. Male</th>
                                    <th>No. Female</th>
                                    <th>No. Intersex</th>
                                    <th>No. Disability</th>
                                    <th>Shortlisted Applicants</th>

                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($vacancies as $key=> $item)
                                        <tr>
                                        <td>{{ $key+1 }}</td>


                                        <td>
                                            <a href="{{route('job.applicants',$item->id)}}"> {{$item->jobTitle}}</a>

                                        </td>
                                            <td>
                                                <a href="{{route('countySummary',$item->id)}}">County Summary</a>
                                            </td>
                                            @php
                                            $applicants=\App\Models\JobApplication::where('vacancyid',$item->id)->count();
//                                            $male=\App\Models\JobApplication::where('vacancyid',$item->id)->where('gender',1)->count();
//                                            $female=\App\Models\JobApplication::where('vacancyid',$item->id)->where('gender',2)->count();
//                                            $inter=\App\Models\JobApplication::where('vacancyid',$item->id)->where('gender',3)->count();
//                                            $dis=\App\Models\JobApplication::where('vacancyid',$item->id)->where('disability','Yes')->count();

                                            $males = \App\Models\JobApplication::where('vacancyid',$item->id)->join('users', 'job_applications.userid', '=', 'users.id')->where('users.gender', 1)->count();
                                            $female = \App\Models\JobApplication::where('vacancyid',$item->id)->join('users', 'job_applications.userid', '=', 'users.id')->where('users.gender', 2)->count();
                                             $inter = \App\Models\JobApplication::where('vacancyid',$item->id)->join('users', 'job_applications.userid', '=', 'users.id')->where('users.gender', 3)->count();
                                             $dis = \App\Models\JobApplication::where('vacancyid',$item->id)->join('users', 'job_applications.userid', '=', 'users.id')->where('users.disability','Yes')->count();


                                            $shortlisted=App\Models\JobApplication::where('vacancyid',$item->id)->where('status','Shortlisted')->count();


                                            @endphp
                                            <td>
                                                <a href="{{route('countySummary',$item->id)}}">Ethnicity Summary</a>
                                            </td>
                                            <td>
                                                <a href="{{route('countySummary',$item->id)}}">Gender Summary</a>
                                            </td>
                                            <td>
                                                <a href="{{route('countySummary',$item->id)}}">Disability Summary</a>
                                            </td>
                                            <td>
                                                <a href="{{route('countySummary',$item->id)}}">Ethnicity Pie Summary</a>
                                            </td>
                                            <td>
                                                <a href="{{route('countySummary',$item->id)}}">County Pie Summary</a>
                                            </td>
                                            <td>{{$shortlisted}} </td>


                                        </tr>
                                  @endforeach






                                </tbody>
                            </table>
                        </div> <!-- end .table-responsive-->
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->

</div>

@endsection

@extends('panelist.panelist_dashboard')
@section('panelist')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->

        <!-- end page title -->


        <!-- end row-->


        <!-- end row -->

        <div class="row">


            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">


                        <h4 class="header-title mb-3">My Assigned Vacancy:Application Summaries</h4>

                        <div class="table-responsive">
                            <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                                <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Vacancy</th>
                                    <th>No. Applicants</th>
                                    <th>No. Filtered Out</th>
                                    <th>No. To Be Shortlisted</th>

                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($vacancies as $key=> $item)
                                        <tr>
                                        <td>{{ $key+1 }}</td>

                                        <td>
                                            <a href="{{route('panelist.applicants',$item->id)}}"> {{$item->jobTitle}}</a>

                                        </td>
                                            @php
                                            $applicants=\App\Models\JobApplication::where('vacancyid',$item->id)->count();
                                            $s_applicants=\App\Models\JobApplication::where('vacancyid',$item->id)->where('status','Applied')->count();
                                            $f_applicants=\App\Models\JobApplication::where('vacancyid',$item->id)->where('status','!=','Applied')->count();

                                            @endphp
                                        <td>{{$applicants}} </td>

                                        <td>
                                            {{$f_applicants}}
                                        </td>
                                        <td>
                                            {{$s_applicants}}
                                        </td>


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

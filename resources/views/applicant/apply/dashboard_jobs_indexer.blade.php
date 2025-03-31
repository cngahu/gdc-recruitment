@extends('applicant.applicant_dashboard')
@section('applicant')
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


{{--                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">--}}
                                <table id="scroll-horizontal-datatable" class="table w-100 nowrap">

                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Job Title</th>
                                    <th>Type</th>
                                    <th>Salary</th>
{{--                                    <th>No Sought</th>--}}
                                    <th>Ref</th>
                                    <th>Details</th>
{{--                                    <th>Close Date</th>--}}
                                    <th>Actions</th>

                                </tr>
                                </thead>


                                <tbody>
                                @foreach($vacancies as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->jobTitle }}</td>
                                        <td>{{ $item->jobtype }}</td>
                                        <td>{{ $item->salary }}</td>
{{--                                        <td>{{ $item->Positions }}</td>--}}
                                        <td>{{ $item->VacancyReference }}</td>
                                        <td>
                                            <a href="{{route('vvacancy.details',$item->id)}}" class="btn btn-primary">Details</a>

                                        </td>
{{--                                        <td>{{ $item->closedate }}</td>--}}

                                        @php
                                                    $user=\Illuminate\Support\Facades\Auth::user()->id;
                                                    $haveapplied=\App\Models\JobApplication::where('vacancyid',$item->id)->where('userid',$user)->count();


                                        @endphp
                                        <td>
                                            @if($ulevel<7)
{{--                                                <span class="badge bg-soft-danger text-danger">Cannot Apply For this Job Until You Finish Creating Profile</span>--}}
                                                <a href="{{route('dashboard.jobs.apply',$item->id)}}" class="btn btn-danger">Apply</a>

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

            <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!-- end row-->




        </div> <!-- container -->

    </div> <!-- content -->


@endsection

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


                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Job Title</th>
                                    <th>Type</th>
                                    <th>Salary</th>
                                    <th>No Sought</th>
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
                                        <td>{{ $item->Positions }}</td>
                                        <td>{{ $item->VacancyReference }}</td>
                                        <td>
                                            <a href="{{route('vvacancy.details',$item->id)}}" class="btn btn-primary">Details</a>

                                        </td>
{{--                                        <td>{{ $item->closedate }}</td>--}}

                                        @php
                                                    $user=\Illuminate\Support\Facades\Auth::user()->id;
                                                    $haveapplied=\App\Models\JobApplication::where('vacancyid',$item->id)->where('userid',$user)->count();
                                        $intemporary=\App\Models\tempjobapplication::where('vacancyid',$item->id)->where('userid',$user)->where('active',0)->count();


                                        @endphp
                                        <td>
{{--                                            @if($haveapplied>0)--}}
{{--                                                <span class="badge bg-soft-success text-success">Already Applied For The Position</span>--}}
{{--                                            @else--}}
{{--                                                <a href="{{route('jobs.apply',$item->id)}}" class="btn btn-danger">Apply</a></td>--}}

{{--                                        @endif--}}
                                            @if($haveapplied>0)
                                                <span class="badge bg-soft-success text-success">Already Applied For The Position</span>
                                            @elseif($intemporary>0)
                                                {{--                                            <button type="button" class="btn btn-warning waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#con-close-modal">Preview Profile</button>--}}
                                                <a href="{{route('applicant.jobapplicant.profile',[$user,$item->id])}}" class="btn btn-danger">Review Application</a>
                                                {{--                                    <a href="{{route('jobsapply.success',$item->id)}}" class="btn btn-success">Submit Application</a>--}}
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-alert-modal" data-id="{{$item->id}}">Submit Application</button>

                                            @else
                                                <a href="{{route('jobs.apply',$item->id)}}" class="btn btn-danger">Apply</a>

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
            <div id="success-alert-modal" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-success">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-checkmark h1 text-white"></i>
                                <h4 class="mt-2 text-white">Well Done!</h4>
                                <p class="mt-3 text-white">Are You Sure You Want To Submit This Application?</p>
                                <a href="#" class="btn btn-danger" id="submit-application-link">Submit Application</a>
                                <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var successAlertModal = document.getElementById('success-alert-modal');

            successAlertModal.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                var button = event.relatedTarget;

                // Extract info from data-id attribute
                var applicationId = button.getAttribute('data-id');

                // Update the modal's link
                var submitApplicationLink = successAlertModal.querySelector('#submit-application-link');
                var route = "{{ route('jobsapply.success', ':id') }}"; // Placeholder route
                submitApplicationLink.href = route.replace(':id', applicationId);
            });
        });

    </script>
@endsection

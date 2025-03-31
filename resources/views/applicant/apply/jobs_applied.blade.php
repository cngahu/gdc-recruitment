@extends('applicant.applicant_dashboard')
@section('applicant')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">All Vacancy Applications Made</h4>
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
                                    <th>Status</th>
{{--                                    <th>Application</th>--}}
{{--                                    <th>Actions</th>--}}

                                </tr>
                                </thead>


                                <tbody>
                                @foreach($vacancy as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item['vacancy']['jobTitle'] }}</td>
                                        <td >
                                            <p class="badge rounded-pill bg-success" style="font-size: medium">Applications Processing</p>

                                        </td>
{{--                                        <td >--}}
{{--                                    View Application--}}
{{--                                        </td>--}}

{{--                                        <td>--}}
{{--                                            @php--}}
{{--                                                $expiry= DB::table('vacancies')--}}
{{--                                                        ->join('recruitments', 'vacancies.Recruitmentid', '=', 'recruitments.id')--}}
{{--                                                        ->where('vacancies.id', "=",$item->vacancyid)--}}
{{--                                                        ->select( 'recruitments.closeDate as closedate')--}}
{{--                                                        ->first();--}}
{{--                                            @endphp--}}

{{--                                            @if( \Carbon\Carbon::today() <= $expiry->closedate )--}}
{{--                                                <a href="{{route('edit.jobapplied',$item->id)}}" class="btn btn-info">Edit Application</a>--}}

{{--                                            @else--}}
{{--                                                  Cannot Edit Application-{{$expiry->closedate}}--}}
{{--                                            @endif--}}
{{--                                        </td>--}}




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

@extends('admin_dashboard')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Shortlisting Stage 1 Report For Position :{{$vacancy->jobTitle}}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">

                                <thead>

                                <tr>
                                    <th>Sl</th>
                                    <th>Names</th>
{{--                                    <th>ID No</th>--}}
{{--                                    <th>County</th>--}}
                                    <th>Gender</th>
                                    <th>Disability</th>
{{--                                    <th>Highest Academic</th>--}}
                                    <th>Age</th>
                                    <th>Status</th>
                                    <th>Remarks</th>


                                </tr>
                                </thead>


                                <tbody>
                                @foreach($applicants as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->first_name}} {{ $item->other_name}} {{ $item->last_name}}</td>
{{--                                        <td>{{ $item['user']['idnumber'] }}</td>--}}
{{--                                        <td>{{ $item['user']['ccounty']['name']}}</td>--}}
                                        <td>{{ $item->gender }}</td>
                                        <td>{{ $item->disability }}</td>
{{--                                        <td>Highest</td>--}}


                                        <td>{{$item->age}}</td>
                                        <td>
                                            @if($item->status=="Applied")
                                                <span class="badge bg-soft-info text-info p-1">Shortlisted</span>
                                            @else
                                                <span class="badge bg-soft-danger text-danger p-1">Not Shortlisted</span>
                                            @endif
                                            </td>
                                        <td>{{$item->comments}}</td>


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

@extends('panelist.panelist_dashboard')
@section('panelist')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Applicants For Position :{{$vacancy->jobTitle}}</h4>
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
                                    <th>ID No</th>
                                    <th>County</th>
                                    <th>Gender</th>
                                    <th>Disability</th>
                                    <th>Ethnicity</th>
                                    <th>Age</th>
                                    <th>Profile</th>

                                </tr>
                                </thead>


                                <tbody>
                                @foreach($applicants as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item['user']['first_name']}} {{ $item['user']['other_name']}} {{ $item['user']['last_name']}}</td>
                                        <td>{{ $item['user']['idnumber'] }}</td>
                                        <td>{{ $item['user']['ccounty']['name']}}</td>
                                        <td>{{ $item['user']['cgender']['name'] }}</td>
                                        <td>{{ $item['user']['disability'] }}</td>
                                        <td>  {{ $item['user']['ethnicity1']['name'] }}</td>


                                        <td>{{$item['user']['age']}}</td>
                                        <td><a href="{{route('panelist.jobapplicant.profile',[$item->userid,$item->id])}}" >Profile</a></td>


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

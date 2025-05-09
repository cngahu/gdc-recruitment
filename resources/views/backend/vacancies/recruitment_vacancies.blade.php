@extends('admin_dashboard')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <a href="{{ route('add.vacancies',$recuitment->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Vacancies </a>
                        </div>
                        <h4 class="page-title">All Vacancies For Recruitment:-{{$recuitment->name}}</h4>
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

                                    <th>Grade</th>
                                    <th>Number</th>
                                    <th>Ref</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($vacancies as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->jobTitle }}</td>

                                        <td>{{ $item->positionCode }}</td>
                                        <td>{{ $item->Positions }}</td>
                                        <td>{{ $item->VacancyReference }}</td>
                                        <td>
                                            <a href="{{ route('details.vacancy',$item->id) }}" class="btn btn-success rounded-pill waves-effect waves-light">Details</a>

                                        </td>

                                        <td>
                                            <a href="{{ route('edit.vacancy',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>
                                            <a href="{{ route('delete.vacancy',$item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete">Delete</a>
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

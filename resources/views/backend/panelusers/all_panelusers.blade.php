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
                            <a href="{{ route('add_panelusers') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Panel Users </a>
                        </div>
                        <h4 class="page-title">All Panel User</h4>
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
                                    <th>Names</th>

                                    <th>Email</th>

                                    <th>Panel Role</th>
                                    <th>Vacancy Name</th>
{{--                                    <th>Status</th>--}}
                                    <th>Pass code</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($panel as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>

                                        <td>{{ $item->first_name }} {{ $item->last_name }}</td>


                                        <td>{{ $item->email  }}</td>

                                        <td>{{ $item->panel_role }}</td>
                                        @if($item->vacancy_id ==0 )
                                        <td> No assigned</td>

                                       @else
                                        <td> {{ $item['assign_vacancy']['jobTitle'] }}</td>
                                        @endif
{{--                                        <td>{{ $item->vacancy_id }}</td>--}}
{{--                                        <td>{{ $item->status  }}</td>--}}
                                        <td>{{ $item->passcode  }}</td>
                                        <td>
                                            <a href="{{ route('edit.panel',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>
                                            <a href="{{ route('delete.panel',$item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete">Delete</a>
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

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
                        <a href="{{ route('add.recruitment') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Recruitment </a>
                    </div>
                    <h4 class="page-title">All Recruitments</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">


                        <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap dataTable no-footer" aria-describedby="scroll-horizontal-datatable_info" style="width: 2680px;">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>

                                <th>Start Date</th>
                                <th>Close Date</th>
                                <th>Vacancies</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($recruitment as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->name }}</td>

                                <td>{{ $item->startDate }}</td>
                                <td>{{ $item->closeDate }}</td>
                                <td>
                                    <a href="{{route('recruitment.vacancies',$item->id)}}" class="btn btn-success">Vacancies</a>
                                </td>
                                <td>{{ $item['creator']['first_name'] }}</td>

                                <td>
                                    <a href="{{ route('extend.recruitment',$item->id) }}" class="btn btn-warning rounded-pill waves-effect waves-light">Extend</a>

                                    <a href="{{ route('edit.recruitment',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>
                                    <a href="{{ route('delete.recruitment',$item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete">Delete</a>
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

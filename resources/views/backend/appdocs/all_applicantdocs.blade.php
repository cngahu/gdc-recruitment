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
                        <a href="{{ route('add.appdocs') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Create New </a>
                    </div>
                    <h4 class="page-title">All Application/Statutory Documents</h4>
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
                                <th>Document Name</th>
                                <th>Job Specific</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($appdocs as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>

                                <td>{{ $item->document_name }}</td>
                                <td>
                                    @if($item->job_specific==0)
                                        <span class="badge bg-soft-success text-success">No</span>
                                    @else
                                        <span class="badge bg-soft-danger text-danger">Yes</span>
                                    @endif
                                </td>

                                <td>
                                    @if($item->active==1)
                                        <span class="badge bg-soft-success text-success">Active</span>
                                    @else
                                        <span class="badge bg-soft-danger text-danger">Inactive</span>
                                    @endif

                                    </td>
                                <td>
                                    <a href="{{ route('edit.appdocs',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>
                                    <a href="{{ route('delete.appdocs',$item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete">Delete</a>
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

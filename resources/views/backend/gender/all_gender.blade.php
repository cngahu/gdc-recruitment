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
                        <a href="{{ route('add.gender') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Sex </a>
                    </div>
                    <h4 class="page-title">All Sex</h4>
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
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($gender as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>

                                <td>{{ $item->name }}</td>

                                <td>
                                    <a href="{{ route('edit.gender',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>
                                    <a href="{{ route('delete.gender',$item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete">Delete</a>
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

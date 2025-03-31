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
                        </div>
                        <h4 class="page-title">All Unverified Accounts</h4>
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

                                    <th>Actions</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($panel as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>

                                        <td>{{ $item->first_name }} {{ $item->last_name }}</td>


                                        <td>{{ $item->email  }}</td>

                                        <td>
                                            <a href="{{ route('admin.verify',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light">Verify</a>
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

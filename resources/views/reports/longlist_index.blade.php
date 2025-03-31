@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Start Content-->
        <div class="container-fluid">

            <h1>Generated Reports</h1>

            @if(count($files) > 0)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Report Name</th>
                        <th>Download</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($files as $index => $file)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ basename($file) }}</td>
                            <td>
                                <a href="{{ route('admin.reports.download', basename($file)) }}" class="btn btn-sm btn-primary">
                                    Download
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No reports generated yet.</p>
            @endif



        </div> <!-- container -->

    </div> <!-- content -->



@endsection
